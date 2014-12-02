<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

/**
 * Simple PHP Helper for file-based Email data
 */
class Mbox
{
    private $path = "";

    public function __construct()
    {
    }

    /**
     * Load in Array from file
     * @param  string $path File to read
     * @return array
     */
    public function &Load($path)
    {
        $this->path = $path;
        $ret = array();
        if ($this->path) {
            $str = @file_get_contents($this->path);
            if ($str) {
                $ret = unserialize($str);
            }
        }

        return $ret;
    }

    /**
     * Save array to file
     * @param  array $array2save Array to tuck away
     * @return void
     */
    public function Save(&$array2save)
    {
        $f = fopen($this->path, 'w');
        if ($f) {
            fwrite($f, serialize($array2save));
            fclose($f);
        }
    }
}
