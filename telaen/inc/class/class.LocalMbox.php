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
    private $force_new = false;
    private $fschema = array(
        'name' => 'TEXT NOT NULL',
        'system' => 'INT NOT NULL', // Is it a system folder?
        'size' => 'INT DEFAULT 0',
        'count' => 'INT DEFAULT 0',
        'unread' => 'INT DEFAULT 0',
        'refreshed' => 'INT DEFAULT 0', // time() of last refresh from server
        'version' => 'INT DEFAULT 0', // Have we read old messages?
        'prefix' => 'TEXT DEFAULT ""',
        'table_name' => 'TEXT DEFAULT ""',
        'dirname' => 'TEXT NOT NULL',
    );
    private $aschema = array(
        'folder' => 'TEXT NOT NULL',
        'uidl' => 'TEXT NOT NULL',
        'localname' => 'TEXT DEFAULT ""',
        'name' => 'TEXT DEFAULT ""',
        'type' => 'TEXT DEFAULT ""',
        'size' => 'INT DEFAULT 0',
    );
    private $mschema = array(
        'date' => 'INT DEFAULT 0',
        'hparsed' => 'INT DEFAULT 0', // Have we parsed the header?
        'id' => 'INT DEFAULT 0',
        'mnum' => 'INT DEFAULT 0', // message number
        'size' => 'INT DEFAULT 0',
        'priority' => 'INT DEFAULT 0',
        'attach' => 'INT DEFAULT 0',
        'islocal' => 'INT DEFAULT 0', // Does it live on web server?
        'uid' => 'INT DEFAULT 0', // IMAP UID
        'version' => 'INT DEFAULT 2',
        'unread' => 'INT DEFAULT 1',
        'folder' => 'TEXT NOT NULL',
        'uidl' => 'TEXT NOT NULL PRIMARY KEY', // Our unique key (md5)
        'ouidl' => 'TEXT DEFAULT ""', // Old uidl from Telaen 1.x
        'subject' => 'TEXT DEFAULT ""',
        'from' => 'TEXT DEFAULT ""', // note: array
        'fromname' => 'TEXT DEFAULT ""',
        'to' => 'TEXT DEFAULT ""', // note: array
        'cc' => 'TEXT DEFAULT ""', // note: array
        'flags' => 'TEXT DEFAULT ""',
        'message-id' => 'TEXT DEFAULT ""',
        'localname' => 'TEXT DEFAULT ""',
        'receipt-to' => 'TEXT DEFAULT ""', // note: array
        'x-spam-level' => 'TEXT DEFAULT ""',
        'reply-to' => 'TEXT DEFAULT ""', // note: array
        'content-type' => 'TEXT DEFAULT ""',
        'content-transfer-encoding' => 'TEXT DEFAULT ""',
        'header' => 'TEXT DEFAULT ""',
    );

    public $folders = [];  // Hash: All Email boxes/folders; key = name
    public $attachments = [];
    public $messages = []; // List: All messages from the current email folder;
    public $m_idx = []; // Hash: key = uidl; value = index to this->messages
    public $allfolders = []; // All folders/directors
    public $udatafolder = '_infos';
    public $m_delta = []; // Hash: key = message; value = array() of field changes
    /*
     * Some message elements are arrays, that need to be serialize when storing and
     * unserialize when read. Thankfully, all these are unique field names and
     * so we don't need to check that we are updating/inserting messages, specifically,
     * when serializing.
     */
    public $m_serialize = ['to', 'from', 'cc', 'reply-to', 'receipt-to'];
    private $_system_folders = ['inbox', 'spam', 'trash', 'draft', 'sent', '_attachments', '_infos'];
    private $_invisible = ['_attachments', '_infos'];
    private $_indb = []; /* Hash: key = uidl; value = is it in the DB? */
    private $_folder_need_sync = [];
    private $_ok = true;
    private $_log = [];

    /**
     * Construct: open DB and create tables if needed
     * @param string $userfolder
     * @param boolean $force_new
     */
    public function __construct($userfolder, $force_new = false)
    {
        $this->_allok();
        $this->userfolder = $userfolder;
        $this->force_new = $force_new;
        $this->db = $userfolder.$this->udatafolder.'/mboxes.db';
        $exists = is_writable($this->db);
        parent::__construct($this->db, SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
        //$this->open($this->db, SQLITE3_OPEN_READWRITE| SQLITE3_OPEN_CREATE);
        // $this->query('PRAGMA synchronous = 0;');
        // $this->query('PRAGMA journal_mode = MEMORY;');
        if (!$exists || $force_new) {
            $this->init_tables();
        }
        $this->get_folders();
        register_shutdown_function([$this, '__destruct']);
    }

    public function __destruct()
    {
        $this->sync_messages();
        $this->close();
    }

    /**
     * Create all required SQLite3 tables
     *
     */
    public function init_tables()
    {
        $this->_allok();
        $table = $this->create_query('folders', $this->fschema);
        if ($this->exec($table) == false) {
            $this->_ok = false;
            $this->_log[] = "bad exec: $table";
        }

        $table = $this->create_query('attachs', $this->aschema);
        if ($this->exec($table) == false) {
            $this->_ok = false;
            $this->_log = "bad exec: $table";
        }
        $ok = $this->_ok;
        foreach($this->_system_folders as $foo) {
            $this->new_folder(['name' => $foo, 'dirname' => $foo]);
        }
        /*
         * We may have folders from previous installs. Check
         */
        foreach (scandir($this->userfolder) as $entry) {
            if (is_dir($this->userfolder.$entry)
                && $entry != '..'
                && $entry != '.'
                && !isset($this->folders[$entry])) {
                $this->new_folder(['name' => $entry, 'dirname' => $entry]);
            }
        }
        $this->_ok = $this->_ok && $ok;
        return $this->_ok;
    }

    /**
     * Return array of all required folders
     * @return array
     */
    public function required_dirs() {
        return $this->_system_folders;
    }

    /**
     * Create array of allowable entry/type from a baseline schema
     * @param mixed $fields
     * @param array $schema
     * @return array
     */
    private function create_uplist($fields, $schema, $ignore=[])
    {
        $tmp = [];
        $thelist = [];
        if ($fields == "*") {
            $tmp = array_keys($schema);
        } elseif (is_array($fields) && count($fields) > 0) {
            foreach ($fields as $key) {
                $key = trim($key);
                if (isset($schema[$key])) {
                    $tmp[] = $key;
                }
            }
        } elseif (!is_array($fields)) {
            $this->_ok = false;
            $this->_log[] = "bad param fields";
            return null;
        } else {
            /* nothing to do... is this OK or an error? */
        }
        foreach ($tmp as $key) {
            $key = trim($key);
            if (!in_array($key, $ignore)) {
                $thelist[] = $key;
            }
        }
        if (!count($thelist)) {
            $this->_ok = false;
            $this->_log[] = "no valid fields";
            return null;
        }
        return $thelist;
    }

    /**
     * Creates the 'CREATE table' query
     * @param string $table
     * @param array $schema
     * @return string
     */
    private function create_query($table, $schema)
    {
        $query = sprintf('DROP TABLE IF EXISTS %s; CREATE TABLE %s (', $table, $table);
        foreach ($schema as $key => $val) {
            $query .= " '$key' $val,";
        }
        $query = rtrim($query, ",") . ');';
        return $query;
    }
    /**
     * Creates and Execute the 'UPDATE table SET... WHERE' statement
     * @param string $table Table to update
     * @param array $data Hash of data to update keyed by list
     * @param array $list List of elements to update
     * @param array $where the WHERE statement field and values (assume =)
     * @return SQLite3Result
     */
    private function do_update($table, $data, $list, $where)
    {
        $query = sprintf('UPDATE %s SET ', $table);
        $temp = [];
        foreach ($list as $key) {
            $temp[] = " \"$key\"=?";
        }
        $query = $query.implode(', ', $temp).' WHERE ';
        $temp = [];
        foreach ($where as $key => $val) {
            $temp[] = "\"$key\"=?";
        }
        $query = $query.implode(' AND ', $temp).' ;';
        $stmt = $this->prepare($query);
        reset($list);
        $i = 1;
        foreach ($list as $key) {
            $stmt->bindValue("$i", (in_array($key, $this->m_serialize) ? serialize($data[$key]) : $data[$key]));
            $i++;
        }
        foreach ($where as $key => $val) {
            $stmt->bindValue("$i", $val);
            $i++;
        }
        $result = $stmt->execute();
        $stmt->close();
        if (!$result) {
            $this->_ok = false;
            $this->_log[] = "execute failed: $query";
        }
        return $result;
    }

    /**
     * Creates and Execute the 'INSERT into table (' statement
     * We re-use the prepared statement by assuming that all INSERTS
     * are the same.
     * @param string $table Table to update
     * @param array $data Hash of data to update keyed by list
     * @param array $list List of elements to insert
     * @return SQLite3Result
     */
    private function do_insert($table, $data, $list)
    {
        $query = sprintf('INSERT into %s ("', $table);
        $query .= implode('","',$list);
        $query .= '") VALUES (?';
        reset($list);
        $query .= str_repeat(',?', count($list) - 1);
        $query .= ');';
        $stmt = $this->prepare($query);
        reset($list);
        $i = 1;
        foreach ($list as $key) {
            $stmt->bindValue("$i", (in_array($key, $this->m_serialize) ? serialize($data[$key]) : $data[$key]));
            $i++;
        }
        if (!$stmt->execute()) {
            $this->_ok = false;
            $this->_log[] = "execute failed: $query";
            return false;
        }
        $stmt->close();
        return true;
    }

    /**
     * Return hex hash of string - Just need something *fast*
     * @param string $folder
     * @return string (hexint)
     */
    static public function getKey($folder)
    {
        return hash('md5', $folder);
    }

    static private function _get_folder_name($folder) {
        return sprintf('folder_%s', self::getKey($folder));
    }

    private function _allok()
    {
        $this->_ok = true;
        unset($this->_log);
        $this->_log = [];
    }
    /**
     * Get list of all available attachments
     * $this-attachments auto-populated with array
     * @param string $folder
     * @param string $uidl
     * @return array
     */
    public function &get_attachments($folder, $uidl)
    {
        $query = "SELECT * FROM attachs WHERE folder=:folder AND uidl=:uidl ;";
        $stmt = $this->prepare($query);
        $stmt->bindValue(':folder', $folder);
        $stmt->bindValue(':uidl', $uidl);
        $result = $stmt->execute($query);
        $this->attachments = [];
        if ($result) {
            while ($foo = $result->fetchArray(SQLITE3_ASSOC)) {
                $this->attachments[] = $foo;
            }
        } else {
            $this->_ok = false;
            $this->_log[] = "query failed: $query";
        }
        $stmt->close();
        return $this->attachments;
    }

    /**
     * Get list of all available folders/emailboxes
     * $this-folders auto-populated with hash
     * @return hash
     */
    public function &get_folders()
    {
        $query = 'SELECT * FROM folders';
        $result = $this->query($query);
        $this->folders = [];
        $this->allfolders = [];
        if ($result) {
            while ($foo = $result->fetchArray(SQLITE3_ASSOC)) {
                $this->allfolders[$foo['name']] = $foo;
                if (!in_array($foo['name'], $this->_invisible)) {
                    $this->folders[$foo['name']] = $foo;
                }
            }
        } else {
            $this->_ok = false;
            $this->_log[] = "query failed: $query";
        }
        return $this->folders;
    }

    /**
     * Add new folder/emailbox to DB
     * @param array $folder
     * @param boolean $calc_size
     * @return boolean
     */
    public function new_folder($folder, $calc_size = false)
    {
        $folder['system'] = in_array($folder['name'], $this->_system_folders);
        /*
         * Since user folder names can be weird, on the file system,
         * make the dirname for the folder something safe (ie: a md5 hash
         * of the name). This requires, of course, that when we
         * create the local directory, we use the same name. :/
         */
        if (empty($folder['dirname'])) {
            $folder['dirname'] = self::getKey($folder['name']);
        }
        if ($calc_size && is_dir($this->userfolder.$folder['dirname'])) {
            $folder['size'] = $this->calc_folder_size($this->userfolder.$folder['dirname']);
        }
        $table = self::_get_folder_name($folder['name']);
        $folder['table_name'] = $table;
        foreach (['size', 'count', 'unread'] as $f) {
            if (!isset($folder[$f])) {
                $folder[$f] = 0;
            }
        }
        /*
         * First create the new table for the new folder (to hold the messages)
         */
        $query = $this->create_query($table, $this->mschema);
        if ($this->exec($query)) {
            /*
             * Now add it to the folders tables and array
             */
            if ($this->do_insert('folders', $folder, array_keys($this->fschema))) {
                $this->folders[$folder['name']] = $folder;
                return true;
            } else {
                $this->_log[] = "do_insert exec failed:";
            }
        }
        $this->_ok = false;
        $this->_log[] = "new_folder exec failed: $query";
        return false;

    }

    /**
     * Remove/delete a folder from the DB
     * @param string $folder Folder name to rm from DB
     * @return boolean
     */
    public function del_folder($folder)
    {
        $query = 'DROP TABLE '.self::_get_folder_name($folder).' ;';
        if ($this->exec($query)) {
            $stmt = $this->prepare("DELETE FROM folders WHERE name=:name ;");
            $stmt->bindValue(':name', $folder);
            if ($stmt->execute()) {
                unset($this->folders[$folder]);
                $stmt->close();
                return true;
            }
        }
        $this->_ok = false;
        $this->_log[] = "exec failed: $query";
        return false;

    }

    /**
     * Update misc field in folders
     * @param string $folder Folder name
     * @param string $field Name of field
     * @return boolean
     */
    public function update_folder_field($folder, $field)
    {
        if (!isset($this->fschema[$field])) {
            $this->_ok = false;
            $this->_log[] = "bad field: $field";
            return false;
        }
        if (!isset($this->folders[$folder])) {
            $this->_ok = false;
            $this->_log[] = "bad folder name: $folder";
            return false;
        }
        $stmt = $this->prepare("UPDATE folders SET \"$field\"=:$field WHERE name=:name ;");
        $stmt->bindValue(':name', $folder);
        $stmt->bindValue(":$field", $this->folders[$folder][$field]);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $this->_ok = false;
            $this->_log[] = "execute failed: ";
            return false;
        }
    }

     /**
      * Update inited field in folders to current time
      * @param string $folder Folder name
      * @return boolean
      */
     public function current_version($folder, $version)
    {
        return ($this->folders[$folder]['version'] == $version);
    }

    /**
     * Update version field in folders
     * @param string $folder Folder name
     * @param int $version
     * @return boolean
     */
    public function upgrade_version($folder, $version)
    {
        $stmt = $this->prepare("UPDATE folders SET version=:version WHERE name=:name ;");
        $stmt->bindValue(':name', $folder);
        $this->folders[$folder]['version'] = $version;
        $stmt->bindValue(':version', $this->folders[$folder]['version']);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $this->_ok = false;
            $this->_log[] = "execute failed: ";
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
    public function &get_messages($folder, $force = false, $sortby = "", $sortorder = "")
    {
        if ($folder != $this->active_folder || $force) {
            $this->sync_messages();
            $query = sprintf('SELECT * FROM %s ', self::_get_folder_name($folder));
            if ($sortby && isset($this->mschema[$sortby])) {
                $query .= "ORDER BY '$sortby' ";
                if ($sortorder == 'ASC' || $sortorder == 'DESC') {
                    $query .= " $sortorder ";
                }
            }
            $query .= ';';
            $result = $this->query($query);
            $this->messages = [];
            $this->_indb = [];
            $this->m_idx = [];
            $index = 0;
            if ($result) {
                while ($foo = $result->fetchArray(SQLITE3_ASSOC)) {
                    foreach($this->m_serialize as $k) {
                        $foo[$k] = unserialize($foo[$k]);
                    }
                    $this->messages[$index] = $foo;
                    $this->messages[$index]['idx'] = $index;
                    $this->m_idx[$foo['uidl']] = $index;
                    $this->_indb[$foo['uidl']] = true;
                    $index++;
                }
                $this->active_folder = $folder;
            } else {
                $this->_ok = false;
                $this->_log[] = "query failed: $query";
            }
        }
        return $this->messages;
    }

    /**
     * Get count of all email message headers in folder/emailbox
     * $this->headers is NOT changed!
     * @param string $folder
     * @param boolean $force TRUE to force a resync
     * @return array
     */
    public function count_messages($folder, $force = false)
    {
        if ($folder != $this->active_folder || $force) {
            $query = sprintf('SELECT COUNT(*) FROM %s;', self::_get_folder_name($folder));
            $result = $this->query($query);
            if ($result) {
                $count = $result->fetchArray(SQLITE3_NUM);
                return $count[0];
            } else {
                $this->_ok = false;
                $this->_log[] = "query failed: $query";
                return null;
            }
        }
        return count($this->messages);
    }

    /**
     * Add new email message to folder
     * @param array $msg
     * @return boolean
     */
    public function new_message($msg)
    {
        $thelist = $this->create_uplist(array_keys($msg), $this->mschema);
        if ($thelist == null || !is_array($thelist)) {
            return false;
        }
        $this->_folder_need_sync[$msg['folder']] = true;
        return $this->do_insert(self::_get_folder_name($msg['folder']), $msg, $thelist);
    }

    /**
     * Take the email message array and update the fields in the DB
     * @param array $msg Message to be updated/synced in DB
     * @param Mixed $fields "*" for all, or array of fields
     * @return boolean
     */
    /*
     * The complexity is allow for the use of $this->mschema:
     *  Having the message schema defined in one location is nice.
     *  NOTE: Since the list of updated fields may change, re-use of
     *        prepared statements is kind of impossible
     */
    public function update_message($msg, $fields = "*")
    {
        $thelist = $this->create_uplist($fields, $this->mschema, ['uidl']);
        if ($thelist == null || !is_array($thelist)) {
            return false;
        }
        $this->_folder_need_sync[$msg['folder']] = true;
        return $this->do_update(self::_get_folder_name($msg['folder']), $msg, $thelist, ['uidl'=>$msg['uidl']]);
    }

    /**
     * Checks if message already exists
     * @param array $msg Message msg
     * @return boolean
     */
    public function message_exists($msg)
    {
        $uidl = $msg['uidl'];
        return (isset($this->m_idx[$uidl]) &&
            !empty($this->messages[$this->m_idx[$uidl]]['folder']));
    }

    /**
     * Add or update this->headers with the msg
     * @param array $msg Message msg
     */
    public function add_message($msg)
    {
        if (isset($this->m_idx[$msg['uidl']])) {
            $idx = $this->m_idx[$msg['uidl']];
            $keys = [];
            foreach ($msg as $k=>$v) {
                if (($v !== null) && ($this->messages[$idx][$k] != $v) && ($k != 'uidl')) {
                    $keys[] = $k;
                    $this->messages[$idx][$k] = $v;
                }
            }
            if (count($keys) > 0) {
                $this->m_delta[] = [$this->messages[$idx], $keys];
            }
        } else {
            $this->messages[] = $msg;
            end($this->messages);
            $index = key($this->messages);
            $this->messages[$index]['idx'] = $index;
            $this->m_idx[$msg['uidl']] = $index;
            reset($this->messages);
            $this->m_delta[] = [$this->messages[$index], ['*']];
        }
        $this->folders[$msg['folder']]['size'] += $msg['size'];
        $this->folders[$msg['folder']]['count'] += 1;
        if ($msg['unread']) {
            $this->folders[$msg['folder']]['unread'] += 1;
        }
        $this->_folder_need_sync[$msg['folder']] = true;
    }

    /**
     * Update all changed/new headers for all email messages
     * from the changed list. The idea being that if we have
     * a lot of bulk updates, it's best(??) to simply use
     * our PHP arrays and update the DB all in one go
     * when we are finishing up.
     * NOTE: We are smart enough to know which messages are
     *       new, and need to be INSERTed and which ones are
     *       old, and just need UPDATE. We know this via looking
     *       at the message's UIDL entry. If it's in the _indb[]
     *       array, then we've read this message from the DB and
     *       thus should UPDATE. If not, then we have a new
     *       message.
     * @return boolean
     */
    public function sync_messages()
    {
        $retval = true;
        $adds = [];
        $ups = [];
        /* We need to add 1st, and then allow for updates */
        if (count($this->m_delta) > 0) {
            foreach ($this->m_delta as $foo) {
                if (!isset($this->_indb[$foo[0]['uidl']])) {
                    $adds[] = $foo[0];
                } else {
                    $ups[] = $foo;
                }
            }
            if (count($adds) > 0) {
                foreach ($adds as $add) {
                    if (!$this->new_message($add)) {
                        $retval = false;
                    }
                }
            }
            if (count($ups) > 0) {
                foreach ($ups as $foo) {
                    if (!$this->update_message($foo[0], $foo[1])) {
                        $retval = false;
                    }
                }
            }
            unset($this->m_delta);
            $this->m_delta = [];
        }
        if (count($this->_folder_need_sync) > 0) {
            foreach ($this->_folder_need_sync as $name=>$v) {
                $this->do_update('folders', $this->folders[$name],
                    ['size', 'count', 'unread'], ['name' => $name]);
            }
            unset($this->_folder_need_sync);
            $this->_folder_need_sync = [];
        }

        return $retval;
    }

    /**
     * Delete email message(s) from DB (must all be in same folder)
     * @param array $msgs
     * @return bool
     */
    public function del_messages($msgs)
    {
        if (!is_array($msgs)) {
            $msgs = (array)$msgs;
        }
        $this->_ok = true;
        $query = sprintf("DELETE FROM %s WHERE uidl=:uidl ;", self::_get_folder_name($msgs[0]['folder']));
        $isactive = ($msgs[0]['folder'] == $this->active_folder ? true : false);
        $stmt = $this->prepare($query);
        $idxs = [];
        foreach ($msgs as $msg) {
            $idx = $msg['idx'];
            if (!isset($idxs[$idx])) {
                $idxs[$idx] = $idx;
                $stmt->bindValue(':uidl', $msg['uidl']);
                if (!$stmt->execute($query)) {
                    $this->_ok = false;
                    $this->_log[] = "exec failed: $query";
                } else {
                    $idxs[$idx] = $idx;
                }
                $this->folders[$msg['folder']]['size'] -= $msg['size'];
                $this->folders[$msg['folder']]['count'] -= 1;
                if ($msg['unread']) {
                    $this->folders[$msg['folder']]['unread'] -= 1;
                }
            }
        }
        /* If we deleted from the active folder, then update our array */
        if ($isactive) {
            foreach ($idxs as $idx) {
                unset($this->m_idx[$this->messages[$idx]['uidl']]);
                unset($this->messages[$idx]);
            }
        }
        $stmt->close();
        $this->$_folder_need_sync = true;
        return $this->_ok;
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
        $path = rtrim($path, '/').'/';

        foreach(scandir($path) as $f) {
            if ($f != "." && $f != "..") {
                $nfile = $path.$f;
                if (is_dir($nfile)) {
                    $size = $this->calc_folder_size($nfile);
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

    public function status()
    {
        $ret = [$this->_ok, $this->_log];
        $this->_allok();
        return $ret;
    }
}
