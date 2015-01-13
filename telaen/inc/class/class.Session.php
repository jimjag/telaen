<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

/**
 * Simple PHP Helper Class for sessions
 */
class Session
{
    private $ss = null;
    private $id = 'default';
    private $sid = null;

    /**
     * Session creator
     */
    public function __construct($sid)
    {
        $this->ss = &$_SESSION;
        $this->sid = $sid;
    }

    /**
     * Load PHP Session data
     * @param  string $index key of Session superglobal
     * @return string
     */
    public function &Load($id = 'default')
    {
        $this->id = $id;
        if (!is_array($this->ss[$this->id])) {
            $this->ss[$this->id] = array();
        }
        return $this->ss[$this->id];
    }

    /**
     * Reset Session key/value
     * @param array $array2save Array to save in Session
     */
    public function Save(&$array2save)
    {
        $this->ss[$this->id] = $array2save;
    }

    public function Kill()
    {
        unset($this->sid);
        unset($this->ss[$this->id]);
        @session_destroy();
        $_SESSION = array();
    }
}
