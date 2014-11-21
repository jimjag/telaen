<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

/**
 * Simple PHP Helper for sessions
 */
class Session
{
    private $ss = null;
    private $index = 'default';

    /**
     * Session creator
     */
    public function Session()
    {
        $this->ss = &$_SESSION;
    }

    /**
     * Load PHP Session data
     * @param  string $index key of Session superglobal
     * @return string
     */
    public function &Load($index = 'default')
    {
        $this->index = $index;
        if (!is_array($this->ss[$this->index])) {
            $this->ss[$this->index] = array();
        }

        return $this->ss[$this->index];
    }

    /**
     * Reset Session key/value
     * @param array $array2save Array to save in Session
     */
    public function Save(&$array2save)
    {
        $this->ss[$this->index] = $array2save;
    }

    public function Kill()
    {
        @session_destroy();
        $_SESSION = array();
    }
}
