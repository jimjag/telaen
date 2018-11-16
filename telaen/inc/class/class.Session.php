<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

/**
 * Session - Basic PHP Session helper class.
 * @package Telaen
 * @author Jim Jagielski (jimjag) <jimjag@gmail.com>
 */
namespace Telaen\Session;

class Session
{
    private $ss = null;
    private $id = 'default';
    private $sid = null;

    /**
     * Session creator
     * @param string Session ID string
     */
    public function __construct($sid)
    {
        $this->ss = &$_SESSION;
        $this->sid = $sid;
    }

    /**
     * Load PHP Session data
     * @param  string $id key of Session superglobal
     * @return array
     */
    public function &Load($id = 'default')
    {
        $this->id = $id;
        if (!is_array($this->ss[$this->id])) {
            $this->ss[$this->id] = [];
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
        $_SESSION = [];
    }
}
