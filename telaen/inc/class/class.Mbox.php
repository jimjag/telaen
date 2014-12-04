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
    private $table_folders =<<<EOF_FOLDERS
        CREATE TABLE folders
        ('name' TEXT NOT NULL,
        'system' INT NOT NULL);
EOF_FOLDERS;
    private $table_attachs =<<<EOF_ATTACHS
        CREATE TABLE attachs
        ('folder' TEXT NOT NULL,
        'uidl' TEXT NOT NULL,
        'localname' TEXT,
        'name' TEXT,
        'type' TEXT,
        'size' INT);
EOF_ATTACHS;
    public $folders = array();
    public $attachments = array();
    public $headers = array();
    public $system_folders = array('inbox', 'spam', 'trash', 'draft', 'sent', '_attachments', '_infos');
    public $ok = true;
    public $message = '';

    /**
     * Construct: open DB and create tables if needed
     * @param type $userfolder
     */
    public function __construct($userfolder)
    {
        $this->userfolder = $userfolder;
        $this->db = $userfolder.'_infos/mboxes.db';
        $exists = is_writable($this->db);
        parent::__construct($this->db, SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
        //$this->open($this->db, SQLITE3_OPEN_READWRITE| SQLITE3_OPEN_CREATE);
        $this->query('PRAGMA synchronous = 0;');
        $this->query('PRAGMA journal_mode = MEMORY;');
        if (!$exists) {
            $this->exec($this->table_folders);
            $this->exec($this->table_attachs);
            foreach($this->system_folders as $foo) {
                $this->add_folder($foo, 1);
            }
        }
        $this->get_folders();
        /*
         * We may have folders from previous installs. Check
         */
        $d = dir($userfolder);
        while ($entry = $d->read()) {
            if (is_dir($userfolder.$entry) &&
                $entry != '..' &&
                $entry != '.' &&
                !isset($this->folders[$entry])) {
                $this->add_folder($entry);
            }
        }
        $d->close();
        $this->allok();
    }

    private function allok()
    {
        $this->ok = 1;
        $this->message = '';
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
        $this->allok();
        if ($folder != $this->active_folder || $force) {
            $query = sprintf('SELECT * FROM folder_%s;', $this->getKey($folder));
            $stmt = $this->query($query);
            $this->headers = array();
            $index = 0;
            if ($stmt) {
                while ($foo = $stmt->fetchArray()) {
                    $this->headers[$index] = $foo;
                    $this->headers[$index]['index'] = $index;
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
     * Get list of all available attachments
     * $this-attachments auto-populated with array
     * @param string $folder
     * @param string $uidl
     * @return array
     */
    public function get_attachments($folder, $uidl)
    {
        $this->allok();
        $query = sprintf("SELECT * FROM attachs WHERE 'folder='%s' AND 'uidl'='%s' ;",
            $folder, $uidl);
        $stmt = $this->query($query);
        $this->attachments = array();
        if ($stmt) {
            while ($foo = $stmt->fetchArray()) {
                $this->attachments[] = $foo;
            }
        } else {
            $this->ok = false;
            $this->message = "query failed: $query";
        }
        return $this->attachments;
    }

    /**
     * Get list of all available folders/emailboxes
     * $this-folders auto-populated with hash
     * @return hash
     */
    public function get_folders()
    {
        $this->allok();
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
     * Return CRC32 hash of string
     * @param string $folder
     * @return int
     */
    public function getKey($folder)
    {
        return crc32($folder);
    }

    /**
     * Add new folder/emailbox to DB
     * @param string $folder
     * @param int $sys
     * @return boolean
     */
    public function add_folder($folder, $sys = 0)
    {
        $table =<<<EOF_MESSAGES
        CREATE TABLE folder_%s
        ('date' INT,
        'hparsed' INT,
        'id' INT,
        'msg' INT,
        'size' INT,
        'priority' INT,
        'attach' INT,
        'folder' TEXT,
        'uidl' TEXT,
        'subject' TEXT,
        'from' TEXT,
        'fromname' TEXT,
        'to' TEXT,
        'cc' TEXT,
        'flags' TEXT,
        'messageid' TEXT,
        'localname' TEXT,
        'header' TEXT);
EOF_MESSAGES;
        $this->allok();
        $query = sprintf($table, $this->getKey($folder));
        if ($this->query($query)) {
            $query = sprintf("INSERT into folders (name, system) VALUES ('%s', %d);",
                $folder, intval($sys));
            if ($this->query($query)) {
                $this->folders[$name] = intval($sys);
                return true;
            }
        }
        $this->ok = false;
        $this->message = "query failed: $query";
        return false;

    }

    /**
     * Remove/delete a folder from the DB
     * @param string $folder Folder to rm from DB
     * @return boolean
     */
    public function del_folder($folder)
    {
        $this->allok();
        $table ='DROP TABLE folder_%s ;';
        $query = sprintf($table, $this->getKey($folder));
        if (!$this->query($query)) {
            $this->ok = false;
            $this->message = "query failed: $query";
            return false;
        }
        unset($this->folders[$folder]);
        return true;

    }

    public function add_message($folder, $msg)
    {

    }


    public function del_message($msg)
    {
        $this->allok();
        $query = sprintf("DELETE FROM folder_%s WHERE 'uidl'='%s' ;", $msg['folder'], $msg['uidl']);
        if (!$this->query($query)) {
            $this->ok = false;
            $this->message = "query failed: $query";
            return false;
        }
        /* If we deleted from the active folder, then update our array */
        if ($folder == $this->active_folder) {
            unset($this->headers[$msg['index']]);
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
