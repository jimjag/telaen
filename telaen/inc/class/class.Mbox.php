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
    private $db = null;
    private $table_folders =<<<EOF_FOLDERS
        CREATE TABLE folders
        ('name' TEXT NOT NULL,
        'system' INT NOT NULL);
EOF_FOLDERS;
    private $table_attachs =<<<EOF_ATTACHS
        CREATE TABLE attachs
        ('id' TEXT NOT NULL,
        'localname' TEXT,
        'name' TEXT,
        'type' TEXT,
        'size' INT);
EOF_ATTACHS;
    public $folders = array();
    public $attachments = array();
    public $headers = array();
    public $system_folders = array('inbox', 'spam', 'trash', 'draft', 'sent', '_attachments', '_infos');

    /**
     * Construct: open DB and create tables if needed
     * @param type $userfolder
     */
    public function __construct($userfolder)
    {
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
    }


    /**
     * Get list of all message headers in folder/emailbox
     * $this->headers auto-populated with array
     * @param string $folder
     */
    public function get_headers($folder)
    {
        $query = sprintf('SELECT * FROM folder.%s;', $this->getKey($folder));
        $result = $this->query($query);
        $this->headers = array();
        while ($foo = $result->fetchArray()) {
            $this->headers[] = $foo;
        }
    }

    /**
     * Get list of all available attachments
     * $this-attachments auto-populated with array
     * @param string $folder
     * @param string $uidl
     */
    public function get_attachments($folder, $uidl)
    {
        $query = sprintf('SELECT * FROM attachs WHERE id=\'%s.%s\';', $this->getKey($folder), $this->getKey($uidl));
        $result = $this->query($query);
        $this->attachments = array();
        while ($foo = $result->fetchArray()) {
            $this->attachments[] = $foo;
        }
    }

    /**
     * Get list of all available folders/emailboxes
     * $this-folders auto-populated with hash
     */
    public function get_folders()
    {
        $stmt = $this->query('SELECT * FROM folders');
        $this->folders = array();
        while ($foo = $stmt->fetchArray()) {
            $this->folders[$foo['name']] = $foo;
        }
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
        'uidl' TEXT,
        'subject' TEXT,
        'from' TEXT,
        'fromname' TEXT,
        'to' TEXT,
        'cc' TEXT,
        'messageid' TEXT,
        'localname' TEXT,
        'header' TEXT);
EOF_MESSAGES;
        $query = sprintf($table, $this->getKey($folder));
        if ($this->query($query)) {
            $query = sprintf('INSERT into folders (name, system) VALUES (\'%s\', %d);',
                $folder, intval($sys));
            if ($this->query($query)) {
                $this->get_folders();
                return true;
            }
        }
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
        return $this->query($query);

    }
}
