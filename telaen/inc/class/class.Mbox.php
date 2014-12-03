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
    private $table_headers =<<<EOF_HEADERS
        CREATE TABLE headers
        (crc32 INT NOT NULL,
        folder TEXT NOT NULL,
        headers TEXT NOT NULL);
EOF_HEADERS;
    private $table_folders =<<<EOF_FOLDERS
        CREATE TABLE folders
        (crc32 INT NOT NULL,
        folder TEXT NOT NULL);
EOF_FOLDERS;
    private $table_attachs =<<<EOF_ATTACHS
        CREATE TABLE attachs
        (crc32 INT NOT NULL,
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
        $this->open($this->db, SQLITE3_OPEN_READWRITE| SQLITE3_OPEN_CREATE);
        $try =  $this->query("SELECT name FROM sqlite_master WHERE type='table' AND name='folders';");
        if ($try->numColumns == 0) {
            $this->exec($this->table_folders);
            $this->exec($this->table_headers);
            $this->exec($this->table_attachs);
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

}
