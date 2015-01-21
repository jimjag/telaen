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
    public $havespam       = false;
    public $CRLF           = "\r\n";
    public $dirperm        = 0700;
    public $capabilities   = [];

    protected $_current_folder = '';
    protected $_spamregex      = ["^\*\*\*\*\*SPAM\*\*\*\*\*", "^\*\*\*\*\*VIRUS\*\*\*\*\*"];
    protected $_serverurl      = '';
    protected $_respnum        = 0;
    protected $_respstr        = '';
    protected $_version        = 2;
    protected $_greeting       = '';        // Internally used for store initial IMAP/POP3 greeting message
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
        $this->mail_disconnect();
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
    static public function is_utf8($string)
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
    public function valid_fname($name)
    {
        $name = trim($name);
        if ($name == '') {
            return false;
        }
        // Folder names that match system folder names are NOT valid
        if ($this->is_system_folder($name)) {
            return false;
        }
        return true;
    }

    /**
     * Check if we are connected to email server
     * @return boolean
     */
    public function mail_connected()
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
     * Check if supplied folder name is a system folder.
     * @param  string  $name The folder name to check
     * @return boolean
     */
    public function is_system_folder($name)
    {
        return $this->tdb->folders[strtolower($name)]['system'];
    }

    /**
     *
     * @param  string $string Response string to parse
     * @return int
     */
    protected function _mail_parse_resp($string = null)
    {
        $resp = self::RESP_UNKNOWN;
        $match = [];
        if ($string == null) $string = $this->mail_read_response();
        if ($this->mail_protocol == IMAP) {
            if (preg_match('|^\s*'.$this->_get_sid().'\s+(OK|NO|BAD|BYE)(.*)$|i', trim($string), $match)) {
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
            if (preg_match('|^(\\+OK)(.*)$|i', trim($string), $match)) {
                if (strtoupper($match[1]) == '+OK') {
                    $resp = self::RESP_OK;
                } else {
                    $resp = self::RESP_NOK;
                }
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
    public function mail_ok_resp($string = null)
    {
        if ($string == null) $string = $this->mail_read_response();
        $resp = $this->_mail_parse_resp($string);
        return ($resp == self::RESP_OK);
    }

    /**
     *
     * @param  string  $string Response string to checkout
     * @return boolean True if we saw an explicit error
     */
    public function mail_nok_resp($string = null)
    {
        if ($string == null) $string = $this->mail_read_response();
        $resp = $this->_mail_parse_resp($string);
        return ($resp < self::RESP_OK);
    }

    /*
     * Read in a response line from server
     * @return string
     */
    public function mail_read_response()
    {
        $buffer = @fgets($this->_mail_connection, 8192);
        $buffer = preg_replace('|\r?\n|', "\r\n", $buffer);
        $this->debug_msg($buffer, __FUNCTION__);
        return $buffer;
    }

    /**
     * Send the supplied command to the mail server. Auto-
     * appends the required EOL chars to the command.
     * @param string $cmd Command to send
     * @param array $opt 'autolog' = login as needed; 'addtag' = auto add IMAP id
     * @return boolean
     */
    public function mail_send_command($cmd, $opt=['autolog' => true, 'addtag' => true])
    {
        $cmd = trim($cmd).$this->CRLF;
        $output = (preg_match('/^(PASS|LOGIN)/', $cmd, $regs)) ? $regs[1]." ****" : $cmd;
        if (!$this->mail_connect()) {
            $this->trigger_error("could not connect to server", __FUNCTION__);
            return false;
        }
        if (!$this->_authenticated && $opt['autolog']) {
            if (!$this->mail_auth()) {
                $this->trigger_error("could not auto_login: $output", __FUNCTION__);
                return false;
            }
        }
        if ($this->mail_protocol == IMAP && $opt['addtag']) {
            $cmd = $this->_get_sid(true).' '.$cmd;
            $output = $this->_get_sid().' '.$output;
        }
        $this->debug_msg($output, __FUNCTION__);
        return (boolean)fwrite($this->_mail_connection, $cmd);
}

    /**
     * Send the supplied commands to the mail server. Auto-
     * appends the required EOL chars to the command.
     * @param array $cmd Commands to send
     * @param array $opt 'autolog' = login as needed; 'addtag' = auto add IMAP id
     * @return boolean
     */
    public function mail_send_commands($cmds, $opt=['autolog' => true, 'addtag' => true])
    {
        if (!is_array($cmds)) {
            $cmds = (array) $cmds;
        }
        foreach ($cmds as $cmd) {
            if (!$this->mail_send_command($cmd, $opt)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Connect to email server. TRUE if successful
     * @return boolean
     */
    public function mail_connect()
    {
        if (!$this->mail_connected()) {
            if (!$this->_serverurl) {
                $this->_serverurl = ($this->use_tls ? 'tls://' : 'tcp://').
                    $this->mail_server.':'.$this->mail_port;
            }
            $errno = 0;
            $errstr = 0;
            $this->_mail_connection = stream_socket_client($this->_serverurl, $errno, $errstr, 15);
            if ($this->_mail_connection) {
                $this->_greeting = $this->mail_read_response();
                if ($this->mail_ok_resp($this->_greeting)) {
                    return true;
                }
            }
            $this->trigger_error("Cannot connect to: $this->_serverurl", __FUNCTION__);
            return false;
        }
        return true;
    }

    private function _crammd5_response($challenge)
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
    protected function _mail_auth_imap()
    {
        if ($this->upgrade_tls) {
            if (empty($this->capabilities['STARTTLS'])) {
                $this->trigger_error("Want STARTTLS but server doesn't support it.", __FUNCTION__);
                return false;
            }
            $this->mail_send_command('STARTTLS', ['autolog' => false]);
            if ($this->mail_ok_resp()) {
                stream_socket_enable_crypto($this->_mail_connection, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
            } else {
                $this->trigger_error("STARTTLS failure", __FUNCTION__);
                return false;
            }
        }
        if (!empty($this->capabilities['AUTH=CRAM-MD5'])) {
            $this->mail_send_command('AUTHENTICATE CRAM-MD5', ['autolog' => false]);
            $buffer = $this->mail_read_response();
            if ($buffer[0] == '+') {
                $challenge = base64_decode(substr($buffer, 2));
                $challenge_response = $this->_crammd5_response($challenge);
                $this->mail_send_command($challenge_response, ['autolog' => false, 'addtag' => false]);
                return $this->mail_ok_resp();
            } else {
                $this->trigger_error("Tried CRAM-MD5 but got bad challenge. Downgrading to LOGIN", __FUNCTION__);
            }
        }
        $this->mail_send_command('LOGIN '.$this->mail_user.' '.$this->mail_pass, ['autolog' => false]);
        return $this->mail_ok_resp();
    }

    /**
     * Authentication for POP3
     * @return boolean
     */
    protected function _mail_auth_pop()
    {
        $tokens = [];
        if ($this->upgrade_tls) {
            if (empty($this->capabilities['STLS'])) {
                $this->trigger_error("Want STLS but server doesn't support it.", __FUNCTION__);
                return false;
            }
            $this->mail_send_command('STLS', ['autolog' => false]);
            if ($this->mail_ok_resp()) {
                stream_socket_enable_crypto($this->_mail_connection, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
            } else {
                $this->trigger_error("STLS failure", __FUNCTION__);
                return false;
            }
        }
        if (!empty($this->capabilities['CRAM-MD5'])) {
            $this->mail_send_command('AUTH CRAM-MD5', ['autolog' => false]);
            $buffer = $this->mail_read_response();
            if ($buffer[0] == '+') {
                $challenge = base64_decode(substr($buffer, 2));
                $challenge_response = $this->_crammd5_response($challenge);
                $this->mail_send_command($challenge_response, ['autolog' => false]);
                return $this->mail_ok_resp();
            } else {
                $this->trigger_error("Tried CRAM-MD5 but got bad challenge. Trying others.", __FUNCTION__);
            }
        }
        if (!empty($this->capabilities['APOP']) && preg_match('/<.+@.+>/U', $this->_greeting, $tokens)) {
            $this->mail_send_command('APOP '.$this->mail_user.' '.self::md5($tokens[0].$this->mail_pass), ['autolog' => false]);
        }
        // Classic login mode
        else {
            $this->mail_send_command('USER '.$this->mail_user, ['autolog' => false]);

            if ($this->mail_ok_resp()) {
                $this->mail_send_command('PASS '.$this->mail_pass, ['autolog' => false]);
            } else {
                return false;
            }
        }
        return $this->mail_ok_resp();
    }

    /**
     * Check if user is authenticated to the email server
     * @return boolean
     */
    public function mail_auth()
    {
        if ($this->mail_connected()) {
            if ($this->_authenticated) {
                return true;
            } else {
                if ($this->mail_protocol == IMAP) {
                    $this->_authenticated = $this->_mail_auth_imap();
                } else {
                    $this->_authenticated = $this->_mail_auth_pop();
                }
                // if ($this->_authenticated) $this->mail_get_capa();
                return $this->_authenticated;
            }
        }
        return false;
    }

    /**
     * Prep folders on initial login
     */
    public function prep_local_dirs()
    {
        if (!file_exists($this->userfolder)) {
            if (!@mkdir($this->userfolder, $this->dirperm)) {
                $this->trigger_error("mkdir error: $this->userfolder", __FUNCTION__);
            }
        }

        $boxes = $this->mail_list_boxes('*');

        if ($this->mail_protocol == IMAP && false) {  // skip for now

            $tmp = $this->tdb->folders;

            for ($i = 0;$i<count($boxes);$i++) {
                $current_folder = $boxes[$i]['name'];

                if ($this->is_system_folder($current_folder)) {
                }

                while (list($index, $value) = each($tmp)) {
                    if ($current_folder == $value) {
                        unset($tmp[$index]);
                    }
                }
                reset($tmp);
            }

            while (list($index, $value) = each($tmp)) {
                $this->mail_create_box($this->fix_prefix($value, 1));
            }

            for ($i = 0;$i<count($boxes);$i++) {
                $current_folder = $this->fix_prefix($boxes[$i]['name'], 1);
                if (!$this->is_system_folder($current_folder)) {
                    if (!file_exists($this->userfolder.$current_folder)) {
                        if (!@mkdir($this->userfolder.$current_folder, $this->dirperm)) {
                            $this->trigger_error("mkdir error: {$this->userfolder}{$current_folder}", __FUNCTION__);
                        }
                    }
                }
            }
        }

        foreach ($this->tdb->required_dirs() as $value) {
            $value = $this->fix_prefix($value, 1);
            if (!file_exists($this->userfolder.$value)) {
                if (!@mkdir($this->userfolder.$value, $this->dirperm)) {
                    $this->trigger_error("mkdir error: {$this->userfolder}{$value}", __FUNCTION__);
                }
            }
        }
    }

    protected function _mail_retr_msg_imap(&$msg, $check = 1)
    {
        $msgheader = trim($msg['header']);

        if ($check) {
            if ($this->_current_folder != $msg['folder']) {
                $boxinfo = $this->mail_select_box($msg['folder']);
            }

            $this->mail_send_command('FETCH '.$msg['mnum'].':'.$msg['mnum'].' BODY.PEEK[HEADER.FIELDS (Message-Id)]');
            $buffer = chop($this->mail_read_response());
            if ($this->mail_nok_resp($buffer)) {
                return false;
            }
            while (!$this->mail_ok_resp($buffer)) {
                if (preg_match('|message-id: (.*)|i', $buffer, $regs)) {
                    $current_id = preg_replace('|<(.*)>|', "$1", $regs[1]);
                }
                $buffer = chop($this->mail_read_response());
            }

            if ($current_id != $msg['message-id']) {
                $this->trigger_error(sprintf("Message ID's differ: [%s/%s]",
                    $current_id,
                    $msg['message-id']), __FUNCTION__);
                return false;
            }
        }

        if (file_exists($msg['localname'])) {
            $msgcontent = $this->read_file($msg['localname']);
        } else {
            $this->mail_send_command('FETCH '.$msg['mnum'].':'.$msg['mnum'].' BODY[TEXT]');
            $buffer = $this->mail_read_response();
            if ($this->mail_nok_resp($buffer)) {
                return false;
            }
            if (preg_match('|\\{(.*)\\}|', $buffer, $regs)) {
                $bytes = $regs[1];
            }

            $buffer = $this->mail_read_response();
            $msgbody = '';
            while (!$this->mail_ok_resp($buffer)) {
                if (!preg_match('|[ ]?\\*[ ]?[0-9]+[ ]?FETCH|i', $buffer)) {
                    $msgbody .= $buffer;
                }
                $buffer = $this->mail_read_response();
            }
            $pos = strrpos($msgbody, ")");
            if (!($pos === false)) {
                $msgbody = substr($msgbody, 0, $pos);
            }
            $msgheader .= "\r\nX-TLN-UIDL: ".$msg['uidl'];

            // Update globally
            $msg['header'] = $msgheader;
            $this->tdb->m_delta[] = [$msg, ['header']];

            $msgcontent = "$msgheader\r\n\r\n$msgbody";

            $this->save_file($msg['localname'], $msgcontent);
        }

        return $msgcontent;
    }

    protected function _mail_retr_msg_pop(&$msg, $check = 1)
    {
        if ($check && ($msg['folder'] == 'inbox')) {
            $muidl = $this->_mail_get_uidl($msg);
            if ($msg['uidl'] && ($msg['uidl'] != $muidl)) {
                $this->trigger_error(sprintf("UIDL's differ: [%s/%s]",
                    $msg['uidl'],
                    $muidl),__FUNCTION__);

                return false;
            }
        }

        if (file_exists($msg['localname'])) {
            $msgcontent = $this->read_file($msg['localname']);
        } elseif ($msg['folder'] == 'inbox') {
            $command = ($this->config['mail_use_top']) ? 'TOP '.$msg['mnum'].' '.$msg['size'] : 'RETR '.$msg['mnum'];
            $this->mail_send_command($command);

            $buffer = $this->mail_read_response();

            if ($this->mail_nok_resp($buffer)) {
                return false;
            }
            $msgcontent = '';
            while (!self::_feof($this->_mail_connection)) {
                $buffer = $this->mail_read_response();
                if (chop($buffer) == '.') {
                    break;
                }
                $msgcontent .= $buffer;
            }
            $email = $this->fetch_structure($msgcontent);
            $header = $email['header'];
            $body = $email['body'];

            // Since we are pulling this message for the first
            // time from the server, we need to add in our UIDL
            // header. Thus, it will always now be available on
            // the cached/local version.
            $header .= "\r\nX-TLN-UIDL: ".$msg['uidl'];

            // Update globally
            $msg['header'] = $header;
            $this->tdb->m_delta[] = [$msg, ['header']];

            $msgcontent = "$header\r\n\r\n$body";

            $this->save_file($msg['localname'], $msgcontent);
        }

        return $msgcontent;
    }

    /**
     * Retrieve and return specific email message
     * @param  string  $msg   The message to obtain
     * @param  boolean $check if it exists
     * @return string
     */
    public function mail_retr_msg(&$msg, $check = 1)
    {
        if ($this->mail_protocol == IMAP) {
            return $this->_mail_retr_msg_imap($msg, $check);
        } else {
            return $this->_mail_retr_msg_pop($msg, $check);
        }
    }

    protected function _mail_retr_header_imap($msg)
    {
        if ($msg['header'] != '') {
            return $msg['header'];
        }
        $ret = $header = '';
        $this->mail_send_command('UID FETCH '.$msg['uid'].' (RFC822.HEADER)');
        $buffer = $this->mail_read_response();

        /* if any problem, stop the procedure */
        if ($this->mail_nok_resp($buffer)) {
            return $ret;
        }

        /* the end mark is <sid> OK FETCH, we are waiting for it*/
        while (!$this->mail_ok_resp($buffer)) {
            $tbuffer = trim($buffer);
            /* skip 1st line  ' * 123 FETCH ...' */
            if (preg_match('|[ ]?\\*[ ]?([0-9]+)[ ]?FETCH|i', $buffer, $regs)) {
                ;
            /* wait for closing ')' */
            } elseif ($tbuffer != ")" && $tbuffer != '') {
                $header .= $buffer;
            /*	the end of message header was reached */
            } elseif ($tbuffer == ")") {
                $ret = $header;
            }
            $buffer = $this->mail_read_response();
        }
        return $ret;
    }

    protected function _mail_retr_header_pop($msg)
    {
        /*
         * Fetch headers serially. Very slow.
         */
        if ($msg['header'] != '') {
            return $msg['header'];
        }
        $this->mail_send_command('TOP '.$msg['mnum'].' 0');
        $buffer = $this->mail_read_response();
        /* if any problem with this messages list, stop the procedure */
        if ($this->mail_nok_resp($buffer)) {
            return false;
        }
        $header = '';;
        while (!self::_feof($this->_mail_connection)) {
            $buffer = $this->mail_read_response();
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
    public function mail_retr_header($msg)
    {
        if ($this->mail_protocol == IMAP) {
            return $this->_mail_retr_header_imap($msg);
        } else {
            return $this->_mail_retr_header_pop($msg);
        }
    }

    protected function _mail_delete_msg_imap($msg, $send_to_trash = true, $save_only_read = false)
    {
        $read = (preg_match('|\\SEEN|', $msg['flags'])) ? 1 : 0;

        /* check the message id to make sure that the messages still in the server */
        if ($this->_current_folder != $msg['folder']) {
            $boxinfo = $this->mail_select_box($msg['folder']);
        }

        $this->mail_send_command('FETCH '.$msg['mnum'].':'.$msg['mnum'].' BODY.PEEK[HEADER.FIELDS (Message-Id)]');
        $buffer = chop($this->mail_read_response());

        /* if any problem with the server, stop the function */
        if ($this->mail_nok_resp($buffer)) {
            return false;
        }

        while (!$this->mail_ok_resp($buffer)) {
            /* we need only the message id yet */

            if (preg_match('|message-id: (.*)|i', $buffer, $regs)) {
                $current_id = preg_replace('|<(.*)>|', "$1", $regs[1]);
            }

            $buffer = chop($this->mail_read_response());
        }

        /* compare the old and the new message id, if different, stop*/
        if ($current_id != $msg['message-id']) {
            $this->trigger_error(sprintf("Message ID's differ: [%s/%s]",
                $current_id,
                $msg['message-id']), __FUNCTION__);

            return false;
        }

        /*if the pointer is here, no one problem occours*/

        if ($send_to_trash
            && $msg['folder'] != 'trash'
            && (!$save_only_read || ($save_only_read && $read))) {
            $trash_folder = $this->fix_prefix('trash', 1);

            $this->mail_send_command('COPY '.$msg['mnum'].':'.$msg['mnum']." \"$trash_folder\"");
            $buffer = $this->mail_read_response();

            /* if any problem with the server, stop the function */
            if ($this->mail_nok_resp($buffer)) {
                return false;
            }

            if (file_exists($msg['localname'])) {
                $currentname = $msg['localname'];
                $basename = basename($currentname);
                $newfilename = $this->userfolder."trash/$basename";
                copy($currentname, $newfilename);
                unlink($currentname);
            }
        }
        $this->mail_set_flag($msg, '\\DELETED', '+');

        return $this->tdb->del_messages($msg);
    }

    protected function _mail_delete_msg_pop($msg, $send_to_trash = true, $save_only_read = false)
    {
        $read = (preg_match('|\\SEEN|', $msg['flags'])) ? 1 : 0;

        /* now we are working with POP3 */
        /* check the message id to make sure that the messages still in the server */
        if ($msg['folder'] == 'inbox' || $msg['folder'] == 'spam') {
            /* compare the old and the new message uidl, if different, stop*/
            $muidl = $this->_mail_get_uidl($msg['mnum']);
            if ($msg['uidl'] != $muidl) {
                $this->trigger_error(sprintf("UIDL's differ: [%s/%s]",
                    $msg['uidl'],
                    $muidl), __FUNCTION__);

                return false;
            }

            if (!file_exists($msg['localname'])) {
                if (!$this->mail_retr_msg($msg, 0)) {
                    return false;
                }
                $this->mail_set_flag($msg, '\\SEEN', '-');
            }

            $this->mail_send_command('DELE '.$msg['mnum']);
            if ($this->mail_nok_resp()) {
                return false;
            }
        }

        if ($send_to_trash
            && $msg['folder'] != 'trash'
            && (!$save_only_read || ($save_only_read && $read))) {
            if (file_exists($msg['localname'])) {
                $currentname = $msg['localname'];
                $basename = basename($currentname);
                $newfilename = $this->userfolder."trash/$basename";
                copy($currentname, $newfilename);
                unlink($currentname);
            }
        } else {
            if (file_exists($msg['localname'])) {
                unlink($msg['localname']);
            }
        }

        return $this->tdb->del_messages($msg);
    }

    /**
     * Delete specific email message
     * @param  string  $msg            The message to delete
     * @param  boolean $send_to_trash
     * @param  boolean $save_only_read
     * @return boolean
     */
    public function mail_delete_msg($msg, $send_to_trash = true, $save_only_read = false)
    {
        if ($this->mail_protocol == IMAP) {
            return $this->_mail_delete_msg_imap($msg, $send_to_trash, $save_only_read);
        } else {
            return $this->_mail_delete_msg_pop($msg, $send_to_trash, $save_only_read);
        }
    }

    protected function _mail_move_msg_imap($msg, $tofolder)
    {
        if ($tofolder != $msg['folder']) {
            /* check the message id to make sure that the message is still on the server */
            if ($this->_current_folder != $msg['folder']) {
                $boxinfo = $this->mail_select_box($msg['folder']);
            }

            $this->mail_send_command('FETCH '.$msg['mnum'].':'.$msg['mnum'].' BODY.PEEK[HEADER.FIELDS (Message-Id)]');
            $buffer = chop($this->mail_read_response());

            /* if any problem with the server, stop the function */
            if ($this->mail_nok_resp($buffer)) {
                return false;
            }

            while (!$this->mail_ok_resp($buffer)) {
                /* we need only the message id yet */

                if (preg_match('|message-id: (.*)|i', $buffer, $regs)) {
                    $current_id = preg_replace('|<(.*)>|', "$1", $regs[1]);
                }

                $buffer = chop($this->mail_read_response());
            }

            /* compare the old and the new message id, if different, stop*/
            if ($current_id != $msg['message-id']) {
                $this->trigger_error(sprintf("Message ID's differ: [%s/%s]",
                    $current_id,
                    $msg['message-id']), __FUNCTION__);

                return false;
            }

            $tofolder = $this->fix_prefix($tofolder, 1);

            $this->mail_send_command('COPY '.$msg['mnum'].':'.$msg['mnum']." \"$tofolder\"");
            /* if any problem with the server, stop the function */
            if ($this->mail_nok_resp()) {
                return false;
            }

            if (file_exists($msg['localname'])) {
                $currentname = $msg['localname'];
                $basename = basename($currentname);
                $newfilename = $this->userfolder."$tofolder/$basename";
                copy($currentname, $newfilename);
                unlink($currentname);
            }
            $this->mail_set_flag($msg, '\\DELETED', '+');
        }

        return true;
    }

    protected function _mail_move_msg_pop($msg, $tofolder)
    {
        if (($tofolder != 'inbox' && $tofolder != 'spam') && $tofolder != $msg['folder']) {
            /* now we are working with POP3 */
            /* check the message id to make sure that the messages still in the server */
            if ($msg['folder'] == 'inbox' || $msg['folder'] == 'spam') {
                /* compare the old and the new message id, if different, stop*/
                $muidl = $this->_mail_get_uidl($msg['mnum']);
                if ($msg['uidl'] != $muidl) {
                    $this->trigger_error(sprintf("UIDL's differ: [%s/%s]",
                        $msg['uidl'],
                        $muidl), __FUNCTION__);

                    return false;
                }

                if (!file_exists($msg['localname'])) {
                    if (!$this->mail_retr_msg($msg, 0)) {
                        return false;
                    }
                    $this->mail_set_flag($msg, '\\SEEN', '-');
                }
            }
            // ensure that the original file exist
            if (file_exists($msg['localname'])) {
                $currentname = $msg['localname'];
                $basename = basename($currentname);
                $newfilename = $this->userfolder."$tofolder/$basename";
                copy($currentname, $newfilename);
                // ensure that the copy exist
                if (file_exists($newfilename)) {
                    unlink($currentname);
                    // delete from server if we are working on inbox or spam
                    if ($msg['folder'] == 'inbox' || $msg['folder'] == 'spam') {
                        $this->mail_send_command('DELE '.$msg['mnum']);
                        if ($this->mail_nok_resp()) {
                            return false;
                        }
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }

        return true;
    }

    /**
     * Move specific email message
     * @param  string  $msg      The message to move
     * @param  string  $tofolder
     * @return boolean
     */
    public function mail_move_msg($msg, $tofolder)
    {
        if ($this->mail_protocol == IMAP) {
            return $this->_mail_move_msg_imap($msg, $tofolder);
        } else {
            return $this->_mail_move_msg_pop($msg, $tofolder);
        }
    }

    protected function _mail_list_msgs_imap($boxname = 'inbox')
    {
        $msg = [];
        $header = '';
        $curmsg = $size = $flags = $uid = '';
        $counter = 0;
        $new = 0;
        /* select the mail box and make sure that it exists */
        $boxinfo = $this->mail_select_box($boxname);
        $now = time();
        if (is_array($boxinfo) &&
            $boxinfo['exists'] &&
            $this->iam_stale($boxname)) {
            /* if the box is ok, fetch the first to the last message, getting the size, header and uid */
            /* This is FAST under IMAP, so we scarf the whole dataset */

            $this->mail_send_command('UID FETCH 1:* (FLAGS RFC822.SIZE RFC822.HEADER)');
            $buffer = $this->mail_read_response();

            /* if any problem, stop the procedure */
            if ($this->mail_nok_resp($buffer)) {
                return $counter;
            }

            /* the end mark is <sid> OK FETCH, we are waiting for it*/
            while (!$this->mail_ok_resp($buffer)) {
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
                    if (!$this->tdb->message_exists($msg)) {
                        $msg['id'] = $counter + 1; //$msgs[0];
                        $msg['mnum'] = intval($curmsg);
                        $msg['size'] = intval($size);
                        $msg['flags'] = strtoupper($flags);
                        $msg['folder'] = $boxname;
                        $msg['islocal'] = false;
                        $msg['uid'] = $uid;
                        $mail_info = $this->formalize_headers($header);
                        self::add2me($msg, $mail_info);
                        $this->tdb->do_message($msg);
                        $new++;
                    }
                    unset($msg);
                    $msg = [];
                    $header = '';
                    $counter++;
                }
                $buffer = $this->mail_read_response();
            }
        }
        return $new;
    }

    protected function _mail_list_msgs_pop($boxname = 'inbox')
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
        if ($boxname == 'inbox' && $this->iam_stale($boxname)) {
            /*
             * First, grab list of UIDLs and message numbers from the server
             * If we have these, then we can populate and add the message
             * immediately, otherwise, we need to do so one at a time
             */
            $uids = [];
            $nouids = [];
            if (!empty($this->capabilities['UIDL'])) {
                $this->mail_send_command("UIDL");
                $buffer = $this->mail_read_response();
                if (substr($buffer, 0, 3) == "+OK") {
                    while (!self::_feof($this->_mail_connection)) {
                        $buffer = $this->mail_read_response();
                        if(trim($buffer) == ".") {
                            break;
                        }
                        list ($num,$uidl) = explode(" ",$buffer);
                        if (!empty($uidl)) {
                            $uids[intval($num)] = self::md5($uidl);
                        }
                    }
                }
            }

            /* First, see what messages live on the server */
            $this->mail_send_command('LIST');
            /* if any problem with this messages list, stop the procedure */
            if ($this->mail_nok_resp()) {
                return $counter;
            }
            while (!self::_feof($this->_mail_connection)) {
                $buffer = $this->mail_read_response();
                $buffer = chop($buffer); // trim buffer here avoid CRLF include on msg size (causes error on TOP)
                if ($buffer == '.') {
                    break;
                }
                $msgs = explode(' ', $buffer);
                if (is_numeric($msgs[0])) {
                    $mnum = intval($msgs[0]);
                    $msg['id'] = $counter + 1; //$msgs[0];
                    $msg['mnum'] = $mnum;
                    $msg['size'] = intval($msgs[1]);
                    $msg['folder'] = $boxname;
                    $msg['islocal'] = false;
                    /* If we have a UIDL, then use it, otherwise, we check later */
                    if (isset($uids[$mnum])) {
                        $msg['uidl'] = $uids[$mnum];
                    } else {
                        $nouids[] = $msg;
                    }
                    if (!$this->tdb->message_exists($msg)) {
                        $this->tdb->do_message($msg);
                        $new++;
                    }
                    unset($msg);
                    $msg = [];
                    $counter++;
                }
            }
            foreach ($nouids as $msg) {
                $msg['uidl'] = $this->_mail_get_uidl($msg);
                if (!$this->tdb->message_exists($msg)) {
                    $this->tdb->do_message($msg);
                    $new++;
                }
            }
        }
        return $new;
    }

    private function _walk_folder($boxname, $folder, &$i, $version = null)
    {
        if ($version === null) {
            $version = $this->_version;
        }
        foreach (scandir($folder) as $entry) {
            if ($entry == '' || $entry == '.' || $entry == '..') {
                continue;
            }
            $fullpath = $folder.'/'.$entry;
            if (is_file($fullpath)) {
                unset($msg);
                $msg = [];
                $thisheader = $this->_get_headers_from_cache($fullpath);
                $msg['id'] = $i + 1;
                $msg['mnum'] = $i;
                $msg['size'] = filesize($fullpath);
                $msg['localname'] = $fullpath;
                $msg['folder'] = $boxname;
                $msg['islocal'] = true;
                $msg['version'] = $version;
                $mail_info = $this->formalize_headers($thisheader);
                self::add2me($msg, $mail_info);
                $msg['uidl'] = $this->_mail_get_uidl($msg);
                $this->tdb->do_message($msg);
                $i++;
            }
            if (is_dir($fullpath)) {
                $this->_walk_folder($boxname, $fullpath, $i);
            }
        }
    }
    /*
     * The below returns an 3 element array:
     *	 $myreturnarray[0] == The message list
     *	 $myreturnarray[1] == the auto-spam populated list
     *	 $myreturnarray[2] == return status where:
     *	   -1 = Error; 0 = OK, No Changes; 1 = OK, Had Changes
     * NOTE: $myreturnarray[0] is ALWAYS the $boxname list !
     */
    /**
     * List all messages in emailbox
     * @param  string  $boxname       The name of emailbox
     * @param  array   $localmessages
     * @param  integer $start
     * @param  integer $wcount
     * @return array
     */
    public function &mail_list_msgs($boxname = 'inbox', $start = 0, $wcount = 1024)
    {
        $fetched_part = 0;
        $parallelized = 0;
        // $this->havespam = '';

        // First get info from DB
        $this->tdb->get_messages($boxname);
        if (!$this->tdb->current_version($boxname, $this->_version)) {
            /*
             * Ideally, we do this only once per user, after which any changes
             * to the local system will be also reflected automatically in the DB.
             * If no email is stored locally, though, we do this everytime
             * (but no messages exist, so it's moot)
             */
            $this->tdb->upgrade_version($boxname, $this->_version);
            $datapath = $this->userfolder.$boxname;
            $i = 0;
            $this->_walk_folder($boxname, $datapath, $i, 1);
        }
        /* choose the protocol and get list from server */
        if ($this->mail_protocol == IMAP) {
            $this->_mail_list_msgs_imap($boxname);
        } else {
            $this->_mail_list_msgs_pop($boxname);
        }
        $messages = &$this->tdb->get_messages($boxname);
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
            if ((($j < $start) || ($j >= $end_pos)) && $messages[$i]['hparsed']) {
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
            if (!$messages[$i]['hparsed']) {
                if ($messages[$i]['header'] == '') {
                    $header = $this->mail_retr_header($messages[$i]);
                    $messages[$i]['header'] = $header;
                }
                $mail_info = $this->formalize_headers($messages[$i]['header']);
                self::add2me($messages[$i], $mail_info);
                $messages[$i]['attach'] = (preg_match('#(multipart/mixed|multipart/related|application)#i',
                    $mail_info['content-type'])) ? 1 : 0;

                if ($messages[$i]['localname'] == '') {
                    $messages[$i]['localname'] = $this->_get_local_name($messages[$i]['uidl'], $boxname);
                }
                $this->tdb->do_message($messages[$i]);
            }
            $isspam = false;
            $spamsubject = $mail_info['headers']['subject'];
            $xspamlevel = $mail_info['headers']['x-spam-level'];
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

    protected function _get_local_name($message, $boxname)
    {
        if (is_array($message)) {
            $fname = trim($message['uidl']);
        } else {
            $fname = trim($message);
        }
        if (!self::is_md5($fname)) {
            $fname = self::md5($fname);
        }
        $fullpath = trim($this->userfolder."$boxname/".$fname[0].'/'.$fname.'.eml');
        return [$fullpath, $fname];
    }

    protected function _mail_list_boxes_imap($boxname = '')
    {
        if ($boxname == '*') {
            $this->mail_send_command("LIST \"\" $boxname");
            $buffer = $this->mail_read_response();
            /* if any problem, stop the script */
            if ($this->mail_nok_resp($buffer)) {
                return $this->tdb->folders;
            }
            /* loop throught the list and split the parts */
            while (!$this->mail_ok_resp($buffer)) {
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
                $tmp['name'] = self::utf7_8($this->fix_prefix(trim(preg_replace('|"(.*)"|', "$1",
                    substr($rest, $pos + 1))), 0));
                $buffer = $this->mail_read_response();
                if (empty($this->$tdb->folders[$tmp['name']])) {
                    $this->tdb->new_folder($tmp);
                }
            }
        }
        return $this->tdb->folders;
    }

    public function _mail_list_boxes_pop($boxname = '')
    {
        return $this->tdb->folders;
    }
    /**
     * List available emailboxes
     * @param  string $boxname If specific name or glob
     * @return array
     */
    public function mail_list_boxes($boxname = '')
    {
        if ($this->mail_protocol == IMAP) {
            return $this->_mail_list_boxes_imap($boxname);
        } else {
            return $this->_mail_list_boxes_pop($boxname);
        }
    }

    /**
     * Change to specific default emailbox
     * @param  string $boxname Emailbox name to select
     * @return array
     */
    public function mail_select_box($boxname = 'inbox')
    {
        /* this function is used only for IMAP servers */
        $boxinfo = [];
        if ($this->mail_protocol == IMAP) {
            $original_name = preg_replace('|"(.*)"|', "$1", $boxname);
            $boxname = self::utf8_7($this->fix_prefix($original_name, 1));
            $this->mail_send_command("SELECT \"$boxname\"");
            $buffer = $this->mail_read_response();
            if ($this->_mail_parse_resp($buffer) == self::RESP_NO) {
                if ($this->mail_subscribe_box($original_name)) {
                    $this->mail_send_command("SELECT \"$boxname\"");
                    $buffer = $this->mail_read_response();
                }
            }
            if ($this->mail_nok_resp($buffer)) {
                return false;
            }
            /* get total, recent messages and flags */
            while (!$this->mail_ok_resp($buffer)) {
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
                $buffer = $this->mail_read_response();
            }
        }
        $this->tdb->sync_messages();
        $this->_current_folder = $boxname;

        return $boxinfo;
    }

    /**
     * Subscribe to specific default emailbox
     * @param  string  $boxname Emailbox name to subscribe to
     * @return boolean
     */
    public function mail_subscribe_box($boxname = 'inbox')
    {
        /* this function is used only for IMAP servers */
        if ($this->mail_protocol == IMAP) {
            $boxname = $this->fix_prefix(preg_replace('|"(.*)"|', "$1", $boxname), 1);
            $this->mail_send_command("SUBSCRIBE \"$boxname\"");
            if ($this->mail_nok_resp()) {
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
    public function mail_create_box($boxname)
    {
        if ($this->mail_protocol == IMAP) {
            $boxname = $this->fix_prefix(preg_replace('|"(.*)"|', "$1", $boxname), 1);
            $this->mail_send_command("CREATE \"$boxname\"");
            if ($this->mail_ok_resp()) {
                if (@mkdir($this->userfolder.$this->fix_prefix($boxname, 0), $this->dirperm)) {
                    return true;
                }
            }
            return false;
        } else {
            /* if POP3, only make a new folder */
            if (@mkdir($this->userfolder.$boxname, $this->dirperm)) {
                return $this->tdb->new_folder($boxname);
            } else {
                return false;
            }
        }
    }

    private function _mail_delete_box_imap($boxname)
    {
        $boxname = $this->fix_prefix(preg_replace('|"(.*)"|', "$1", $boxname), 1);
        $this->mail_send_command("DELETE \"$boxname\"");

        if ($this->mail_ok_resp()) {
            $this->_RmDirR($this->userfolder.$boxname);
            return true;
        } else {
            return false;
        }
    }

    private function _mail_delete_box_pop($boxname)
    {
        if (is_dir($this->userfolder.$boxname)) {
            $this->_RmDirR($this->userfolder.$boxname);
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
    public function mail_delete_box($boxname)
    {
        if ($this->mail_protocol == IMAP) {
            return $this->_mail_delete_box_imap($boxname);
        } else {
            return $this->_mail_delete_box_pop($boxname);
        }
    }

    private function _mail_save_message_imap($boxname, $message, $flags = '')
    {
        $boxname = $this->fix_prefix(preg_replace('|"(.*)"|', "$1", $boxname), 1);

        // send an append command
        $mailcommand = sprintf('APPEND "%s" (%s) {%d}', $boxname, $flags, strlen($message));
        $this->mail_send_command($mailcommand);

        // wait for a "+ Something" here and not after the msg sent!!
        $buffer = $this->mail_read_response();
        if ($buffer[0] != '+') {
            return false;    // problem appending
        }

        // send the msg
        $mailcommand = "$message";
        $this->mail_send_command($mailcommand, ['addtag' => false]);    // don't send the session id here!

        $buffer = $this->mail_read_response();

        if (!preg_match("|^(".$this->_get_sid()." OK)|i", $buffer)) {
            return false;
        }
        return true;
    }

    /**
     * Save email message to specific emailbox
     * @param  string  $boxname Emailbox name to save to
     * @param  string  $message Message to save
     * @param  string  $flags
     * @return boolean
     */
    public function mail_save_message($boxname, $message, $flags = '')
    {
        if ($this->mail_protocol == IMAP) {
            if (!$this->_mail_save_message_imap($boxname, $message, $flags)) {
                return false;
            }
        }

        $dir = $this->userfolder.$boxname;
        if (!is_dir($dir)) {
            if (!@mkdir($dir, $this->dirperm)) {
                $this->trigger_error("cannot mkdir $dir", __FUNCTION__);
                return false;
            }
        }
        $email = $this->fetch_structure($message);
        $mail_info = $this->formalize_headers($email['header']);
        list($filename, $name) = $this->_get_local_name($mail_info, $boxname);
        $dir = $dir.'/'.$name[0];
        if (!is_dir($dir)) {
            if (!@mkdir($dir, $this->dirperm)) {
                $this->trigger_error("cannot mkdir $dir", __FUNCTION__);
                return false;
            }
        }
        if (!empty($flags)) {
            $message = trim($email['header'])."\r\nX-UM-Flags: $flags\r\n\r\n".$email['body'];
        }
        unset($email);
        $this->save_file($filename, $message);

        return true;
    }

    private function _mail_set_flag_imap(&$msg, $flagname, $flagtype = '+')
    {
        if ($this->_current_folder != $msg['folder']) {
            $this->mail_select_box($msg['folder']);
        }

        if ($flagtype != '+') {
            $flagtype = '-';
        }
        $this->mail_send_command('STORE '.$msg['mnum'].':'.$msg['mnum'].' '.$flagtype."FLAGS ($flagname)");
        $buffer = $this->mail_read_response();

        while (!preg_match("/^(".$this->_get_sid()." (OK|NO|BAD))/i", $buffer)) {
            $buffer = $this->mail_read_response();
        }
        if ($this->mail_nok_resp($buffer)) {
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
    public function mail_set_flag(&$msg, $flagname, $flagtype = '+')
    {
        $flagname = strtoupper($flagname);
        if (!in_array($flagname, $this->flags)) {
            $this->trigger_error("unknown flag: $this->userfolder", __FUNCTION__);
            return false;
        }
        if ($flagtype == '+' && strstr($msg['flags'], $flagname)) {
            return true;
        }
        if ($flagtype == '-' && !strstr($msg['flags'], $flagname)) {
            return true;
        }

        if ($this->mail_protocol == IMAP && in_array($flagname, $this->flags)) {
            if (!$this->_mail_set_flag_imap($msg, $flagname, $flagtype)) {
                return false;
            }
        } elseif (!file_exists($msg['localname'])) {
            $this->mail_retr_msg($msg, 0);
        }

        if (file_exists($msg['localname'])) {
            $email = $this->read_file($msg['localname']);
            $email = $this->fetch_structure($email);
            $header = $email['header'];
            $body = $email['body'];
            $headerinfo = $this->_parse_headers($header);

            $strFlags = trim(strtoupper($msg['flags']));

            $flags = [];
            if (!empty($strFlags)) {
                $flags = explode(' ', $strFlags);
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
            $this->tdb->m_delta[] = [$msg, ['header', 'flags']];

            $email = "$header\r\n\r\n$body";

            $this->save_file($msg['localname'], $email);

            unset($email, $header, $body, $flags, $headerinfo);
        }

        return true;
    }

    /**
     * Disconnect/logout from Email server
     * @return boolean
     */
    public function mail_disconnect()
    {
        if ($this->mail_connected()) {
            if ($this->mail_protocol == IMAP) {
                if ($this->_require_expunge) {
                    $this->mail_expunge();
                }
                $this->mail_send_command('LOGOUT', ['autolog' => false]);
                $this->mail_read_response();
            } else {
                $this->mail_send_command('QUIT', ['autolog' => false]);
                $this->mail_read_response();
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
    public function mail_disconnect_force()
    {
        if ($this->mail_connected()) {
            $this->mail_send_command('FORCEDQUIT', ['autolog' => false]);
            $this->mail_read_response();
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
    public function mail_expunge()
    {
        if ($this->mail_protocol == IMAP) {
            $this->mail_send_command('EXPUNGE');
            $buffer = $this->mail_read_response();
            if ($this->mail_nok_resp($buffer)) {
                return false;
            }
            while (!$this->mail_ok_resp($buffer)) {
                $buffer = $this->mail_read_response();
            }
        }
        return true;
    }

    /*
     * Use the optional POP3 CAPA command to determine
     * what extensions the pop server supports. Returns
     * a hash of supported options.
     */
    protected function _mail_capa_pop3()
    {
        $capa = [];
        $this->mail_send_command('CAPA', ['autolog' => false]);
        $buffer = $this->mail_read_response();
        if ($this->mail_ok_resp($buffer)) {
            while (!self::_feof($this->_mail_connection)) {
                $buffer = trim($this->mail_read_response());
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

    protected function _mail_capa_imap()
    {
        $capa = [];
        $this->mail_send_command('cp01 CAPABILITY', ['autolog' => false, 'addtag' => false]);
        while (!self::_feof($this->_mail_connection)) {
            $buffer = trim($this->mail_read_response());
            $a = preg_split("|\s+|", $buffer);
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
    public function mail_get_capa()
    {
        $close = false;
        if (!$this->mail_connected()) {
            $this->mail_connect();
            $close = true;
        }
        if ($this->mail_protocol == IMAP) {
            $capa = $this->_mail_capa_imap();
        } else {
            $capa = $this->_mail_capa_pop3();
        }
        if ($close) {
            $this->mail_disconnect();
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
     * @return string
     */
    protected function _mail_get_uidl(&$msg)
    {
        $id = $msg['mnum'];
        if (!empty($this->capabilities['UIDL']) && !$msg['islocal']) {
            $this->mail_send_command("UIDL $id");
            $buffer = $this->mail_read_response();
            list($resp, $num, $uidl) = preg_split("|\s+|", $buffer);
            if ($resp == '+OK') {
                $msg['uidl'] = $uidl;
            }
            // If we DON'T get the OK response, we drop through
        }
        if (!empty($msg['uidl'])) {
            return $msg['uidl'];
        } elseif (!empty($msg['subject']) && !empty($msg['date']) && !empty($msg['message-id'])) {
            $msg['uidl'] = self::md5(trim($msg['subject'].$msg['date'].$msg['message-id']));
        } else {
            /* try to grab from header */
            $header = '';
            if (!empty($msg['header'])) {
                $header = $msg['header'];
            } elseif (!$msg['islocal']) {
                $this->mail_send_command('TOP ' . $id . ' 0');
                $buffer = $this->mail_read_response();

                /* if any problem with the server, stop the function */
                if ($this->mail_nok_resp($buffer)) {
                    $msg['uidl'] = self::md5(uniqid(''));
                    return $msg['uidl'];
                }
                while (!self::_feof($this->_mail_connection)) {
                    $buffer = $this->mail_read_response();
                    if (chop($buffer) == '.') {
                        break;
                    }
                    $header .= $buffer;
                }
            } else {
                if (file_exists($msg['localname'])) {
                    $email = $this->read_file($msg['localname']);
                    $email = $this->fetch_structure($email);
                    $header = $email['header'];
                    $msg['header'] = $header;
                } else {
                    $msg['uidl'] = self::md5(trim($msg['subject'].$msg['date'].$msg['message-id']).uniqid(''));
                    return $msg['uidl'];
                }
            }
            $mail_info = $this->formalize_headers($header);
            self::add2me($msg, $mail_info);
            // $this->tdb->add_headers($msg);
            if (!empty($mail_info['uidl'])) {
                return $mail_info['uidl'];
            }
            $msg['uidl'] = self::md5(trim($msg['subject'].$msg['date'].$msg['message-id']));
        }
        if (empty($msg['uidl'])) {
            $msg['uidl'] = self::md5(trim($msg['subject'].$msg['date'].$msg['message-id']).uniqid(''));
        }
        return $msg['uidl'];
    }

    /**
     * Cleanup a set of directorys
     * @param  string  $userfolder The user's local webmail directory
     * @param  boolean $logout     TRUE if we also perform logout cleanups
     * @return void
     */
    public function cleanup_dirs($userfolder, $logout = false)
    {
        if ($this->prefs['keep_on_server']) {
            // inbox is always cleaned up
            $cleanme = $userfolder.'inbox/';
            self::cleanup_dir($cleanme);
            if ($this->mail_protocol == IMAP) {
                /*
                 * For IMAP, this determines whether we simply
                 * cache what's on the IMAP server, or we exclusively
                 * store email. If we simply cache, clean up whatever
                 * data still exists locally.
                 */
                foreach ($this->tdb->folders as $folder) {
                    if ($folder != $this->tdb->udatafolder) {
                        $cleanme = $userfolder.$folder.'/';
                        self::cleanup_dir($cleanme);
                    }
                }
            }
        }

        if ($logout) {
            if ($this->mail_protocol == IMAP) {
                if (!$this->mail_connect()) $this->redirect_and_exit('index.php?err=1', true);
                if (!$this->mail_auth()) $this->redirect_and_exit('index.php?err=0');
            }
            if ($this->prefs['empty_trash']) {
                $trash = &$this->tdb->get_messages('trash');
                if (count($trash) > 0) {
                    foreach ($trash as $msg) {
                        $this->mail_delete_msg($msg, false);
                    }
                    $this->mail_expunge();
                }
            }

            if ($this->prefs['empty_spam']) {
                if (!$this->mail_connect()) $this->redirect_and_exit('index.php?err=1', true);
                if (!$this->mail_auth()) $this->redirect_and_exit('index.php?err=0');
                $trash = &$this->tdb->get_messages('spam');
                if (count($trash) > 0) {
                    foreach ($trash as $msg) {
                        $this->mail_delete_msg($msg, false);
                    }
                    $this->mail_expunge();
                }
            }
            $this->mail_disconnect();
        }
    }

    /**
     * If we are past the "check for new mail" deadline,
     * we call this to poll for new messages for all
     * emailboxes/folders and then update the folders DB
     * as needed.
     */
    public function refresh_folders()
    {
        $wasstale = false;
        $boxes = $this->mail_list_boxes();
        foreach ($boxes as $folder => $f) {
            if ($this->iam_stale($folder)) {
                $this->mail_list_msgs($folder);
                $wasstale = true;
                $this->unstale($folder);
            }
        }
        if ($wasstale) {
        /*
         * Now is as good a time as whenever to poll the DB log
         */
            list($ok, $log) = $this->tdb->status();
            if (!$ok) {
                foreach ($log as $l) {
                    $this->debug_msg($l, __FUNCTION__);
                }
            }
        }
    }

    /**
     * See if the folder info is "stale" (ie: time to check for new messages)
     * @param string $folder Folder to check
     * @return bool
     */
    public function iam_stale($folder)
    {
        return ($this->tdb->folders[$folder]['refreshed'] < ($this->_now - $this->prefs['refresh_time']));
    }

    /**
     * Reset refreshed field and make the folder no longer "stale"
     * @param string $folder Folder to check
     * @return bool
     */
    public function unstale($folder)
    {
        $this->tdb->folders[$folder]['refreshed'] = $this->_now;
        $this->tdb->update_folder_field($folder, 'refreshed');
    }
}
