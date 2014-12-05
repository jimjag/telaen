<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

/**
 * Simple PHP Helper for sqlite3-based Email data
 */
class Mbox extends SQLite3
{
    private $active_folder = "";
    private $userfolder = "";
    private $db = null;
    private $fschema = array(
        'name' => 'TEXT NOT NULL',
        'system' => 'INT NOT NULL'
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
            $table = $this->create_stmt('folders', $this->fschema);
            if ($this->exec($table) == false) {
                $this->ok = false;
                $this->message .= "bad exec: $table";
            }

            $table = $this->create_stmt('attachs', $this->aschema);
            if ($this->exec($table) == false) {
                $this->ok = false;
                $this->message .= "bad exec: $table";
            }
            $ok = $this->ok;
            $message = $this->message;
            foreach($this->system_folders as $foo) {
                $this->add_folder($foo, 1);
            }
            $this->ok = $this->ok && $ok;
            $this->message .= $message;
        }
        $this->get_folders();
        /*
         * We may have folders from previous installs. Check
         */
        $d = dir($userfolder);
        while ($entry = $d->read()) {
            if (is_dir($userfolder.$entry)
                && $entry != '..'
                && $entry != '.'
                && !isset($this->folders[$entry])) {
                $this->add_folder($entry);
            }
        }
        $d->close();
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
        $stmt = sprintf('CREATE TABLE %s (', $table);
        foreach ($schema as $key => $val) {
            $stmt .= " '$key' $val,";
        }
        $stmt = rtrim($stmt, ",") . ');';
        return $stmt;
    }
    /**
     * Creates and Execute the 'UPDATE table SET... WHERE' statement
     * @param type $table
     * @param type $list List of elements to update
     * @param type $data Hash of data to update keyed by list
     * @return SQLite3Result
     */
    private function do_update($table, $list, $data, $where)
    {
        $query = sprintf('UPDATE %s SET ', $table);
        $temp = array();
        foreach ($list as $var) {
            $temp[] = " '$var'=:$var";
        }
        $query = $query.implode(', ', $temp).' WHERE ';
        $temp = array();
        foreach ($where as $key => $val) {
            $temp[] = "'$key'=:$key";
        }
        $query = $query.implode(' AND ', $temp).');';
        $stmt = $this->prepare($query);
        reset($list);
        foreach ($list as $val) {
            $stmt->bindValue(":$var", $data[$var]);
        }
        foreach ($where as $key => $val) {
            $stmt->bindValue(":$key", $val);
        }
        $retval = $stmt->execute();
        $stmt->close();
        if (!retval) {
            $this->ok = false;
            $this->message .= "execute failed: $query";
        }
        return $retval;
    }

    /**
     * Creates and Execute the 'INSERT into table (' statement
     * @param type $table
     * @param type $list List of elements to insert
     * @param type $data Hash of data to insert keyed by list
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
        foreach ($list as $var) {
            $stmt->bindValue(":$var", $data[$var]);
        }
        $retval = $stmt->execute();
        $stmt->close();
        if (!retval) {
            $this->ok = false;
            $this->message .= "execute failed: $query";
        }
        return $retval;
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
        $retval = $stmt->execute($query);
        $this->attachments = array();
        if ($retval) {
            while ($foo = $retval->fetchArray()) {
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
        $stmt = $this->query($query);
        $this->folders = array();
        if ($stmt) {
            while ($foo = $stmt->fetchArray()) {
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
    public function add_folder($folder, $sys = 0)
    {
        $query = sprintf('folder_%s', $this->getKey($folder));
        $query = $this->create_stmt($query, $this->mschema);
        if ($this->exec($query)) {
            $stmt = $this->prepare("INSERT into folders ('name', 'system') VALUES (:name, :system);");
            $stmt->bindValue(':name', $folder);
            $stmt->bindValue(':system', intval($sys));
            if ($stmt->execute()) {
                $this->folders[$folder] = array('name' => $folder, 'system' => intval($sys));
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
     * Get list of all message headers in folder/emailbox
     * $this->headers auto-populated with array
     * @param string $folder
     * @param boolean $force TRUE to force a resync
     * @return array
     */
    public function get_headers($folder, $force = false)
    {
        if ($folder != $this->active_folder || $force) {
            $this->update_headers();
            $query = sprintf('SELECT * FROM folder_%s;', $this->getKey($folder));
            $stmt = $this->query($query);
            $this->headers = array();
            $index = 0;
            if ($stmt) {
                while ($foo = $stmt->fetchArray()) {
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
     * Add message
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
     * Take the message array and update the fields in the DB
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
     * Update all changed headers for all messages
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
     * Delete message from DB
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


}
