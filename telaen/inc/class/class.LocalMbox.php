<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

/**
 * Simple PHP Helper for sqlite3-based Email data
 */
class LocalMbox extends SQLite3
{
    private $active_folder = "";
    private $userfolder = "";
    private $db = null;
    private $fschema = array(
        'name' => 'TEXT NOT NULL',
        'system' => 'INT NOT NULL',
        'size' => 'INT'
    );
    private $aschema = array(
        'folder' => 'TEXT NOT NULL',
        'uidl' => 'TEXT NOT NULL',
        'localname' => 'TEXT',
        'name' => 'TEXT',
        'type' => 'TEXT',
        'size' => 'INT'
    );
    private $mschema = array(
        'date' => 'INT',
        'hparsed' => 'INT',
        'id' => 'INT',
        'msg' => 'INT',
        'size' => 'INT',
        'priority' => 'INT',
        'attach' => 'INT',
        'folder' => 'TEXT',
        'uidl' => 'TEXT',
        'subject' => 'TEXT',
        'from' => 'TEXT',
        'fromname' => 'TEXT',
        'to' => 'TEXT',
        'cc' => 'TEXT',
        'flags' => 'TEXT',
        'messageid' => 'TEXT',
        'localname' => 'TEXT',
        'header' => 'TEXT'
    );

    public $folders = array();
    public $attachments = array();
    public $headers = array();
    public $system_folders = array('inbox', 'spam', 'trash', 'draft', 'sent', '_attachments', '_infos');
    public $ok = true;
    public $message = '';
    public $changed = array();

    /**
     * Construct: open DB and create tables if needed
     * @param type $userfolder
     */
    public function __construct($userfolder)
    {
        $this->allok();
        $this->userfolder = $userfolder;
        $this->db = $userfolder.'_infos/mboxes.db';
        $exists = is_writable($this->db);
        parent::__construct($this->db, SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
        //$this->open($this->db, SQLITE3_OPEN_READWRITE| SQLITE3_OPEN_CREATE);
        $this->query('PRAGMA synchronous = 0;');
        $this->query('PRAGMA journal_mode = MEMORY;');
        if (!$exists) {
            $table = $this->create_query('folders', $this->fschema);
            if ($this->exec($table) == false) {
                $this->ok = false;
                $this->message .= "bad exec: $table";
            }

            $table = $this->create_query('attachs', $this->aschema);
            if ($this->exec($table) == false) {
                $this->ok = false;
                $this->message .= "bad exec: $table";
            }
            $ok = $this->ok;
            $message = $this->message;
            foreach($this->system_folders as $foo) {
                $this->add_folder($foo, true);
            }
            /*
             * We may have folders from previous installs. Check
             */
            foreach (scandir($userfolder) as $entry) {
                if (is_dir($entry)
                    && $entry != '..'
                    && $entry != '.'
                    && !isset($this->folders[$entry])) {
                    $this->add_folder($entry, true);
                }
            }
            $this->ok = $this->ok && $ok;
            $this->message .= $message;
        }
        $this->get_folders();
    }

    /**
     * Create array of allowable entry/type from a baseline schema
     * @param type $fields
     * @param type $schema
     * @return type
     */
    private function create_uplist($fields, $schema)
    {
        if ($fields == "*") {
            $thelist = keys($schema);
        } elseif (is_array($fields) && count($fields) > 0) {
            foreach ($fields as $key) {
                $key = trim($key);
                if (isset($schema[$key])) {
                    $thelist[] = $key;
                }
            }
        } elseif (!is_array($field)) {
            $this->ok = false;
            $this->message = "bad param fields";
            return null;
        } else {
            /* nothing to do... is this OK or an error? */
        }
        if (!count($thelist)) {
            $this->ok = false;
            $this->message = "no valid fields";
            return null;
        }
        return $thelist;
    }

    /**
     * Creates the 'CREATE table' query
     * @param type $table
     * @param type $schema
     * @return string
     */
    private function create_query($table, $schema)
    {
        $query = sprintf('CREATE TABLE %s (', $table);
        foreach ($schema as $key => $val) {
            $query .= " '$key' $val,";
        }
        $query = rtrim($query, ",") . ');';
        return $query;
    }
    /**
     * Creates and Execute the 'UPDATE table SET... WHERE' statement
     * @param string $table Table to update
     * @param array $list List of elements to update
     * @param array $data Hash of data to update keyed by list
     * @param array $where the WHERE statement field and values (assume =)
     * @return SQLite3Result
     */
    private function do_update($table, $list, $data, $where)
    {
        $query = sprintf('UPDATE %s SET ', $table);
        $temp = array();
        foreach ($list as $key) {
            $temp[] = " '$key'=:$key";
        }
        $query = $query.implode(', ', $temp).' WHERE ';
        $temp = array();
        foreach ($where as $key => $val) {
            $temp[] = "'$key'=:$key";
        }
        $query = $query.implode(' AND ', $temp).' ;';
        $stmt = $this->prepare($query);
        reset($list);
        foreach ($list as $key) {
            $stmt->bindValue(":$key", $data[$key]);
        }
        foreach ($where as $key => $val) {
            $stmt->bindValue(":$key", $val);
        }
        $result = $stmt->execute();
        $stmt->close();
        if (!$result) {
            $this->ok = false;
            $this->message .= "execute failed: $query";
        }
        return $result;
    }

    /**
     * Creates and Execute the 'INSERT into table (' statement
     * @param string $table Table to insert into
     * @param array $list List of elements to insert
     * @param array $data Hash of data to insert keyed by list
     * @return SQLite3Result
     */
    private function do_insert($table, $list, $data)
    {
        $query = sprintf('INSERT into %s (\'', $table);
        $query .= implode("','",$list);
        $query .= '\') VALUES (:';
        reset($list);
        $query .= implode(",:",$list);
        $query .= ');';
        $stmt = $this->prepare($query);
        reset($list);
        foreach ($list as $key) {
            $stmt->bindValue(":$key", $data[$key]);
        }
        $result = $stmt->execute();
        $stmt->close();
        if (!$result) {
            $this->ok = false;
            $this->message .= "execute failed: $query";
        }
        return $result;
    }

    /**
     * Return CRC32 hash of string
     * @param string $folder
     * @return int
     */
    public function getKey($folder)
    {
        return crc32($folder);
    }


    private function allok()
    {
        $this->ok = true;
        $this->message = '';
    }
    /**
     * Get list of all available attachments
     * $this-attachments auto-populated with array
     * @param string $folder
     * @param string $uidl
     * @return array
     */
    public function get_attachments($folder, $uidl)
    {
        $query = "SELECT * FROM attachs WHERE 'folder'=:folder AND 'uidl'=:uidl ;";
        $stmt = $this->prepare($query);
        $stmt->bindValue(':folder', $folder);
        $stmt->bindValue(':uidl', $uidl);
        $result = $stmt->execute($query);
        $this->attachments = array();
        if ($result) {
            while ($foo = $result->fetchArray()) {
                $this->attachments[] = $foo;
            }
        } else {
            $this->ok = false;
            $this->message = "query failed: $query";
        }
        $stmt->close();
        return $this->attachments;
    }

    /**
     * Get list of all available folders/emailboxes
     * $this-folders auto-populated with hash
     * @return hash
     */
    public function get_folders()
    {
        $query = 'SELECT * FROM folders';
        $result = $this->query($query);
        $this->folders = array();
        if ($result) {
            while ($foo = $result->fetchArray()) {
                $this->folders[$foo['name']] = $foo;
            }
        } else {
            $this->ok = false;
            $this->message = "query failed: $query";
        }
        return $this->folders;
    }

    /**
     * Add new folder/emailbox to DB
     * @param string $folder
     * @param int $sys
     * @return boolean
     */
    public function add_folder($folder, $calc_size = false)
    {
        $sys = isset($this->system_folders[$folder]);
        $size = 0;
        if ($calc_size && is_dir($this->userfolder.$folder)) {
            $size = $this->calc_folder_size($this->userfolder.$folder);
        }
        $query = sprintf('folder_%s', $this->getKey($folder));
        $query = $this->create_query($query, $this->mschema);
        if ($this->exec($query)) {
            $stmt = $this->prepare("INSERT into folders ('name', 'system', 'size') VALUES (:name, :system, :size);");
            $stmt->bindValue(':name', $folder);
            $stmt->bindValue(':system', intval($sys));
            $stmt->bindValue(':size', $size);
            if ($stmt->execute()) {
                $this->folders[$folder] = array('name' => $folder, 'system' => intval($sys), 'size' => 0);
                return true;
            } else {
                $this->message .= "execute failed:";
            }
        }
        $this->ok = false;
        $this->message .= "exec failed: $query";
        return false;

    }

    /**
     * Remove/delete a folder from the DB
     * @param string $folder Folder to rm from DB
     * @return boolean
     */
    public function del_folder($folder)
    {
        $table ='DROP TABLE folder_%s ;';
        $query = sprintf($table, $this->getKey($folder));
        if (!$this->exec($query)) {
            $this->ok = false;
            $this->message = "exec failed: $query";
            return false;
        }
        unset($this->folders[$folder]);
        return true;

    }

    /**
     * Update size field in folders
     * @param string $folder Folder name
     * @param int $size Additional size
     * @return boolean
     */
    public function update_folder_size($folder, $size)
    {
        $stmt = $this->prepare("UPDATE folder SET 'size'=:size WHERE 'name'=:name ;");
        $stmt->bindValue(':name', $folder);
        $this->folders[$folder]['size'] += $size;
        $stmt->bindValue(':size', $this->folders[$folder]['size']);
        if ($stmt->execute()) {
            return true;
        } else {
            $this->ok = false;
            $this->message .= "execute failed: ";
            return false;
        }
   }
    /**
     * Get list of all email message headers in folder/emailbox
     * $this->headers auto-populated with array
     * @param string $folder
     * @param boolean $force TRUE to force a resync
     * @return array
     */
    public function get_headers($folder, $force = false, $sortby = "", $sortorder = "")
    {
        if ($folder != $this->active_folder || $force) {
            $this->update_headers();
            $query = sprintf('SELECT * FROM folder_%s ', $this->getKey($folder));
            if ($sortby && isset($this->mschema[$sortby])) {
                $query .= "ORDER BY '$sortby' ";
                if ($sortorder == 'ASC' || $sortorder == 'DESC') {
                    $query .= " $sortorder ";
                }
            }
            $query .= ';';
            $result = $this->query($query);
            $this->headers = array();
            $index = 0;
            if ($result) {
                while ($foo = $result->fetchArray()) {
                    $this->headers[$index] = $foo;
                    $this->headers[$index]['idx'] = $index;
                    $index++;
                }
                $this->active_folder = $folder;
            } else {
                $this->ok = false;
                $this->message = "query failed: $query";
            }
        }
        return $this->headers;
    }

    /**
     * Get count of all email message headers in folder/emailbox
     * $this->headers is NOT changed!
     * @param string $folder
     * @param boolean $force TRUE to force a resync
     * @return array
     */
    public function count_headers($folder, $force = false)
    {
        if ($folder != $this->active_folder || $force) {
            $query = sprintf('SELECT COUNT(*) FROM folder_%s;', $this->getKey($folder));
            $result = $this->query($query);
            if ($result) {
                $count = $result->fetchArray();
                return $count[0];
            } else {
                $this->ok = false;
                $this->message = "query failed: $query";
                return null;
            }
        }
        return count($this->headers);
    }

    /**
     * Add email message to folder
     * @param type $msg
     * @return boolean
     */
    public function add_header($msg)
    {
        $stmt = $this->do_insert($this->getKey($msg['folder']), $this->mschema, $msg);
        if (!$stmt->execute($query)) {
            $this->ok = false;
            $this->message = "exec failed: $query";
            return false;
        }
        $this->headers[] = $msg;
        end($this->headers);
        $index = key($this->headers);
        $this->headers[$index]['idx'] = $index;
        reset($this->headers);
        return true;
    }

    /**
     * Take the email message array and update the fields in the DB
     * @param type $msg Message to be updated/synced in DB
     * @param boolean $fields "*" for all, or array of fields
     * @return boolean
     */
    /*
     * The complexity is allow for the use of $this->mschema:
     *  Having the message schema defined in one location is nice.
     */
    public function update_header($msg, $fields = "*")
    {
        $thelist = $this->create_uplist($fields, $this->mschema);
        if ($thelist == null || !is_array($thelist)) {
            return false;
        }
        $table = sprintf('folder_%s', $this->getKey($msg['folder']));
        $result = $this->do_update($table, $thelist, $msg, array('uidl'=>$msg['uidl']));
        if (!$result) {
            return false;
        }
        return true;
   }

    /**
     * Update all changed headers for all email messages
     * @return boolean
     */
    public function update_headers()
    {
        if (count($this->changed) > 0) {
            foreach ($this->changed as $foo) {
                if (!$this->update_header($this->headers[$foo[0]], $foo[1])) {
                    return false;
                }
            }
        }
        return true;
    }
    /**
     * Delete email message from DB
     * @param array $msg
     * @return boolean
     */
    public function del_header($msg)
    {
        $query = sprintf("DELETE FROM folder_%s WHERE 'uidl'='%s' ;", $this->getKey($msg['folder']), $msg['uidl']);
        if (!$this->exec($query)) {
            $this->ok = false;
            $this->message = "exec failed: $query";
            return false;
        }
        /* If we deleted from the active folder, then update our array */
        if ($msg['folder'] == $this->active_folder) {
            unset($this->headers[$msg['idx']]);
        }
        return true;
    }

    public function add_attachment($folder, $msg)
    {

    }


    public function del_attachment($folder, $msg)
    {

    }

    private function calc_folder_size($path)
    {
        $total_size = 0;
        $path = rtrim($path, '/') . '/';

        foreach(scandir($path) as $f) {
            if ($f != "." && $f != "..") {
                $nfile = $path . $f;
                if (is_dir($nfile)) {
                    $size = foldersize($nfile);
                    $total_size += $size;
                }
                else {
                    $size = filesize($nfile);
                    $total_size += $size;
                }
            }
        }
        return $total_size;
    }

}
