<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

/**
 * LocalMox - SQLite3-based local caching and email storage.
 * @package Telaen
 * @author Jim Jagielski (jimjag) <jimjag@gmail.com>
 */
class LocalMbox extends SQLite3
{
    /**
     * @var string Current Emailbox/folder
     */
    private $current_folder = "";
    /**
     * @var string user's folder
     */
    private $userfolder = "";
    /**
     * @var string path to DB
     */
    private $db = null;
    /**
     * @var bool Force creation of all tables, even if they already exist
     */
    private $force_new = false;
    /**
     * @var array Schema of 'folders' table
     */
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
    /**
     * @var array Schema of 'attachs' table
     */
    private $aschema = array(
        'size' => 'INT DEFAULT 0',
        'flat' => 'INT DEFAULT 0',
        'cid' => 'TEXT DEFAULT ""',
        'folder' => 'TEXT NOT NULL',
        'disposition' => 'TEXT NOT NULL',
        'uidl' => 'TEXT NOT NULL',
        'localname' => 'TEXT DEFAULT ""',
        'name' => 'TEXT DEFAULT ""',
        'type' => 'TEXT DEFAULT ""',
        'subtype' => 'TEXT DEFAULT ""',
    );
    /**
     * @var array Schema of message data for each folder
     */
    private $mschema = array(
        'date' => 'INT DEFAULT 0',
        'id' => 'INT DEFAULT 0',
        'mnum' => 'INT DEFAULT 0', // message number
        'size' => 'INT DEFAULT 0',
        'attach' => 'INT DEFAULT 0', // Does it have attachments?
        'islocal' => 'INT DEFAULT 0', // Does it live on web server?
        'iscached' => 'INT DEFAULT 0', // Do we have a cached copy?
        'uid' => 'INT DEFAULT 0', // IMAP UID
        'flat' => 'INT DEFAULT 0',
        'unread' => 'INT DEFAULT 1',
        'bparsed' => 'INT DEFAULT 0', // Has body been parsed (for attachements)
        'subject' => 'TEXT DEFAULT ""',
        'message-id' => 'TEXT DEFAULT ""',
        'folder' => 'TEXT NOT NULL',
        'flags' => 'TEXT DEFAULT ""',
        'localname' => 'TEXT DEFAULT ""',
        'uidl' => 'TEXT NOT NULL PRIMARY KEY', // Our unique key (md5)
        'ouidl' => 'TEXT DEFAULT ""', // Old uidl from Telaen 1.x
        'header' => 'TEXT DEFAULT ""', // Raw header for Email
        'headers' => 'TEXT DEFAULT "a:0:{}"', // NOTE: array of headers
    );

    /**
     * @var array Hash: All Email boxes/folders; key = name
     */
    public $folders = [];
    /**
     * @var array List of all attachments per message
     */
    public $attachments = [];
    /**
     * @var array List: All messages from the current email folder;
     */
    public $messages = [];
    /**
     * @var array Hash: key = uidl; value = index to this->messages
     */
    public $m_idx = [];
    /**
     * @var array List of all folders/directories
     */
    public $allfolders = [];
    /**
     * @var string Directory name of the users' "info data" folder
     */
    public $udatafolder = '_infos';
    /**
     * @var array Hash: key = message; value = array() of field changes
     */
    public $m_delta = [];
    /**
     * @var array List of all folders/directories we need
     */
    private $_system_folders = ['inbox', 'spam', 'trash', 'draft', 'sent', '_attachments', '_infos', '_tmp'];
    /**
     * @var array List of folders/directors hidden from the user
     */
    private $_invisible = ['_attachments', '_infos', '_tmp'];
    /**
     * @var array Hash: key = uidl; value = is it in the DB?
     */
    private $_indb = [];
    /**
     * @var array List of folders that have been changed and need to be synced
     */
    private $_folder_need_sync = [];
    /**
     * @var bool Status
     */
    private $_ok = true;
    /**
     * @var array Log entries
     */
    private $_log = [];
    /**
     * @var array List
     * Some message elements are arrays, that need to be serialize when storing and
     * unserialize when read. Thankfully, all these are unique field names and
     * so we don't need to check that we are updating/inserting messages, specifically,
     * when serializing.
     */
    private $_m_serialize = ['headers'];

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
        $this->query('PRAGMA synchronous = 0;');
        $this->query('PRAGMA journal_mode = MEMORY;');
        if (!$exists || $force_new) {
            $this->initTables();
        }
        $this->getFolders();
        register_shutdown_function([$this, '__destruct']);
    }

    public function __destruct()
    {
        $this->syncMessages();
        $this->close();
    }

    /**
     * Create all required SQLite3 tables
     *
     */
    public function initTables()
    {
        $this->_allok();
        $table = $this->_createQuery('folders', $this->fschema);
        if ($this->exec($table) == false) {
            $this->_ok = false;
            $this->_log[] = "bad exec: $table";
        }

        $table = $this->_createQuery('attachs', $this->aschema);
        if ($this->exec($table) == false) {
            $this->_ok = false;
            $this->_log = "bad exec: $table";
        }
        $ok = $this->_ok;
        foreach($this->_system_folders as $foo) {
            $this->newFolder(['name' => $foo, 'dirname' => $foo]);
        }
        /*
         * We may have folders from previous installs. Check
         */
        foreach (scandir($this->userfolder) as $entry) {
            if (is_dir($this->userfolder.$entry)
                && $entry != '..'
                && $entry != '.'
                && !isset($this->folders[$entry])) {
                $this->newFolder(['name' => $entry, 'dirname' => $entry]);
            }
        }
        $this->_ok = $this->_ok && $ok;
        return $this->_ok;
    }

    /**
     * Return array of all required folders
     * @return array
     */
    public function requiredDirs() {
        return $this->_system_folders;
    }

    private function calcFolderSize($path)
    {
        $total_size = 0;
        $path = rtrim($path, '/').'/';

        foreach(scandir($path) as $f) {
            if ($f != "." && $f != "..") {
                $nfile = $path.$f;
                if (is_dir($nfile)) {
                    $size = $this->calcFolderSize($nfile);
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

    /**
     * Return Current status and log entries (if any).
     * Resets all.
     * @return array
     */
    public function status()
    {
        $ret = [$this->_ok, $this->_log];
        $this->_allok();
        return $ret;
    }

    /**
     * Create array of allowable entry/type from a baseline schema
     * @param mixed $fields
     * @param array $schema
     * @return array
     */
    private function _createUplist($fields, $schema, $ignore=[])
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
    private function _createQuery($table, $schema)
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
    private function _doUpdate($table, $data, $list, $where)
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
            $stmt->bindValue("$i", (in_array($key, $this->_m_serialize) ? serialize($data[$key]) : $data[$key]));
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
    private function _doInsert($table, $data, $list)
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
            $stmt->bindValue("$i", (in_array($key, $this->_m_serialize) ? serialize($data[$key]) : $data[$key]));
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

    static private function _get_folder_name($folder)
    {
        return sprintf('folder_%s', self::getKey($folder));
    }

    private function _allok()
    {
        $this->_ok = true;
        unset($this->_log);
        $this->_log = [];
    }

    /*********** Folders methods ***********/
    /**
     * Get list of all available folders/emailboxes
     * $this-folders auto-populated with hash
     * This is quick so a SELECT is OK.
     * @return array (reference)
     */
    public function &getFolders()
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
     * Get folder array
     * @param string $string
     * @return array
     */
    public function getFolder($name)
    {
        return $this->folders[$name];
    }

    /**
     * Add new folder/emailbox to DB
     * @param array $folder
     * @param boolean $calc_size
     * @return boolean
     */
    public function newFolder($folder, $calc_size = false)
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
            $folder['size'] = $this->calcFolderSize($this->userfolder.$folder['dirname']);
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
        $query = $this->_createQuery($table, $this->mschema);
        if ($this->exec($query)) {
            /*
             * Now add it to the folders tables and array
             */
            if ($this->_doInsert('folders', $folder, array_keys($this->fschema))) {
                $this->folders[$folder['name']] = $folder;
                return true;
            } else {
                $this->_log[] = "_doInsert exec failed:";
            }
        }
        $this->_ok = false;
        $this->_log[] = "newFolder exec failed: $query";
        return false;

    }

    /**
     * Remove/delete a folder from the DB
     * @param string $folder Folder name to rm from DB
     * @return boolean
     */
    public function delFolder($folder)
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
    public function updateFolderField($folder, $field)
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
        $stmt = $this->prepare("UPDATE folders SET \"$field\"=:val WHERE name=:name ;");
        $stmt->bindValue(':name', $folder);
        $stmt->bindValue(":val", $this->folders[$folder][$field]);
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
     public function currentVersion($folder, $version)
    {
        return ($this->folders[$folder]['version'] == $version);
    }

    /**
     * Update version field in folders
     * @param string $folder Folder name
     * @param int $version
     * @return boolean
     */
    public function upgradeVersion($folder, $version)
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

    /*********** Messages methods ***********/

    /**
     * Get list of all email message headers in folder/emailbox
     * $this->headers auto-populated with array
     * @param string $folder
     * @param boolean $force TRUE to force a resync
     * @param string $sortby
     * @param string $sortorder
     * @return array
     */
    public function getMessages($folder, $force = false, $sortby = "", $sortorder = "")
    {
        if ($folder != $this->current_folder || $force) {
            /* keep sorting info between calls */
            static $ssortby = "";
            static $ssortorder = "";
            if ($sortby != $ssortby) {
                $ssortby = $sortby;
            }
            if ($sortorder != $ssortorder) {
                $ssortorder = $sortorder;
            }
            $this->syncMessages();
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
                    foreach($this->_m_serialize as $k) {
                        $foo[$k] = unserialize($foo[$k]);
                    }
                    $this->messages[$index] = $foo;
                    $this->messages[$index]['idx'] = $index;
                    $this->m_idx[$foo['uidl']] = $index;
                    $this->_indb[$foo['uidl']] = true;
                    $index++;
                }
                $this->current_folder = $folder;
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
    public function countMessages($folder, $force = false)
    {
        if ($folder != $this->current_folder || $force) {
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
     * @param boolean $adj
     * @return boolean
     */
    public function newMessage($msg, $adj = false)
    {
        $thelist = $this->_createUplist(array_keys($msg), $this->mschema);
        if ($thelist == null || !is_array($thelist)) {
            return false;
        }
        if ($adj) {
            $this->folders[$msg['folder']]['size'] += $msg['size'];
            $this->folders[$msg['folder']]['count'] += 1;
            if ($msg['unread']) {
                $this->folders[$msg['folder']]['unread'] += 1;
            }
            $this->_folder_need_sync[$msg['folder']] = true;
        }
        return $this->_doInsert(self::_get_folder_name($msg['folder']), $msg, $thelist);
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
    public function updateMessage($msg, $fields = "*")
    {
        $thelist = $this->_createUplist($fields, $this->mschema, ['uidl']);
        if ($thelist == null || !is_array($thelist)) {
            return false;
        }
        $this->_folder_need_sync[$msg['folder']] = true;
        return $this->_doUpdate(self::_get_folder_name($msg['folder']), $msg, $thelist, ['uidl'=>$msg['uidl']]);
    }

    /**
     * Return the message associated w/ an ID
     * If folder is not active folder, reset as needed
     * @param string $id ID of message, either UIDL or index
     * @param string $folder Folder of message (or current folder if '')
     * @param boolean $is_uidl Is ID UIDL (true) or index (false)
     * @return array
     */
    public function getMessage($id, $folder = '', $is_uidl = true)
    {
        if (!empty($folder)) {
            $was = $this->current_folder;
            $this->getMessages($folder);
        }
        if ($is_uidl) {
            $id = $this->m_idx[$id];
        }
        $msg = $this->messages[$id];
        if (!empty($folder) && !(empty($was))) {
            $this->getMessages($was);
        }
        return $msg;
    }

    /**
     * Checks if message already exists
     * @param array $msg Message msg
     * @return boolean
     */
    public function messageExists($msg)
    {
        $uidl = $msg['uidl'];
        return (isset($this->m_idx[$uidl]) &&
            !empty($this->messages[$this->m_idx[$uidl]]['folder']));
    }

    /**
     * Add or update this->headers with the msg
     * @param array $msg Message msg
     */
    public function doMessage($msg)
    {
        if (isset($this->m_idx[$msg['uidl']])) {
            /* This is an UPDATE */
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
            /* This is an INSERT */
            $this->messages[] = $msg;
            end($this->messages);
            $index = key($this->messages);
            $this->messages[$index]['idx'] = $index;
            $this->m_idx[$msg['uidl']] = $index;
            reset($this->messages);
            $this->m_delta[] = [$this->messages[$index], ['*']];
            $this->folders[$msg['folder']]['size'] += $msg['size'];
            $this->folders[$msg['folder']]['count'] += 1;
            if ($msg['unread']) {
                $this->folders[$msg['folder']]['unread'] += 1;
            }
            $this->_folder_need_sync[$msg['folder']] = true;
        }
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
    public function syncMessages()
    {
        $retval = true;
        $adds = [];
        $ups = [];
        /* We need to add 1st, and then allow for updates */
        if (count($this->m_delta) > 0) {
            foreach ($this->m_delta as $foo) {
                if (!isset($this->_indb[$foo[0]['uidl']])) {
                    $adds[] = $foo[0];
                    $this->_indb[$foo[0]['uidl']] = true;
                } else {
                    $ups[] = $foo;
                }
            }
            if (count($adds) > 0) {
                foreach ($adds as $add) {
                    if (!$this->newMessage($add)) {
                        $retval = false;
                    }
                }
            }
            if (count($ups) > 0) {
                foreach ($ups as $foo) {
                    if (!$this->updateMessage($foo[0], $foo[1])) {
                        $retval = false;
                    }
                }
            }
            unset($this->m_delta);
            $this->m_delta = [];
        }
        if (count($this->_folder_need_sync) > 0) {
            foreach ($this->_folder_need_sync as $name=>$v) {
                $this->_doUpdate('folders', $this->folders[$name],
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
    public function delMessages($msgs)
    {
        if (!is_array($msgs)) {
            $msgs = (array)$msgs;
        }
        $this->_ok = true;
        $query = sprintf("DELETE FROM %s WHERE uidl=:uidl ;", self::_get_folder_name($msgs[0]['folder']));
        $isactive = ($msgs[0]['folder'] == $this->current_folder ? true : false);
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
        $this->_folder_need_sync[$msgs[0]['folder']] = true;
        return $this->_ok;
    }

    /*********** Attachments methods ***********/

    /**
     * Get list of all available attachments associated with
     * this particular email message
     * $this-attachments auto-populated with array
     * @param array $msg
     * @return array
     */
    public function getAttachments($msg)
    {
        $query = "SELECT * FROM attachs WHERE folder=:folder AND uidl=:uidl ;";
        $stmt = $this->prepare($query);
        $stmt->bindValue(':folder', $msg['folder']);
        $stmt->bindValue(':uidl', $msg['uidl']);
        $result = $stmt->execute($query);
        $this->attachments = [];
        if ($result) {
            $i = 0;
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
    public function addAttachment($attachment)
    {
        $thelist = $this->_createUplist(array_keys($attachment), $this->aschema);
        if ($thelist == null || !is_array($thelist)) {
            return false;
        }
        $this->attachments[] = $attachment;
        return $this->_doInsert('attachs', $attachment, $thelist);

    }


    public function delAttachment($folder, $msg)
    {

    }

}
