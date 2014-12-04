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
        (key INT NOT NULL,
        folder TEXT NOT NULL);
EOF_FOLDERS;
    private $table_attachs =<<<EOF_ATTACHS
        CREATE TABLE attachs
        (key INT NOT NULL,
        folder TEXT NOT NULL,
        localname TEXT,
        name TEXT,
        type TEXT,
        size TEXT);
EOF_ATTACHS;

    /**
     * Construct: open DB and create tables if needed
     * @param type $userfolder
     */
    public function __construct($userfolder)
    {
        $this->db = $userfolder.'_infos/mboxes.db';
        $exists = is_writable($this->db);
        $this->open($this->db, SQLITE3_OPEN_READWRITE| SQLITE3_OPEN_CREATE);
        $this->query('PRAGMA synchronous = 0;');
        $this->query('PRAGMA journal_mode = MEMORY;');
        if (!$exists) {
            $this->exec($this->table_folders);
            $this->exec($this->table_attachs);
            foreach(array('inbox', 'spam', 'trash', 'draft', 'sent') as $foo) {
                $this->add($foo);
                $this->query("INSERT into folders (key, folder) VALUES ({$this->getKey($foo)}, $foo;");
            }
        }
    }


    public function headers($id)
    {
        $stmt = $this->prepare('SELECT * FROM headers WHERE crc32=:id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        $rarr = array();
        while ($foo = $result->fetchArray()) {
            $rarr[] = $foo;
        }
        $stmt->close();
        return $rarr;
    }

    public function attachs($id)
    {
        $stmt = $this->prepare('SELECT * FROM attachs WHERE crc32=:id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        $rarr = array();
        while ($foo = $result->fetchArray()) {
            $rarr[] = $foo;
        }
        $stmt->close();
        return $rarr;
    }

    public function folders()
    {
        $stmt = $this->query('SELECT * FROM folders');
        $rarr = array();
        while ($foo = $stmt->fetchArray()) {
            $rarr[] = $foo;
        }
        return $rarr;
    }

    public function getKey($folder)
    {
        return crc32($folder);
    }

    public function add($folder)
    {
        $table =<<<EOF_MESSAGES
        CREATE TABLE $folder
        (key INT NOT NULL,
        folder TEXT NOT NULL,
        localname TEXT,
        name TEXT,
        type TEXT,
        size TEXT);
EOF_MESSAGES;
        $stmt = $this->prepare($table);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
   }
}
