<?php
// namespace Telaen;
require_once './inc/class/class.Telaen_core.php';
require_once './inc/vendor/class.tnef.php';

/**
 * Telaen - Main Telaen Class implementing webmail functionality.
 * @package Telaen
 * @author Jim Jagielski (jimjag) <jimjag@gmail.com>
 */
class Telaen extends Telaen_core
{
    /**
     * @var bool Does user have SPAM?
     */
    public $havespam       = false;
    /**
     * @var array Hash of IMAP/POP3 server capabilities
     */
    public $capabilities   = [];
    /**
     * @var string Current emailbox/folder in user
     */
    protected $_current_folder = '';
    /**
     * @var array Regex to check for for SPAM message in Subject line
     */
    protected $_spamregex      = ["^\*\*\*\*\*SPAM\*\*\*\*\*", "^\*\*\*\*\*VIRUS\*\*\*\*\*"];
    /**
     * @var string Email server URL / socket definition
     */
    protected $_serverurl      = '';
    /**
     * @var int Response number
     */
    protected $_respnum        = 0;
    /**
     * @var string Response string
     */
    protected $_respstr        = '';
    /**
     * @var int Telaen DB format number
     */
    protected $_version        = 2;
    /**
     * @var string Stored Email server greeting string
     */
    protected $_greeting       = '';
    /**
     * @var int Time snap
     */
    protected $_now = 0;

    const RESP_OK =   0;
    const RESP_NO =  -1;
    const RESP_BAD = -2;
    const RESP_BYE = -3;
    const RESP_NOK = -4;
    const RESP_UNKNOWN = 99;

    /* @var $tdb LocalMbox */

    /**
     * Contructor
     */
    public function __construct()
    {
        $this->_tnef = new TNEF();
        mb_internal_encoding("UTF-8");
        $this->_now = time();  // Save expensive calls to time()
        register_shutdown_function([$this, '__destruct']);
    }

    public function __destruct()
    {
        $this->mailDisconnect();
    }

    /**
     * Save on time() calls
     * @return int time()
     */
    public function now()
    {
        return $this->_now;
    }
    /**
     * Convert string from UTF7 (IMAP) to UTF8
     * @param string $string String to convert
     * @return string
     */
    static public function utf7_8($string)
    {
        return mb_convert_encoding($string, 'UTF-8', 'UTF7-IMAP');
    }

    /**
     * Convert string from UTF8 to UTF7 (IMAP)
     * @param string $string String to convert
     * @return string
     */
    static public function utf8_7($string)
    {
        return mb_convert_encoding($string, 'UTF7-IMAP', 'UTF-8');
    }

    /**
     * Detect if string is UTF8 (fast) (W3C)
     * @param string $string
     * @return boolean
     */
    static public function isUtf8($string)
    {
            return preg_match('%(?:
            [\xC2-\xDF][\x80-\xBF]
            |\xE0[\xA0-\xBF][\x80-\xBF]
            |[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}
            |\xED[\x80-\x9F][\x80-\xBF]
            |\xF0[\x90-\xBF][\x80-\xBF]{2}
            |[\xF1-\xF3][\x80-\xBF]{3}
            |\xF4[\x80-\x8F][\x80-\xBF]{2}
            )+%xs', $string);
    }

    /**
     * Is this a valid folder name? If so, gen it
     * @param string $name folder name to check
     * @return boolean
     */
    public function isValidFname($name)
    {
        $name = trim($name);
        if ($name == '') {
            return false;
        }
        // Folder names that match system folder names are NOT valid
        if ($this->isSystemFolder($name)) {
            return false;
        }
        return true;
    }

    /**
     * Check if we are connected to email server
     * @return boolean
     */
    public function mailConnected()
    {
        if (isset($this->_mail_connection) && is_resource($this->_mail_connection)) {
            $sock_status = @socket_get_status($this->_mail_connection);
            if ($sock_status['eof']) {
                @fclose($this->_mail_connection);
                $this->_mail_connection = null;
                return false;
            }
            return true;
        }
        return false;
    }

    /**
     *
     * @param  string $string Response string to parse
     * @return int
     */
    protected function _mailParseResp($string = null)
    {
        $resp = self::RESP_UNKNOWN;
        $match = [];
        if ($string == null) $string = $this->mailReadResponse();
        if ($this->mail_protocol == IMAP) {
            if (preg_match('|^\s*'.$this->_getSid().'\s+(OK|NO|BAD|BYE)(.*)$|i', trim($string), $match)) {
                $a = strtoupper($match[1]);
                switch ($a) {
                    case 'OK':
                        $resp = self::RESP_OK; break;
                    case 'NO':
                        $resp = self::RESP_NO; break;
                    case 'BAD':
                        $resp = self::RESP_BAD; break;
                    case 'BYE':
                        $resp = self::RESP_BYE; break;
                }
            }
        } else {
            if (preg_match('|^(...)(.*)$|i', trim($string), $match)) {
                if (strtoupper($match[1]) == '+OK') {
                    $resp = self::RESP_OK;
                } else {
                    $resp = self::RESP_NOK;
                }
            } else {
                $resp = self::RESP_NOK;
            }
        }
        $this->_respnum = $resp;
        $this->_respstr = trim($match[2]);
        return $resp;
    }

    /**
     *
     * @param  string  $string Response string to checkout
     * @return boolean True if we saw an explicit OK
     */
    public function mailOkResp($string = null)
    {
        if ($string == null) $string = $this->mailReadResponse();
        $resp = $this->_mailParseResp($string);
        return ($resp == self::RESP_OK);
    }

    /**
     *
     * @param  string  $string Response string to checkout
     * @return boolean True if we saw an explicit error
     */
    public function mailNokResp($string = null)
    {
        if ($string == null) $string = $this->mailReadResponse();
        $resp = $this->_mailParseResp($string);
        return ($resp < self::RESP_OK);
    }

    /*
     * Read in a response line from server
     * @return string
     */
    public function mailReadResponse()
    {
        $buffer = @fgets($this->_mail_connection, 8192);
        $buffer = preg_replace('|\r?\n|', "\r\n", $buffer);
        $this->debugMsg($buffer, __FUNCTION__, __LINE__);
        return $buffer;
    }

    /**
     * Send the supplied command to the mail server. Auto-
     * appends the required EOL chars to the command.
     * @param string $cmd Command to send
     * @param array $opt 'autolog' = login as needed; 'addtag' = auto add IMAP id
     * @return boolean
     */
    public function mailSendCommand($cmd, $opt=['autolog' => true, 'addtag' => true])
    {
        $cmd = trim($cmd).$this->CRLF;
        $output = (preg_match('/^(PASS|LOGIN)/', $cmd, $regs)) ? $regs[1]." ****" : $cmd;
        if (!$this->mailConnect()) {
            $this->triggerError("could not connect to server", __FUNCTION__, __LINE__);
            return false;
        }
        if (!$this->_authenticated && $opt['autolog']) {
            if (!$this->mailAuth()) {
                $this->triggerError("could not auto_login: $output", __FUNCTION__, __LINE__);
                return false;
            }
        }
        if ($this->mail_protocol == IMAP && $opt['addtag']) {
            $cmd = $this->_getSid(true).' '.$cmd;
            $output = $this->_getSid().' '.$output;
        }
        $this->debugMsg($output, __FUNCTION__, __LINE__);
        return (boolean)fwrite($this->_mail_connection, $cmd);
}

    /**
     * Send the supplied commands to the mail server. Auto-
     * appends the required EOL chars to the command.
     * @param array $cmd Commands to send
     * @param array $opt 'autolog' = login as needed; 'addtag' = auto add IMAP id
     * @return boolean
     */
    public function mailSendCommands($cmds, $opt=['autolog' => true, 'addtag' => true])
    {
        if (!is_array($cmds)) {
            $cmds = (array) $cmds;
        }
        foreach ($cmds as $cmd) {
            if (!$this->mailSendCommand($cmd, $opt)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Connect to email server. TRUE if successful
     * @return boolean
     */
    public function mailConnect()
    {
        if (!$this->mailConnected()) {
            if (!$this->_serverurl) {
                $this->_serverurl = ($this->use_tls ? 'tls://' : 'tcp://').
                    $this->mail_server.':'.$this->mail_port;
            }
            $errno = 0;
            $errstr = 0;
            $this->_mail_connection = stream_socket_client($this->_serverurl, $errno, $errstr, 15);
            if ($this->_mail_connection) {
                $this->_greeting = $this->mailReadResponse();
                if ($this->mailOkResp($this->_greeting)) {
                    return true;
                }
            }
            $this->triggerError("Cannot connect to: $this->_serverurl", __FUNCTION__, __LINE__);
            return false;
        }
        return true;
    }

    private function _crammd5Response($challenge)
    {
        if (function_exists('hash_hmac')) {
            return base64_encode($this->mail_user.' '.hash_hmac('md5', $challenge, $this->mail_pass));
        }
        $pass = $this->mail_pass;
        if (strlen($pass) > 64) {
            $pass = pack('H*', md5($pass));
        }
        $pass = str_pad($pass, 64, chr(0x00));
        $ipad = str_repeat(chr(0x36), 64);
        $opad = str_repeat(chr(0x5c), 64);
        $hash = $this->md5(($pass ^ $opad).pack("H*", $this->md5(($pass ^ $ipad).$challenge)));
        return base64_encode($this->mail_user.' '.$hash);
    }

    /**
     * Authentication for IMAP
     * @return boolean
     */
    protected function _mailAuthImap()
    {
        if ($this->upgrade_tls) {
            if (empty($this->capabilities['STARTTLS'])) {
                $this->triggerError("Want STARTTLS but server doesn't support it.", __FUNCTION__, __LINE__);
                return false;
            }
            $this->mailSendCommand('STARTTLS', ['autolog' => false]);
            if ($this->mailOkResp()) {
                stream_socket_enable_crypto($this->_mail_connection, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
            } else {
                $this->triggerError("STARTTLS failure", __FUNCTION__, __LINE__);
                return false;
            }
        }
        if (!empty($this->capabilities['AUTH=CRAM-MD5'])) {
            $this->mailSendCommand('AUTHENTICATE CRAM-MD5', ['autolog' => false]);
            $buffer = $this->mailReadResponse();
            if ($buffer[0] == '+') {
                $challenge = base64_decode(substr($buffer, 2));
                $challenge_response = $this->_crammd5Response($challenge);
                $this->mailSendCommand($challenge_response, ['autolog' => false, 'addtag' => false]);
                return $this->mailOkResp();
            } else {
                $this->triggerError("Tried CRAM-MD5 but got bad challenge. Downgrading to LOGIN", __FUNCTION__, __LINE__);
            }
        }
        $this->mailSendCommand('LOGIN '.$this->mail_user.' '.$this->mail_pass, ['autolog' => false]);
        return $this->mailOkResp();
    }

    /**
     * Authentication for POP3
     * @return boolean
     */
    protected function _mailAuthPop()
    {
        $tokens = [];
        if ($this->upgrade_tls) {
            if (empty($this->capabilities['STLS'])) {
                $this->triggerError("Want STLS but server doesn't support it.", __FUNCTION__, __LINE__);
                return false;
            }
            $this->mailSendCommand('STLS', ['autolog' => false]);
            if ($this->mailOkResp()) {
                stream_socket_enable_crypto($this->_mail_connection, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
            } else {
                $this->triggerError("STLS failure", __FUNCTION__, __LINE__);
                return false;
            }
        }
        if (!empty($this->capabilities['CRAM-MD5'])) {
            $this->mailSendCommand('AUTH CRAM-MD5', ['autolog' => false]);
            $buffer = $this->mailReadResponse();
            if ($buffer[0] == '+') {
                $challenge = base64_decode(substr($buffer, 2));
                $challenge_response = $this->_crammd5Response($challenge);
                $this->mailSendCommand($challenge_response, ['autolog' => false]);
                return $this->mailOkResp();
            } else {
                $this->triggerError("Tried CRAM-MD5 but got bad challenge. Trying others.", __FUNCTION__, __LINE__);
            }
        }
        if (!empty($this->capabilities['APOP']) && preg_match('/<.+@.+>/U', $this->_greeting, $tokens)) {
            $this->mailSendCommand('APOP '.$this->mail_user.' '.self::md5($tokens[0].$this->mail_pass), ['autolog' => false]);
        }
        // Classic login mode
        else {
            $this->mailSendCommand('USER '.$this->mail_user, ['autolog' => false]);

            if ($this->mailOkResp()) {
                $this->mailSendCommand('PASS '.$this->mail_pass, ['autolog' => false]);
            } else {
                return false;
            }
        }
        return $this->mailOkResp();
    }

    /**
     * Check if user is authenticated to the email server
     * @return boolean
     */
    public function mailAuth()
    {
        if ($this->mailConnected()) {
            if ($this->_authenticated) {
                return true;
            } else {
                if ($this->mail_protocol == IMAP) {
                    $this->_authenticated = $this->_mailAuthImap();
                } else {
                    $this->_authenticated = $this->_mailAuthPop();
                }
                // if ($this->_authenticated) $this->mailCapa();
                return $this->_authenticated;
            }
        }
        return false;
    }

    /**
     * Prep folders on initial login
     */
    public function prepLocalDirs()
    {
        $this->_mkdir($this->userfolder);

        $boxes = $this->mailListBoxes('*');

        if ($this->mail_protocol == IMAP && false) {  // skip for now

            $tmp = $this->tdb->folders;

            for ($i = 0;$i<count($boxes);$i++) {
                $current_folder = $boxes[$i]['name'];

                if ($this->isSystemFolder($current_folder)) {
                }

                while (list($index, $value) = each($tmp)) {
                    if ($current_folder == $value) {
                        unset($tmp[$index]);
                    }
                }
                reset($tmp);
            }

            while (list($index, $value) = each($tmp)) {
                $this->mailCreateBox($this->fixPrefix($value, 1));
            }

            for ($i = 0;$i<count($boxes);$i++) {
                $current_folder = $this->fixPrefix($boxes[$i]['name'], 1);
                if (!$this->isSystemFolder($current_folder)) {
                    $this->_mkdir($this->userfolder.$current_folder);
                }
            }
        }

        foreach ($this->tdb->requiredDirs() as $value) {
            $value = $this->fixPrefix($value, 1);
            $this->_mkdir($this->userfolder.$value);
        }
    }

    /**
     * Grab Email message content (body)
     * @param array $msg Message to grab (REF)
     * @param boolean $with_headers Return body and headers
     * @return string
     */
    protected function _mailRetrMsgImap(&$msg, $with_headers = true)
    {
        $msgheader = trim($msg['header']);
        list($path, $dir) = $this->getPath($msg);
        if (file_exists($path)) {
            if ($with_headers) {
                return $this->readFile($path, true);
            } else {
                return $this->_getBodyFromCache($path);
            }
        }
        $this->mailSendCommand("UID FETCH {$msg['uid']} BODY[TEXT]");
        $buffer = $this->mailReadResponse();
        if ($this->mailNokResp($buffer)) {
            return false;
        }

        $buffer = $this->mailReadResponse();
        $msgbody = $this->tstream();
        while (!$this->mailOkResp($buffer)) {
            if (!preg_match('|[ ]?\\*[ ]?[0-9]+[ ]?FETCH|i', $buffer)) {
                if ($buffer != ')') {
                    fwrite($msgbody, $buffer);
                }
            }
            $buffer = $this->mailReadResponse();
        }
        $msgheader .= "\r\nX-TLN-UIDL: ".$msg['uidl'];

        $pts = $this->tstream();
        rewind($msgbody);
        fwrite($pts, "$msgheader\r\n\r\n");
        $this->_sXfer($msgbody, $pts);
        $this->_mkdir($dir);
        $this->saveFile($path, $pts);
        rewind($pts);
        rewind($msgbody);
        if ($this->prefs['keep_on_server']) {
            $msg['iscached'] = true;
            $this->tdb->doMessage($msg, ['iscached']);
        } else {
            $this->mailDeleteMsg($msg);
            $msg['iscached'] = true;
            $msg['islocal'] = true;
            $this->tdb->doMessage($msg, ['iscached', 'islocal']);
        }
        if ($with_headers) {
            return $pts;
        } else {
            fclose($pts);
            return $msgbody;
        }
    }

    /**
     * Grab Email message content (body)
     * @param array $msg Message to grab (REF)
     * @param boolean $with_headers Return body and headers
     * @return string
     */
    protected function _mailRetrMsgPop(&$msg, $with_headers = true)
    {
        list($path, $dir) = $this->getPath($msg);
        if (file_exists($path)) {
            if ($with_headers) {
                return $this->readFile($path, true);
            } else {
                return $this->_getBodyFromCache($path);
            }
        }
        $command = ($this->config['mail_use_top']) ? 'TOP '.$msg['mnum'].' '.$msg['size'] : 'RETR '.$msg['mnum'];
        $this->mailSendCommand($command);

        $buffer = $this->mailReadResponse();

        if ($this->mailNokResp($buffer)) {
            return false;
        }
        $pts = $this->tstream();
        while (!self::_feof($this->_mail_connection)) {
            $buffer = $this->mailReadResponse();
            if (chop($buffer) == '.') {
                break;
            }
            fwrite($pts, $buffer);
        }
        $email = $this->fetchStructure($pts);
        fclose($pts);
        $header = $email['header'];
        $body = $email['body'];

        // Since we are pulling this message for the first
        // time from the server, we need to add in our UIDL
        // header. Thus, it will always now be available on
        // the cached/local version.
        $header .= "\r\nX-TLN-UIDL: ".$msg['uidl'];

        $pts = $this->tstream();
        rewind($body);
        fwrite($pts, "$header\r\n\r\n");
        $this->_sXfer($body, $pts);
        $this->_mkdir($dir);
        $this->saveFile($path, $pts);
        rewind($pts);
        rewind($body);
        if ($this->prefs['keep_on_server']) {
            $msg['iscached'] = true;
            $this->tdb->doMessage($msg, ['iscached']);
        } else {
            $this->mailDeleteMsg($msg);
            $msg['iscached'] = true;
            $msg['islocal'] = true;
            $this->tdb->doMessage($msg, ['iscached', 'islocal']);
        }
        if ($with_headers) {
            return $pts;
        } else {
            return $body;
        }
    }

    /**
     * Retrieve and return specific email message
     * @param  array  $msg   The message to obtain
     * @return mixed
     */
    public function mailRetrMsg(&$msg, $with_headers = true)
    {
        if ($this->mail_protocol == IMAP) {
            return $this->_mailRetrMsgImap($msg, $with_headers);
        } else {
            return $this->_mailRetrMsgPop($msg, $with_headers);
        }
    }

    /**
     * Retrieve and return specific email message
     * @param  array  $msg The message to obtain
     * @return resource
     */
    public function mailRetrPbody($msg)
    {
        $path = $this->getPath($msg)[0].$this->psuffix;
        $handle = @fopen($path, 'r');
        if ($handle !== null) {
            return $handle;
        }
        $this->triggerError("Cannot fopen path: $path", __FUNCTION__, __LINE__);
        return $this->blob('message not parsed');
    }

    protected function _mailRetrHeaderImap($msg)
    {
        if ($msg['header'] != '') {
            return $msg['header'];
        }
        $header = '';
        $this->mailSendCommand("UID FETCH {$msg['uid']} (RFC822.HEADER)");
        $buffer = $this->mailReadResponse();

        /* if any problem, stop the procedure */
        if ($this->mailNokResp($buffer)) {
            return $header;
        }

        /* the end mark is <sid> OK FETCH, we are waiting for it*/
        while (!$this->mailOkResp($buffer)) {
            $tbuffer = trim($buffer);
            /* skip 1st line  ' * 123 FETCH ...' */
            if (preg_match('|[ ]?\\*[ ]?([0-9]+)[ ]?FETCH|i', $buffer, $regs)) {
                ;
            /* wait for closing ')' */
            } elseif ($tbuffer != ")" && $tbuffer != '') {
                $header .= $buffer;
            }
            $buffer = $this->mailReadResponse();
        }
        return $header;
    }

    protected function _mailRetrHeaderPop($msg)
    {
        /*
         * Fetch headers serially. Very slow.
         */
        if ($msg['header'] != '') {
            return $msg['header'];
        }
        $this->mailSendCommand('TOP '.$msg['mnum'].' 0');
        $buffer = $this->mailReadResponse();
        /* if any problem with this messages list, stop the procedure */
        if ($this->mailNokResp($buffer)) {
            return false;
        }
        $header = '';;
        while (!self::_feof($this->_mail_connection)) {
            $buffer = $this->mailReadResponse();
            if (chop($buffer) == '.') {
                break;
            }
            if (strlen($buffer) > 3) {
                $header .= $buffer;
            }
        }

        if (!($pos = strpos($header, "\r\n\r\n") === false)) {
            $header = substr($header, 0, $pos);
        }

        return $header;
    }

    /**
     * Retrieve and return specific email message headers
     * @param  string $msg The message to obtain
     * @return string
     */
    public function mailRetrHeader($msg)
    {
        if ($this->mail_protocol == IMAP) {
            return $this->_mailRetrHeaderImap($msg);
        } else {
            return $this->_mailRetrHeaderPop($msg);
        }
    }

    protected function _mailDeleteMsgImap(&$msg, $send_to_trash = true, $save_only_read = false)
    {
        $read = (preg_match("|{$this->flags['seen']}|", $msg['flags'])) ? 1 : 0;

        /* check the message id to make sure that the messages still in the server */
        if ($this->_current_folder != $msg['folder']) {
            $boxinfo = $this->mailSelectBox($msg['folder']);
        }

        /* if any problem with the server, stop the function */
        if (!$this->mailOnServer($msg)) {
            $this->triggerError("message not on server! [{$msg['uidl']}]",
                __FUNCTION__, __LINE__);
            return false;
        }

        if ($send_to_trash
            && $msg['folder'] != 'trash'
            && (!$save_only_read || ($save_only_read && $read))) {
            $trash_folder = $this->fixPrefix('trash', 1);

            $this->mailSendCommand('COPY '.$msg['mnum'].':'.$msg['mnum']." \"$trash_folder\"");
            $buffer = $this->mailReadResponse();

            /* if any problem with the server, stop the function */
            if ($this->mailNokResp($buffer)) {
                return false;
            }
            $opath = $this->getPath($msg)[0];
            if (file_exists($opath)) {
                list($npath, $dir) = $this->getPath($msg, 'trash');
                $this->_mkdir($dir); // Just in case
                copy($opath, $npath);
                unlink($opath);
            }
        }
        $this->mailSetFlag($msg, $this->flags['deleted'], '+');

        return $this->tdb->delMessage($msg);
    }

    protected function _mailDeleteMsgPop(&$msg, $send_to_trash = true, $save_only_read = false)
    {
        $read = (preg_match("|{$this->flags['seen']}|", $msg['flags'])) ? 1 : 0;

        /* now we are working with POP3 */
        /* check the message id to make sure that the messages still in the server */
        $opath = $this->getPath($msg)[0];
        if ($msg['folder'] == 'inbox' && !$msg['islocal']) {
            /* compare the old and the new message uidl, if different, stop*/
            if (!$this->mailOnServer($msg)) {
                $this->triggerError("message not on server! [{$msg['uidl']}]",
                    __FUNCTION__, __LINE__);
                return false;
            }

            if (!file_exists($opath)) {
                if (!$this->mailRetrMsg($msg)) {
                    return false;
                }
                //$this->mailSetFlag($msg, $this->flags['seen'], '-');
            }

            $this->mailSendCommand('DELE '.$msg['mnum']);
            if ($this->mailNokResp()) {
                return false;
            }
            $this->tdb->shiftMessages($msg['mnum'], 'inbox');
        }

        if ($send_to_trash
            && $msg['folder'] != 'trash'
            && (!$save_only_read || ($save_only_read && $read))) {
            if (file_exists($opath)) {
                list($npath, $dir) = $this->getPath($msg, 'trash');
                $this->_mkdir($dir); // Just in case
                copy($opath, $npath);
                unlink($opath);
            }
        } else {
            if (file_exists($opath)) {
                unlink($opath);
            }
        }

        return $this->tdb->delMessage($msg);
    }

    /**
     * Delete specific email message
     * @param  string  $msg            The message to delete
     * @param  boolean $send_to_trash
     * @param  boolean $save_only_read
     * @return boolean
     */
    public function mailDeleteMsg(&$msg, $send_to_trash = null, $save_only_read = null)
    {
        if ($send_to_trash === null) {
            $send_to_trash = $this->prefs['send_to_trash'];
        }
        if ($save_only_read === null) {
            $save_only_read = $this->prefs['st_only_read'];
        }
        if ($this->mail_protocol == IMAP) {
            return $this->_mailDeleteMsgImap($msg, $send_to_trash, $save_only_read);
        } else {
            return $this->_mailDeleteMsgPop($msg, $send_to_trash, $save_only_read);
        }
    }

    protected function _mailMoveMsgImap(&$msg, $tofolder)
    {
        if ($tofolder != $msg['folder']) {
            /* check the message id to make sure that the message is still on the server */
            if ($this->_current_folder != $msg['folder']) {
                $boxinfo = $this->mailSelectBox($msg['folder']);
            }

            if (!$this->mailOnServer($msg)) {
                $this->triggerError("message not on server! [{$msg['uidl']}]",
                    __FUNCTION__, __LINE__);
                return false;
            }

            $tofolder = $this->fixPrefix($tofolder, 1);

            $this->mailSendCommand('COPY '.$msg['mnum'].':'.$msg['mnum']." \"$tofolder\"");
            /* if any problem with the server, stop the function */
            if ($this->mailNokResp()) {
                return false;
            }
            $opath = $this->getPath($msg)[0];
            if ($msg['iscached'] || file_exists($opath)) {
                list($npath, $dir) = $this->getPath($msg, $tofolder);
                $this->_mkdir($dir); // Just in case
                $this->debugMsg("copying $opath -> $npath");
                copy($opath, $npath);
                if (file_exists($npath)) {
                    if ($msg['bparsed'] || file_exists($opath.$this->psuffix)) {
                        $this->debugMsg("copying {$opath}{$this->psuffix} -> {$npath}{$this->psuffix}");
                        copy($opath.$this->psuffix, $npath.$this->psuffix);
                        unlink($opath.$this->psuffix);
                    }
                    unlink($opath);
                    $this->tdb->moveMessage($msg, $tofolder);
                } else {
                    $this->triggerError("Could not copy file! $opath -> $npath",
                        __FUNCTION__, __LINE__);
                }
            }
            $this->mailSetFlag($msg, $this->flags['deleted'], '+');
        }

        return true;
    }

    protected function _mailMoveMsgPop(&$msg, $tofolder)
    {
        $wasinbox = false;
        if ($tofolder != 'inbox') {
            $opath = $this->getPath($msg)[0];
            /* check the message id to make sure that the messages still in the server */
            if ($msg['folder'] == 'inbox' && !$msg['islocal']) {
                $wasinbox = true;
                if (!$this->mailOnServer($msg)) {
                    $this->triggerError("message not on server! [{$msg['uidl']}]",
                        __FUNCTION__, __LINE__);
                    return false;
                }

                if (!file_exists($opath)) {
                    if (!$this->mailRetrMsg($msg)) {
                        return false;
                    }
                    //$this->mailSetFlag($msg, $this->flags['seen'], '-');
                }
            }
            /*
             * ensure that the original file exists
             */
            if ($msg['iscached'] || file_exists($opath)) {
                list($npath, $dir) = $this->getPath($msg, $tofolder);
                $this->_mkdir($dir);
                $this->debugMsg("copying $opath -> $npath");
                copy($opath, $npath);
                // ensure that the copy exist
                if (file_exists($npath)) {
                    if ($msg['bparsed'] || file_exists($opath.$this->psuffix)) {
                        copy($opath.$this->psuffix, $npath.$this->psuffix);
                        $this->debugMsg("copying {$opath}{$this->psuffix} -> {$npath}{$this->psuffix}");
                        unlink($opath.$this->psuffix);
                    }
                    unlink($opath);
                    $this->tdb->moveMessage($msg, $tofolder);
                    /* No matter what, the message is now local */
                    $msg['islocal'] = true;
                    $this->tdb->updateMessage($msg, ['islocal']);
                    // delete from server if we are working on inbox
                    if ($wasinbox) {
                        $this->mailSendCommand('DELE '.$msg['mnum']);
                        if (!$this->mailOkResp()) {
                            return false;
                        }
                        $this->debugMsg("Shifting {$msg['mnum']}");
                        $this->tdb->shiftMessages($msg['mnum'], 'inbox');
                    }
                } else {
                    $this->triggerError("Could not copy file! $opath -> $npath",
                         __FUNCTION__, __LINE__);
                    return false;
                }
            } else {
                return false;
            }
        } else {
            /* We cannot move to Inbox */
            return false;
        }

        return true;
    }

    /**
     * Move specific email message
     * @param  array  $msg      The message to move
     * @param  string  $tofolder
     * @return boolean
     */
    public function mailMoveMsg(&$msg, $tofolder)
    {
        if ($this->mail_protocol == IMAP) {
            return $this->_mailMoveMsgImap($msg, $tofolder);
        } else {
            return $this->_mailMoveMsgPop($msg, $tofolder);
        }
    }

    protected function _mailListMsgsImap($boxname = 'inbox')
    {
        $msg = [];
        $header = '';
        $curmsg = $size = $flags = $uid = '';
        $counter = 0;
        $new = 0;
        /* select the mail box and make sure that it exists */
        $boxinfo = $this->mailSelectBox($boxname);
        $now = time();
        if (is_array($boxinfo) &&
            $boxinfo['exists'] &&
            $this->iamStale($boxname)) {
            /* if the box is ok, fetch the first to the last message, getting the size, header and uid */
            /* This is FAST under IMAP, so we scarf the whole dataset */

            $this->mailSendCommand('UID FETCH 1:* (FLAGS RFC822.SIZE RFC822.HEADER)');
            $buffer = $this->mailReadResponse();

            /* if any problem, stop the procedure */
            if ($this->mailNokResp($buffer)) {
                return $counter;
            }

            /* the end mark is <sid> OK FETCH, we are waiting for it*/
            while (!$this->mailOkResp($buffer)) {
                $tbuffer = trim($buffer);
                /* if the return is something such as * N FETCH, a new message will displayed  */
                if (preg_match('|[ ]?\\*[ ]?([0-9]+)[ ]?FETCH|i', $buffer, $regs)) {
                    $curmsg = $regs[1];
                    preg_match('|SIZE[ ]?([0-9]+)|i', $buffer, $regs);
                    $size = $regs[1];
                    preg_match('|FLAGS[ ]?\\((.*)\\)|i', $buffer, $regs);
                    $flags = $regs[1];
                    preg_match('|UID[ ]?([0-9]+)|i', $buffer, $regs);
                    $uid = $regs[1];
                /* if any problem, add the current line to buffer */
                } elseif ($tbuffer != ")" && $tbuffer != '') {
                    $header .= $buffer;

                /*	the end of message header was reached, increment the counter and store the last message */
                } elseif ($tbuffer == ")") {
                    $msg['uidl'] = self::md5($uid);
                    if (!$this->tdb->messageExists($msg)) {
                        $msg['id'] = $counter + 1; //$msgs[0];
                        $msg['mnum'] = intval($curmsg);
                        $msg['size'] = intval($size);
                        $msg['flags'] = strtoupper($flags);
                        if (!preg_match('|'.$this->flags['seen'].'|', $msg['flags'])) {
                            $msg['unread'] = true;
                        }
                        $msg['folder'] = $boxname;
                        $msg['islocal'] = false;
                        $msg['uid'] = $uid;
                        $mail_info = $this->parseHeaders($header);
                        self::add2me($msg, $mail_info);
                        $this->tdb->doMessage($msg);
                        $new++;
                    }
                    unset($msg);
                    $msg = [];
                    $header = '';
                    $counter++;
                }
                $buffer = $this->mailReadResponse();
                $this->unStale($boxname);
            }
        }
        return $new;
    }

    protected function _mailListMsgsPop($boxname = 'inbox')
    {
        // $this->havespam = '';

        $msg = [];
        $counter = 0;
        $new = 0;
        /*
        NOTE how special inbox is... This is the only Email box that lives on
        the actual Email server (the pophost) and so we need to jump thru some
        hoops to determine which messages are there.
        */

        /*
        Due to how SLOW POP is, if we are keeping Email on the server, we simply
        read in the full list of messages but don't worry about headers at all, until
        we really, really need to.
        */
        if ($boxname == 'inbox' && $this->iamStale($boxname)) {
            /*
             * First, grab list of UIDLs and message numbers from the server
             * If we have these, then we can populate and add the message
             * immediately, otherwise, we need to do so one at a time
             */
            $uids = [];
            $nouids = [];
            if (!empty($this->capabilities['UIDL'])) {
                $this->mailSendCommand("UIDL");
                $buffer = $this->mailReadResponse();
                if ($this->mailOkResp($buffer)) {
                    while (!self::_feof($this->_mail_connection)) {
                        $buffer = $this->mailReadResponse();
                        if(trim($buffer) == ".") {
                            break;
                        }
                        list ($num,$uidl) = preg_split("|\s+|", $buffer);
                        if (!empty($uidl)) {
                            $uids[intval($num)] = self::md5($uidl);
                        }
                    }
                }
            }

            /* First, see what messages live on the server */
            $this->mailSendCommand('LIST');
            /* if any problem with this messages list, stop the procedure */
            if ($this->mailNokResp()) {
                return $counter;
            }
            while (!self::_feof($this->_mail_connection)) {
                $buffer = $this->mailReadResponse();
                $buffer = chop($buffer); // trim buffer here avoid CRLF include on msg size (causes error on TOP)
                if ($buffer == '.') {
                    break;
                }
                $msgs = preg_split("|\s+|", $buffer);
                if (is_numeric($msgs[0])) {
                    $mnum = intval($msgs[0]);
                    $msg['id'] = $counter + 1; //$msgs[0];
                    $msg['mnum'] = $mnum;
                    $msg['size'] = intval($msgs[1]);
                    $msg['folder'] = $boxname;
                    $msg['islocal'] = false;
                    $msg['unread'] = true;
                    /* If we have a UIDL, then use it, otherwise, we check later */
                    if (isset($uids[$mnum])) {
                        $msg['uidl'] = $uids[$mnum];
                        if (!$this->tdb->messageExists($msg)) {
                            $this->tdb->doMessage($msg);
                            $new++;
                        }
                    } else {
                        $nouids[] = $msg;
                    }
                    unset($msg);
                    $msg = [];
                    $counter++;
                }
            }
            foreach ($nouids as $msg) {
                $msg['uidl'] = $this->_mailGetUidl($msg);
                if (!$this->tdb->messageExists($msg)) {
                    $this->tdb->doMessage($msg);
                    $new++;
                }
            }
        }
        $this->unStale($boxname);
        return $new;
    }

    private function _scanFolder($boxname, $folder, &$i, $flat = true)
    {
        foreach (scandir($folder) as $entry) {
            if ($entry == '' || $entry == '.' || $entry == '..') {
                continue;
            }
            $fullpath = $folder.'/'.$entry;
            if (is_file($fullpath) && substr($fullpath, -(strlen($this->suffix))) == $this->suffix) {
                unset($msg);
                $msg = [];
                $thisheader = $this->_getHeadersFromCache($fullpath);
                $msg['id'] = $i + 1;
                $msg['mnum'] = $i;
                $msg['size'] = filesize($fullpath);
                $msg['localname'] = $entry;
                $msg['folder'] = $boxname;
                // $msg['islocal'] = true;
                $msg['iscached'] = true;
                $msg['flat'] = $flat;
                $mail_info = $this->parseHeaders($thisheader);
                self::add2me($msg, $mail_info);
                $msg['uidl'] = $this->_mailGetUidl($msg);
                $msg['bparsed'] = is_file($fullpath.$this->psuffix);
                $this->tdb->doMessage($msg);
                $i++;
            }
            if (is_dir($fullpath)) {
                $this->_scanFolder($boxname, $fullpath, $i, false);
            }
        }
    }

    /**
     * List all messages in emailbox
     * @param  string  $boxname       The name of emailbox
     * @param  integer $start
     * @param  integer $wcount
     * @return array
     */
    public function mailListMsgs($boxname = 'inbox', $start = 0, $wcount = 1024)
    {
        $fetched_part = 0;
        $parallelized = 0;
        // $this->havespam = '';

        // First get info from DB
        $this->tdb->getMessages($boxname);
        if (!$this->tdb->currentVersion($boxname, $this->_version)) {
            /*
             * Ideally, we do this only once per user, after which any changes
             * to the local system will be also reflected automatically in the DB.
             * If no email is stored locally, though, we do this everytime
             * (but no messages exist, so it's moot)
             */
            $this->tdb->upgradeVersion($boxname, $this->_version);
            $datapath = $this->userfolder.$this->getBoxDir($boxname);
            $i = 0;
            $this->_scanFolder($boxname, $datapath, $i, true);
        }
        /* choose the protocol and get list from server */
        if ($this->mail_protocol == IMAP) {
            $this->_mailListMsgsImap($boxname);
        } else {
            $this->_mailListMsgsPop($boxname);
        }
        $messages = $this->tdb->getMessages($boxname);
        /*
         * OK, now we have the message list, that contains id and size and possibly
         * the header as well (if not, we grab as needed).
         * This script will process the header to get subject, date and other
         * informations formatted to be displayed in the message list when needed
         */
        $i = 0;
        $j = 0;
        $y = 0;
        $spamcopy = [];
        $mcount = count($messages);
        $end_pos = $start + $wcount;
        /*
         * For all entries outside of the view window, simply copy over
         * the messages, regardless if whether we have headers or not.
         *
         * Here's the idea: Starting from the beginning, if the message is
         * outside of the view window, then only worry about SPAM
         * if the header has already been parsed. If not, then just
         * copy away.
         */
        for ($i = 0; $i < $mcount; $i++) {
            $workit = false;
            if ((($j < $start) || ($j >= $end_pos)) && !empty($messages[$i]['header'])) {
                $workit = true;
            }
            if (($j >= $start) && ($j <= $end_pos)) {
                $workit = true;
            }

            if (!$workit) {
                $j++;
                continue;
            }
            /*
             * At this point, we are within the view window. So we need
             * headers for the message list. We also check for SPAM here
             * as well
             */
            if (empty($messages[$i]['header'])) {
                $messages[$i]['header'] = $this->mailRetrHeader($messages[$i]);
                $mail_info = $this->parseHeaders($messages[$i]['header']);
                self::add2me($messages[$i], $mail_info);

                if ($messages[$i]['localname'] == '') {
                    $messages[$i]['localname'] = $this->_createLocalFname($messages[$i]);
                    $messages[$i]['flat'] = false;
                }
                $this->tdb->doMessage($messages[$i]);
            }
            $isspam = false;
            $spamsubject = $messages[$i]['subject'];
            $xspamlevel = $messages[$i]['headers']['x-spam-level'];
            /*
             * Only auto-populate the SPAM folder if
             * we have _autospamfolder set :)
             */
            if ($this->prefs['autospamfolder']) {
                foreach ($this->_spamregex as $spamregex) {
                    if (preg_match("/$spamregex/i", $spamsubject)) {
                        $this->havespam = $isspam = true;
                        break;
                    }
                }
                if ($this->prefs['spamlevel']) {
                    preg_match('|[*+]+|', $xspamlevel, $matches);
                    if (strlen($matches[0]) >= $this->prefs['spamlevel']) {
                        $this->havespam = $isspam = true;
                    }
                }
            }

            if ($isspam) {
                /*
                 * This message is spam... we need to move it to the SPAM
                 * folder
                 */
                $spamcopy[$y] = $messages[$i];
                if ($messages[$i]['hparsed']) {
                    $y++;
                    continue;
                }

                $y++;
            }
        }
        return $messages;
    }

    protected function _mailListBoxesImap($boxname = '')
    {
        if ($boxname == '*') {
            $this->mailSendCommand("LIST \"\" $boxname");
            $buffer = $this->mailReadResponse();
            /* if any problem, stop the script */
            if ($this->mailNokResp($buffer)) {
                return $this->tdb->folders;
            }
            /* loop throught the list and split the parts */
            while (!$this->mailOkResp($buffer)) {
                $tmp = [];
                preg_match('|\\((.*)\\)|', $buffer, $regs);
                $flags = $regs[1];
                $tmp['flags'] = $flags;

                preg_match('|\\((.*)\\)|', $buffer, $regs);
                $flags = $regs[1];

                $pos = strpos($buffer, ")");
                $rest = substr($buffer, $pos + 2);
                $pos = strpos($rest, ' ');
                $tmp['prefix'] = preg_replace('|"(.*)"|', "$1", substr($rest, 0, $pos));
                $tmp['name'] = self::utf7_8($this->fixPrefix(trim(preg_replace('|"(.*)"|', "$1",
                    substr($rest, $pos + 1))), 0));
                $buffer = $this->mailReadResponse();
                if (empty($this->$tdb->folders[$tmp['name']])) {
                    $this->tdb->newFolder($tmp);
                }
            }
        }
        return $this->tdb->folders;
    }

    public function _mailListBoxesPop($boxname = '')
    {
        return $this->tdb->folders;
    }
    /**
     * List available emailboxes
     * @param  string $boxname If specific name or glob
     * @return array
     */
    public function mailListBoxes($boxname = '')
    {
        if ($this->mail_protocol == IMAP) {
            return $this->_mailListBoxesImap($boxname);
        } else {
            return $this->_mailListBoxesPop($boxname);
        }
    }

    protected function _mailOnServerImap($msg)
    {
        /* select the mail box and make sure that it exists */
        $boxname = $msg['folder'];
        $boxinfo = $this->mailSelectBox($boxname);
        $ret = false;
        if (is_array($boxinfo) && $boxinfo['exists']) {
            $this->mailSendCommand("UID FETCH {$msg['uid']} BODY.PEEK[HEADER.FIELDS (Message-Id)]");
            $buffer = $this->mailReadResponse();

            if ($this->mailNokResp($buffer)) {
                return false;
            }
            /* the end mark is <sid> OK FETCH, we are waiting for it*/
            while (!$this->mailOkResp($buffer)) {
                $buffer = trim($buffer);
                if (preg_match('|Message-ID:\s+<?([^>]+)>?|i', $buffer, $m)) {
                    if (strcasecmp($m[1], $msg['message-id']) == 0) {
                        $ret = true;
                    }
                }
                $buffer = $this->mailReadResponse();
            }
        }
        return $ret;
    }

    protected function _mailOnServerPop($msg)
    {
        if ($msg['folder'] != 'inbox') {
            return false;
        }
        $id = $msg['mnum'];
        if (!empty($this->capabilities['UIDL'])) {
            $this->mailSendCommand("UIDL $id");
            $buffer = $this->mailReadResponse();
            list($resp, $num, $uidl) = preg_split("|\s+|", $buffer);
            if ($resp == '+OK') {
                if (strcasecmp($msg['uidl'], self::md5($uidl)) == 0) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        $ouidl = $msg['uidl'];
        $msg['uidl'] = '';  // So we need to calculate it
        $this->_mailGetUidl($msg, false);
        if (strcasecmp($msg['uidl'], $ouidl) == 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check to see if a message is still on the server.
     * @param array $msg
     * @return boolean
     */
    public function mailOnServer($msg)
    {
        if ($msg['islocal']) {
            return false;
        }
        if ($this->mail_protocol == IMAP) {
            return $this->_mailOnServerImap($msg);
        } else {
            return $this->_mailOnServerPop($msg);
        }
    }

    /**
     * Change to specific default emailbox
     * @param  string $boxname Emailbox name to select
     * @return array
     */
    public function mailSelectBox($boxname = 'inbox')
    {
        /* this function is used only for IMAP servers */
        $boxinfo = [];
        if ($this->mail_protocol == IMAP) {
            $original_name = preg_replace('|"(.*)"|', "$1", $boxname);
            $boxname = self::utf8_7($this->fixPrefix($original_name, 1));
            $this->mailSendCommand("SELECT \"$boxname\"");
            $buffer = $this->mailReadResponse();
            if ($this->_mailParseResp($buffer) == self::RESP_NO) {
                if ($this->mailSubscribeBox($original_name)) {
                    $this->mailSendCommand("SELECT \"$boxname\"");
                    $buffer = $this->mailReadResponse();
                }
            }
            if ($this->mailNokResp($buffer)) {
                return false;
            }
            /* get total, recent messages and flags */
            while (!$this->mailOkResp($buffer)) {
                if (preg_match('|[ ]?\\*[ ]?([0-9]+)[ ]EXISTS|i', $buffer, $regs)) {
                    $boxinfo['exists'] = $regs[1];
                }
                if (preg_match('|[ ]?\\*[ ]?([0-9]+)[ ]RECENT|i', $buffer, $regs)) {
                    $boxinfo['recent'] = $regs[1];
                }
                if (preg_match('|[ ]?\\*[ ]?FLAGS[ ]?\\((.*)\\)|i', $buffer, $regs)) {
                    $boxinfo['flags'] = $regs[1];
                }
                if (preg_match('|[ ]?\\*[ ]?OK[ ]?.*UIDVALIDITY ([0-9]+)|i', $buffer, $regs)) {
                    $this->_uidvalidity = $boxinfo['uidvalidity'] = $regs[1];
                }
                $buffer = $this->mailReadResponse();
            }
        }
        $this->tdb->syncMessages();
        $this->_current_folder = $boxname;

        return $boxinfo;
    }

    /**
     * Subscribe to specific default emailbox
     * @param  string  $boxname Emailbox name to subscribe to
     * @return boolean
     */
    public function mailSubscribeBox($boxname = 'inbox')
    {
        /* this function is used only for IMAP servers */
        if ($this->mail_protocol == IMAP) {
            $boxname = $this->fixPrefix(preg_replace('|"(.*)"|', "$1", $boxname), 1);
            $this->mailSendCommand("SUBSCRIBE \"$boxname\"");
            if ($this->mailNokResp()) {
                return false;
            }
        }

        return true;
    }

    /**
     * Create a specific default emailbox
     * @param  string  $boxname Emailbox name to create
     * @return boolean
     */
    public function mailCreateBox($boxname)
    {
        $box['name'] = $boxname;
        $box['dirname'] = $this->getBoxDir($boxname);
        if ($this->mail_protocol == IMAP) {
            $boxname = $this->fixPrefix(preg_replace('|"(.*)"|', "$1", $boxname), 1);
            $this->mailSendCommand("CREATE \"$boxname\"");
            if ($this->mailOkResp()) {
                if (@mkdir($this->userfolder.$this->fixPrefix($box['dirname'], 0), $this->dirperm)) {
                    return true;
                }
            }
            return false;
        } else {
            /* if POP3, only make a new folder */
            if (@mkdir($this->userfolder.$box['dirname'], $this->dirperm)) {
                return $this->tdb->newFolder($box);
            } else {
                return false;
            }
        }
    }

    private function _mailDeleteBoxImap($boxname)
    {
        $boxname = $this->fixPrefix(preg_replace('|"(.*)"|', "$1", $boxname), 1);
        $this->mailSendCommand("DELETE \"$boxname\"");

        if ($this->mailOkResp()) {
            $this->_rmDirR($this->userfolder.$this->getBoxDir($boxname));
            return true;
        } else {
            return false;
        }
    }

    private function _mailDeleteBoxPop($boxname)
    {
        if (is_dir($this->userfolder.$this->getBoxDir($boxname))) {
            $this->_rmDirR($this->userfolder.$this->getBoxDir($boxname));
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete a specific default emailbox
     * @param  string  $boxname Emailbox name to delete
     * @return boolean
     */
    public function mailDeleteBox($boxname)
    {
        if ($this->mail_protocol == IMAP) {
            $ret = $this->_mailDeleteBoxImap($boxname);
        } else {
            $ret = $this->_mailDeleteBoxPop($boxname);
        }
        if ($ret == false) {
            $this->triggerError("Cannot delete $boxname", __FUNCTION__, __LINE__);
            return false;
        }
        return $this->tdb->delFolder($boxname);
    }

    private function _mailSaveMessageImap($boxname, $message, $flags = '')
    {
        $boxname = $this->fixPrefix(preg_replace('|"(.*)"|', "$1", $boxname), 1);

        // send an append command
        $mailcommand = sprintf('APPEND "%s" (%s) {%d}', $boxname, $flags, strlen($message));
        $this->mailSendCommand($mailcommand);

        // wait for a "+ Something" here and not after the msg sent!!
        $buffer = $this->mailReadResponse();
        if ($buffer[0] != '+') {
            return false;    // problem appending
        }

        // send the msg
        $mailcommand = "$message";
        $this->mailSendCommand($mailcommand, ['addtag' => false]);    // don't send the session id here!

        $buffer = $this->mailReadResponse();

        if (!preg_match("|^(".$this->_getSid()." OK)|i", $buffer)) {
            return false;
        }
        return true;
    }

    /**
     * Save raw email message to specific emailbox
     * @param  string  $boxname Emailbox name to save to
     * @param  string  $message Message to save
     * @param  string  $flags
     * @return boolean
     */
    public function mailSaveMessage($boxname, $message, $flags = '')
    {
        if ($this->mail_protocol == IMAP) {
            if (!$this->_mailSaveMessageImap($boxname, $message, $flags)) {
                return false;
            }
        }
        $email = $this->fetchStructure($message);
        $email['header'] = trim($email['header']);
        $msg = $this->parseHeaders($email['header']);
        $msg['folder'] = $boxname;
        $msg['flat'] = false;
        $msg['islocal'] = true;
        $msg['iscached'] = true;
        $msg['flags'] = $flags;
        $this->_mailGetUidl($msg);
        if (stripos($msg['header'], 'X-TLN-UIDL') === false) {
            $msg['header'] .= "X-TLN-UIDL: {$msg['uidl']}";
            $msg['headers']['x-tln-uidl'] = $msg['uidl'];
        }
        $msg['localname'] = $this->_createLocalFname($msg);
        list($filename, $dir) = $this->getPath($msg);
        $this->_mkdir($dir);
        if (!empty($flags)) {
            $content = $email['header']."\r\nX-UM-Flags: $flags\r\n\r\n".$this->blob($email['body'], false);
        } else {
            $content = $email['header']."\r\n\r\n".$this->blob($email['body'], false);
        }
        $msg['size'] = strlen($content);
        unset($email);
        $this->saveFile($filename, $content);
        $this->tdb->newMessage($msg, true);

        return true;
    }

    /**
     * See if Flag is is
     * @param array $msg Message to check
     * @param string $flag Flag to look for
     * @return boolean
     */
    public function isFlagSet($msg, $flag) {
        return stristr($msg['flags'], $flag);
    }

    private function _mailSetFlagImap(&$msg, $flagname, $flagtype = '+')
    {
        if ($this->_current_folder != $msg['folder']) {
            $this->mailSelectBox($msg['folder']);
        }

        if ($flagtype != '+') {
            $flagtype = '-';
        }
        $this->mailSendCommand('STORE '.$msg['mnum'].':'.$msg['mnum'].' '.$flagtype."FLAGS ($flagname)");
        $buffer = $this->mailReadResponse();

        while (!preg_match("/^(".$this->_getSid()." (OK|NO|BAD))/i", $buffer)) {
            $buffer = $this->mailReadResponse();
        }
        if ($this->mailNokResp($buffer)) {
            return false;
        }
        return true;
    }

    /**
     * Set flags on specific email message
     * @param  string  $msg      Email message to set flag for
     * @param  string  $flagname Flag to set
     * @param  string  $flagtype Set + or Unset -
     * @return boolean
     */
    public function mailSetFlag(&$msg, $flagname, $flagtype = '+')
    {
        $flagname = strtoupper($flagname);
        $path = $this->getPath($msg)[0];
        if (!in_array($flagname, $this->flags)) {
            $this->triggerError("unknown flag: $flagname", __FUNCTION__, __LINE__);
            return false;
        }
        if ($flagtype == '+' && $this->isFlagSet($msg, $flagname)) {
            return true;
        }
        if ($flagtype == '-' && !$this->isFlagSet($msg, $flagname)) {
            return true;
        }

        if ($this->mail_protocol == IMAP && in_array($flagname, $this->flags)) {
            if (!$this->_mailSetFlagImap($msg, $flagname, $flagtype)) {
                return false;
            }
        } elseif (!file_exists($path)) {
            $this->mailRetrMsg($msg);
        }

        if (file_exists($path)) {
            $email = $this->readFile($path);
            $email = $this->fetchStructure($email);
            $header = $email['header'];
            $body = $email['body'];

            $strFlags = trim(strtoupper($msg['flags']));

            $flags = [];
            if (!empty($strFlags)) {
                $flags = preg_split('|\s+|', $strFlags);
            }

            if ($flagtype == '+') {
                if (!in_array($flagname, $flags)) {
                    $flags[] = $flagname;
                }
            } else {
                while (list($key, $value) = each($flags)) {
                    if (strtoupper($value) == $flagname) {
                        $pos = $key;
                    }
                }
                if (!empty($pos)) {
                    unset($flags[$pos]);
                }
            }

            $flags = join(' ', $flags);
            if (!preg_match('|X-UM-Flags|i', $header)) {
                $header .= "\r\nX-UM-Flags: $flags";
            } else {
                $header = preg_replace('/'.quotemeta('X-UM-Flags:')."(.*)/i", "X-UM-Flags: $flags", $header);
            }

            $msg['header'] = $header;
            $msg['flags'] = $flags;
            $this->tdb->doMessage($msg, ['header', 'flags']);

            $pts = $this->tstream();
            rewind($body);
            fwrite($pts, "$header\r\n\r\n");
            $this->_sXfer($body, $pts);

            $this->saveFile($path, $pts);
            fclose($pts);
        }

        return true;
    }

    /**
     * Disconnect/logout from Email server
     * @return boolean
     */
    public function mailDisconnect()
    {
        if ($this->mailConnected()) {
            if ($this->mail_protocol == IMAP) {
                if ($this->_require_expunge) {
                    $this->mailExpunge();
                }
                $this->mailSendCommand('LOGOUT', ['autolog' => false]);
                $this->mailReadResponse();
            } else {
                $this->mailSendCommand('QUIT', ['autolog' => false]);
                $this->mailReadResponse();
            }
            fclose($this->_mail_connection);
            $this->_mail_connection = null;
            $this->_authenticated = false;
            //usleep(500);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Disconnect/logout from Email server
     * @return boolean
     */
    public function mailDisconnectForce()
    {
        if ($this->mailConnected()) {
            $this->mailSendCommand('FORCEDQUIT', ['autolog' => false]);
            $this->mailReadResponse();
            fclose($this->_mail_connection);
            $this->_mail_connection = null;
            $this->_authenticated = false;
            // Sleep to make it possible that the server can resume.
            sleep(1);
            return true;
        } else {
            return false;
        }
    }

    /**
     * EXPUNGE email from Email server
     * @return boolean
     */
    public function mailExpunge()
    {
        if ($this->mail_protocol == IMAP) {
            $this->mailSendCommand('EXPUNGE');
            $buffer = $this->mailReadResponse();
            if ($this->mailNokResp($buffer)) {
                return false;
            }
            while (!$this->mailOkResp($buffer)) {
                $buffer = $this->mailReadResponse();
            }
        }
        return true;
    }

    /*
     * Use the optional POP3 CAPA command to determine
     * what extensions the pop server supports. Returns
     * a hash of supported options.
     */
    protected function _mailCapaPop()
    {
        $capa = [];
        $this->mailSendCommand('CAPA', ['autolog' => false]);
        $buffer = $this->mailReadResponse();
        if ($this->mailOkResp($buffer)) {
            while (!self::_feof($this->_mail_connection)) {
                $buffer = trim($this->mailReadResponse());
                if ($buffer[0] == '.') {
                    break;
                }
                $a = preg_split("|\s+|", $buffer);
                foreach ($a as $val) {
                    $capa[$val] = 1;
                }
            }
        }
        return $capa;
    }

    protected function _mailCapaImap()
    {
        $capa = [];
        $this->mailSendCommand('cp01 CAPABILITY', ['autolog' => false, 'addtag' => false]);
        while (!self::_feof($this->_mail_connection)) {
            $buffer = trim($this->mailReadResponse());
            $a = preg_split('|\s+|', $buffer);
            if ($a[0] == 'cp01') {
                break;
            }
            if ($a[0] == '*') {
                foreach ($a as $val) {
                    $capa[$val] = 1;
                }
            }
        }
        return $capa;
    }

    /**
     * Load CAPA(BILITY) output of POP3/IMAP server
     * @return void ($this->capabilities[] is loaded)
     */
    public function mailCapa()
    {
        $close = false;
        if (!$this->mailConnected()) {
            $this->mailConnect();
            $close = true;
        }
        if ($this->mail_protocol == IMAP) {
            $capa = $this->_mailCapaImap();
        } else {
            $capa = $this->_mailCapaPop();
        }
        if ($close) {
            $this->mailDisconnect();
        }
        // In case we do this before and after login (eg: IMAP
        // with Dovecot), we merge with the old settings
        $this->capabilities = array_merge($this->capabilities, $capa);
        // and honor config'ed overrides
        foreach ($this->config['capa_override'] as $key => $value) {
            if ($value !== null) {
                $this->capabilities[$key] = $value;
            }
        }
    }

    /**
     * Get the UIDL for the specified message.
     *
     * If the server does not provide for the UIDL command,
     * then we generate our own by reading the message
     * headers and using the Message-ID, Date and Subject
     * headers to craft one.
     * @param  array  $msg
     * @param boolean $update True if we want to update the db
     * @return string
     */
    protected function _mailGetUidl(&$msg, $update = true)
    {
        if (!empty($msg['uidl'])) {
            return $msg['uidl'];
        }
        $id = $msg['mnum'];
        if (!empty($this->capabilities['UIDL']) && !$msg['islocal']) {
            $this->mailSendCommand("UIDL $id");
            $buffer = $this->mailReadResponse();
            list($resp, $num, $uidl) = preg_split("|\s+|", $buffer);
            if ($resp == '+OK') {
                $msg['uidl'] = self::md5($uidl);
            }
            // If we DON'T get the OK response, we drop through
        }
        if (!empty($msg['uidl'])) {
            return $msg['uidl'];
        } elseif (!empty($msg['subject']) && !empty($msg['date']) && !empty($msg['message-id'])) {
            $msg['uidl'] = self::md5(trim($msg['subject'].$msg['date'].$msg['message-id']));
        } else {
            /* try to grab from header */
            if (!$msg['islocal']) {
                $header = $this->_mailRetrHeaderPop($msg);
            } else {
                if (file_exists($msg['localname'])) {
                    $email = $this->readFile($msg['localname']);
                    $email = $this->fetchStructure($email);
                    $header = $email['header'];
                } else {
                    $msg['uidl'] = self::md5(trim($msg['subject'].$msg['date'].$msg['message-id']).self::uniqID());
                    return $msg['uidl'];
                }
            }
            if ($header == '') {
                $msg['uidl'] = self::md5(self::uniqID());
                return $msg['uidl'];
            }
            $mail_info = $this->parseHeaders($header);
            self::add2me($msg, $mail_info);
            if ($update) {
                $this->tdb->doMessage($msg);
            }
            if (!empty($mail_info['uidl'])) {
                return $mail_info['uidl'];
            }
            $msg['uidl'] = self::md5(trim($msg['subject'].$msg['date'].$msg['message-id']));
        }
        if (empty($msg['uidl'])) {
            $msg['uidl'] = self::md5(trim($msg['subject'].$msg['date'].$msg['message-id']).self::uniqID());
        }
        return $msg['uidl'];
    }

    /**
     * Cleanup a set of directorys
     * @param  string  $userfolder The user's local webmail directory
     * @param  boolean $logout     TRUE if we also perform logout cleanups
     * @return void
     */
    public function cleanupDirs($userfolder, $logout = false)
    {
        if ($this->prefs['keep_on_server']) {
            // inbox is always cleaned up
            $cleanme = $userfolder.'inbox/';
            self::cleanupDir($cleanme);
            if ($this->mail_protocol == IMAP) {
                /*
                 * For IMAP, this determines whether we simply
                 * cache what's on the IMAP server, or we exclusively
                 * store email. If we simply cache, clean up whatever
                 * data still exists locally.
                 */
                foreach ($this->tdb->folders as $folder) {
                    if ($folder != $this->tdb->udatafolder) {
                        $cleanme = $userfolder.$folder['dirname'].'/';
                        self::cleanupDir($cleanme);
                    }
                }
            }
        }

        if ($logout) {
            if ($this->mail_protocol == IMAP) {
                if (!$this->mailConnect()) $this->redirectAndExit('index.php?err=1', true);
                if (!$this->mailAuth()) $this->redirectAndExit('index.php?err=0');
            }
            if ($this->prefs['empty_trash']) {
                $trash = $this->tdb->getMessages('trash');
                if (count($trash) > 0) {
                    foreach ($trash as $msg) {
                        $this->mailDeleteMsg($msg, false);
                    }
                    $this->mailExpunge();
                }
            }

            if ($this->prefs['empty_spam']) {
                if (!$this->mailConnect()) $this->redirectAndExit('index.php?err=1', true);
                if (!$this->mailAuth()) $this->redirectAndExit('index.php?err=0');
                $trash = $this->tdb->getMessages('spam');
                if (count($trash) > 0) {
                    foreach ($trash as $msg) {
                        $this->mailDeleteMsg($msg, false);
                    }
                    $this->mailExpunge();
                }
            }
            $this->mailDisconnect();
        }
    }

    /**
     * If we are past the "check for new mail" deadline,
     * we call this to poll for new messages for all
     * emailboxes/folders and then update the folders DB
     * as needed.
     */
    public function refreshFolders()
    {
        $wasstale = false;
        $boxes = $this->mailListBoxes();
        foreach ($boxes as $folder => $f) {
            if ($this->iamStale($folder)) {
                $this->mailListMsgs($folder);
                $wasstale = true;
                $this->unStale($folder);
            }
        }
        if ($wasstale) {
        /*
         * Now is as good a time as whenever to poll the DB log
         */
            list($ok, $log) = $this->tdb->status();
            if (!$ok) {
                foreach ($log as $l) {
                    $this->debugMsg($l, __FUNCTION__, __LINE__);
                }
            }
        }
    }

    /**
     * See if the folder info is "stale" (ie: time to check for new messages)
     * @param string $folder Folder to check
     * @return bool
     */
    public function iamStale($folder)
    {
        return ($this->tdb->folders[$folder]['refreshed'] < ($this->_now - ($this->prefs['refresh_time'] * 60)));
    }

    /**
     * Reset refreshed field and make the folder no longer "stale"
     * @param string $folder Folder to check
     * @return bool
     */
    public function unStale($folder)
    {
        $this->tdb->folders[$folder]['refreshed'] = $this->_now;
        $this->tdb->updateFolderField($folder, 'refreshed');
    }
}
