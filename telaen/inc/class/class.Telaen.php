<?php
// namespace Telaen;
require_once './inc/class/class.Telaen_core.php';
require_once './inc/vendor/class.tnef.php';

class Telaen extends Telaen_core
{
    public $havespam       = "";        // NOTE: This is a STRING!
    public $CRLF           = "\r\n";
    public $dirperm        = 0700;        // recall affected by umask value
    public $greeting       = "";        // Internally used for store initial IMAP/POP3 greeting message
    public $capabilities   = array();
    public $flags          = array('\\SEEN', '\\DELETED', '\\ANSWERED', '\\DRAFT', '\\FLAGGED', '\\RECENT');

    protected $_current_folder = "";
    protected $_spamregex      = array("^\*\*\*\*\*SPAM\*\*\*\*\*", "^\*\*\*\*\*VIRUS\*\*\*\*\*");
    protected $_serverurl      = "";
    protected $_respnum        = 0;
    protected $_respstr        = "";

    const RESP_OK =   0;
    const RESP_NO =  -1;
    const RESP_BAD = -2;
    const RESP_BYE = -3;
    const RESP_NOK = -4;
    const RESP_UNKNOWN = 99;

    /**
     * Contructor
     */
    public function __construct()
    {
        $this->_tnef = new TNEF();
    }

    /**
     * Is this a valid folder name?
     * @param type $name folder name to check
     * @param type $checksys Check against system folders?
     * @return boolean
     */
    public function valid_folder_name($name, $checksys = false)
    {
        if ($name == "") {
            return false;
        }
        // Folder names that match system folder names are NOT valid
        if ($checksys && $this->is_system_folder($name)) {
            return false;
        }

        return !preg_match('|[^A-Za-z0-9_-]|', $name);
    }
    /**
     * Check if we are connected to email server
     * @return boolean
     */
    public function mail_connected()
    {
        if (!empty($this->_mail_connection)) {
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
        return $this->mbox->folders[strtolower($name)]['system'];
    }

    /**
     *
     * @param  string $string Response string to parse
     * @return int
     */
    protected function _mail_parse_resp($string)
    {
        $resp = self::RESP_UNKNOWN;
        $match = array();
        if ($this->mail_protocol == IMAP) {
            if (preg_match('|^[a-z0-9*]+\s+(OK|NO|BAD|BYE)(.*)$|i', trim($string), $match)) {
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
    public function mail_ok_resp($string)
    {
        $resp = $this->_mail_parse_resp($string);

        return ($resp == self::RESP_OK);
    }

    /**
     *
     * @param  string  $string Response string to checkout
     * @return boolean True if we saw an explicit error
     */
    public function mail_nok_resp($string)
    {
        $resp = $this->_mail_parse_resp($string);

        return ($resp < self::RESP_OK);
    }

    protected function _mail_get_line()
    {
        $buffer = fgets($this->_mail_connection, 8192);
        $buffer = preg_replace('|\r?\n|', "\r\n", $buffer);
        if ($this->config['enable_debug']) {
            $this->debug_msg($buffer, __FUNCTION__);
        }

        return $buffer;
    }

    /*
     * Send the supplied command to the mail server. Auto-
     * appends the required EOL chars to the command.
     * The provided parameter is either the command string to
     * send or an array of command strings that will be
     * sent one after another in order.
     */
    protected function _mail_send_command($cmds, $addTag = true)
    {
        if ($this->mail_connected()) {
            if (!is_array($cmds)) {
                $cmds = (array) $cmds;
            }
            foreach ($cmds as $cmd) {
                $regs = array();
                $cmd = trim($cmd).$this->CRLF;
                $output = (preg_match('/^(PASS|LOGIN)/', $cmd, $regs)) ? $regs[1]." ****" : $cmd;
                if ($this->mail_protocol == IMAP && $addTag) {
                    $cmd = $this->get_sid(true).' '.$cmd;
                    $output = $this->get_sid().' '.$output;
                }
                fwrite($this->_mail_connection, $cmd);
                if ($this->config['enable_debug']) {
                    $this->debug_msg($output, __FUNCTION__);
                }
            }

            return true;
        }
        if ($this->config['log_errors']) {
            $this->trigger_error("attempt to send command w/o connection", __FUNCTION__);
        }

        return false;
    }

    /**
     * Connect to email server. TRUE if successful
     * @return boolean
     */
    public function mail_connect()
    {
        if (!$this->mail_connected()) {
            if (!$this->_serverurl) {
                $this->_serverurl = ($this->use_ssl ? 'ssl://' : 'tcp://').
                    $this->mail_server.':'.$this->mail_port;
            }
            $errno = 0;
            $errstr = 0;
            $this->_mail_connection = stream_socket_client($this->_serverurl, $errno, $errstr, 15);
            if ($this->_mail_connection) {
                $this->greeting = $this->_mail_get_line();
                if ($this->mail_ok_resp($this->greeting)) {
                    return true;
                } else {
                    return false;
                }
            }
            if ($this->config['log_errors']) {
                $this->trigger_error("Cannot connect to: $this->_serverurl", __FUNCTION__);
            }

            return false;
        }

        return true;
    }

    /**
     * Authentication for IMAP
     * @param  boolean $checkfolders
     * @return booean
     */
    protected function _mail_auth_imap($checkfolders = false)
    {
        $this->_mail_send_command('LOGIN '.$this->mail_user.' '.$this->mail_pass);
        $buffer = $this->_mail_get_line();
        if ($this->mail_ok_resp($buffer)) {
            if ($checkfolders) {
                $this->_check_folders();
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Authentication for POP3
     * @param  boolean $checkfolders
     * @return booean
     */
    protected function _mail_auth_pop($checkfolders = false)
    {
        $tokens = array();;
        // APOP login mode, more secure
        if ($this->capabilities['APOP'] && preg_match('/<.+@.+>/U', $this->greeting, $tokens)) {
            $this->_mail_send_command('APOP '.$this->mail_user.' '.md5($tokens[0].$this->mail_pass));
        }
        // Classic login mode
        else {
            $this->_mail_send_command('USER '.$this->mail_user);

            $buffer = $this->_mail_get_line();
            if ($this->mail_ok_resp($buffer)) {
                $this->_mail_send_command('PASS '.$this->mail_pass);
            } else {
                return false;
            }
        }

        $buffer = $this->_mail_get_line();
        if ($this->mail_ok_resp($buffer)) {
            if ($checkfolders) {
                $this->_check_folders();
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if user is authenticated to the email server
     * @param  boolean $checkfolders Check folder access as well
     * @return boolean
     */
    public function mail_auth($checkfolders = false)
    {
        if ($this->mail_connected()) {
            if ($this->_authenticated) {
                return true;
            } else {
                if ($this->mail_protocol == IMAP) {
                    $this->_authenticated = $this->_mail_auth_imap($checkfolders);
                } else {
                    $this->_authenticated = $this->_mail_auth_pop($checkfolders);
                }
                // if ($this->_authenticated) $this->mail_get_capa();
                return $this->_authenticated;
            }
        }
        return false;
    }

    protected function _check_folders()
    {
        if (!file_exists($this->userfolder)) {
            if (!@mkdir($this->userfolder, $this->dirperm) && $this->config['log_errors']) {
                $this->trigger_error("mkdir error: $this->userfolder", __FUNCTION__);
            }
        }

        $boxes = $this->mail_list_boxes();

        if ($this->mail_protocol == IMAP) {
            $tmp = $this->mbox->folders;

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
                        if (!@mkdir($this->userfolder.$current_folder, $this->dirperm) && $this->config['log_errors']) {
                            $this->trigger_error("mkdir error: {$this->userfolder}{$current_folder}", __FUNCTION__);
                        }
                    }
                }
            }
        }

        $system_folders = array_merge((array) $this->_system_folders, array('_attachments', '_infos'));

        while (list($index, $value) = each($system_folders)) {
            $value = $this->fix_prefix($value, 1);
            if (!file_exists($this->userfolder.$value)) {
                if ($this->is_system_folder($value)) {
                }
                if (!@mkdir($this->userfolder.$value, $this->dirperm) && $this->config['log_errors']) {
                    $this->trigger_error("mkdir error: {$this->userfolder}{$value}", __FUNCTION__);
                }
            }
        }
    }

    protected function _mail_retr_msg_imap(&$msg, $check = 1)
    {
        $msgheader = $msg['header'];

        if ($check) {
            if ($this->_current_folder != $msg['folder']) {
                $boxinfo = $this->mail_select_box($msg['folder']);
            }

            $this->_mail_send_command('FETCH '.$msg['msg'].':'.$msg['msg'].' BODY.PEEK[HEADER.FIELDS (Message-Id)]');
            $buffer = chop($this->_mail_get_line());
            if ($this->mail_nok_resp($buffer)) {
                return false;
            }
            while (!$this->mail_ok_resp($buffer)) {
                if (preg_match('|message-id: (.*)|i', $buffer, $regs)) {
                    $current_id = preg_replace('|<(.*)>|', "$1", $regs[1]);
                }
                $buffer = chop($this->_mail_get_line());
            }

            if ($current_id != $msg['message-id']) {
                if ($this->config['log_errors']) {
                    $this->trigger_error(sprintf("Message ID's differ: [%s/%s]",
                        $current_id,
                        $msg['message-id']), __FUNCTION__);
                }

                return false;
            }
        }

        if (file_exists($msg['localname'])) {
            $msgcontent = $this->read_file($msg['localname']);
        } else {
            $this->_mail_send_command('FETCH '.$msg['msg'].':'.$msg['msg'].' BODY[TEXT]');
            $buffer = $this->_mail_get_line();
            if ($this->mail_nok_resp($buffer)) {
                return false;
            }
            if (preg_match('|\\{(.*)\\}|', $buffer, $regs)) {
                $bytes = $regs[1];
            }

            $buffer = $this->_mail_get_line();
            while (!$this->mail_ok_resp($buffer)) {
                if (!preg_match('|[ ]?\\*[ ]?[0-9]+[ ]?FETCH|i', $buffer)) {
                    $msgbody .= $buffer;
                }
                $buffer = $this->_mail_get_line();
            }
            $pos = strrpos($msgbody, ")");
            if (!($pos === false)) {
                $msgbody = substr($msgbody, 0, $pos);
            }

            $msgcontent = "$msgheader\r\n\r\n$msgbody";

            $this->save_file($msg['localname'], $msgcontent);
        }

        return $msgcontent;
    }

    protected function _mail_retr_msg_pop(&$msg, $check = 1)
    {
        if ($check && ($msg['folder'] == 'inbox' || $msg['folder'] == 'spam')) {
            $muidl = $this->_mail_get_uidl($msg['msg']);
            if ($msg['uidl'] && ($msg['uidl'] != $muidl)) {
                $this->trigger_error(sprintf("UIDL's differ: [%s/%s]",
                    $msg['uidl'],
                    $muidl),__FUNCTION__);

                return false;
            }
        }

        if (file_exists($msg['localname'])) {
            $msgcontent = $this->read_file($msg['localname']);
        } elseif ($msg['folder'] == 'inbox' || $msg['folder'] == 'spam') {
            $command = ($this->config['mail_use_top']) ? 'TOP '.$msg['msg'].' '.$msg['size'] : 'RETR '.$msg['msg'];
            $this->_mail_send_command($command);

            $buffer = $this->_mail_get_line();

            if ($this->mail_nok_resp($buffer)) {
                return false;
            }
            $last_buffer = 0;
            $msgcontent = "";
            while (!feof($this->_mail_connection)) {
                $buffer = $this->_mail_get_line();
                if (chop($buffer) == '.') {
                    break;
                }
                $msgcontent .= $buffer;
            }
            $email = $this->fetch_structure($msgcontent);
            $header = $email['header'];
            $body = $email['body'];
            $mail_info = $this->get_mail_info($header);

            // Since we are pulling this message for the first
            // time from the server, we need to add in our UIDL
            // header. Thus, it will always now be available on
            // the cached/local version.
            $uidl = $this->_mail_get_uidl($msg['msg'], $mail_info);
            $header .= "\r\nX-UM-UIDL: $uidl";

            // Update globally
            $msg['header'] = $header;
            $msg['flags'] = $flags;
            $msg['uidl'] = $uidl;

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
        /* This assumes that we read in the entire boxes in imap. */
        return $msg['header'];
    }

    protected function _mail_retr_header_pop($msg)
    {
        /*
         * Fetch headers serially. Very slow.
         */
        $this->_mail_send_command('TOP '.$msg['msg'].' 0');
        $buffer = $this->_mail_get_line();
        /* if any problem with this messages list, stop the procedure */
        if ($this->mail_nok_resp($buffer)) {
            return false;
        }

        while (!feof($this->_mail_connection)) {
            $buffer = $this->_mail_get_line();
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

    protected function _mail_delete_msg_imap($msg, $send_to_trash = 1, $save_only_read = 0)
    {
        $read = (preg_match('|\\SEEN|', $msg['flags'])) ? 1 : 0;

        /* check the message id to make sure that the messages still in the server */
        if ($this->_current_folder != $msg['folder']) {
            $boxinfo = $this->mail_select_box($msg['folder']);
        }

        $this->_mail_send_command('FETCH '.$msg['msg'].':'.$msg['msg'].' BODY.PEEK[HEADER.FIELDS (Message-Id)]');
        $buffer = chop($this->_mail_get_line());

        /* if any problem with the server, stop the function */
        if ($this->mail_nok_resp($buffer)) {
            return false;
        }

        while (!$this->mail_ok_resp($buffer)) {
            /* we need only the message id yet */

            if (preg_match('|message-id: (.*)|i', $buffer, $regs)) {
                $current_id = preg_replace('|<(.*)>|', "$1", $regs[1]);
            }

            $buffer = chop($this->_mail_get_line());
        }

        /* compare the old and the new message id, if different, stop*/
        if ($current_id != $msg['message-id']) {
            $this->trigger_error(sprintf("Message ID's differ: [%s/%s]",
                $current_id,
                $msg['message-id']), __FUNCTION__);

            return false;
        }

        /*if the pointer is here, no one problem occours*/

        if ($send_to_trash &&
            $msg['folder'] != 'trash' &&
            (!$save_only_read || ($save_only_read && $read))) {
            $trash_folder = $this->fix_prefix('trash', 1);

            $this->_mail_send_command('COPY '.$msg['msg'].':'.$msg['msg']." \"$trash_folder\"");
            $buffer = $this->_mail_get_line();

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

        return $this->mbox->del_message($msg);
    }

    protected function _mail_delete_msg_pop($msg, $send_to_trash = 1, $save_only_read = 0)
    {
        $read = (preg_match('|\\SEEN|', $msg['flags'])) ? 1 : 0;

        /* now we are working with POP3 */
        /* check the message id to make sure that the messages still in the server */
        if ($msg['folder'] == 'inbox' || $msg['folder'] == 'spam') {
            /* compare the old and the new message uidl, if different, stop*/
            $muidl = $this->_mail_get_uidl($msg['msg']);
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

            $this->_mail_send_command('DELE '.$msg['msg']);
            $buffer = $this->_mail_get_line();
            if ($this->mail_nok_resp($buffer)) {
                return false;
            }
        }

        if ($send_to_trash &&
            $msg['folder'] != 'trash' &&
            (!$save_only_read || ($save_only_read && $read))) {
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

        return $this->mbox->del_message($msg);
    }

    /**
     * Delete specific email message
     * @param  string  $msg            The message to delete
     * @param  boolean $send_to_trash
     * @param  boolean $save_only_read
     * @return boolean
     */
    public function mail_delete_msg($msg, $send_to_trash = 1, $save_only_read = 0)
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
            /* check the message id to make sure that the messages still in the server */
            if ($this->_current_folder != $msg['folder']) {
                $boxinfo = $this->mail_select_box($msg['folder']);
            }

            $this->_mail_send_command('FETCH '.$msg['msg'].':'.$msg['msg'].' BODY.PEEK[HEADER.FIELDS (Message-Id)]');
            $buffer = chop($this->_mail_get_line());

            /* if any problem with the server, stop the function */
            if ($this->mail_nok_resp($buffer)) {
                return false;
            }

            while (!$this->mail_ok_resp($buffer)) {
                /* we need only the message id yet */

                if (preg_match('|message-id: (.*)|i', $buffer, $regs)) {
                    $current_id = preg_replace('|<(.*)>|', "$1", $regs[1]);
                }

                $buffer = chop($this->_mail_get_line());
            }

            /* compare the old and the new message id, if different, stop*/
            if ($current_id != $msg['message-id']) {
                $this->trigger_error(sprintf("Message ID's differ: [%s/%s]",
                    $current_id,
                    $msg['message-id']), __FUNCTION__);

                return false;
            }

            $tofolder = $this->fix_prefix($tofolder, 1);

            $this->_mail_send_command('COPY '.$msg['msg'].':'.$msg['msg']." \"$tofolder\"");
            $buffer = $this->_mail_get_line();

            /* if any problem with the server, stop the function */
            if ($this->mail_nok_resp($buffer)) {
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
                $muidl = $this->_mail_get_uidl($msg['msg']);
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
                        $this->_mail_send_command('DELE '.$msg['msg']);
                        $buffer = $this->_mail_get_line();
                        if ($this->mail_nok_resp($buffer)) {
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

    protected function _mail_list_msgs_imap($boxname = 'inbox', $localmessages = array())
    {
        $messages = array();

        /* select the mail box and make sure that it exists */
        $boxinfo = $this->mail_select_box($boxname);

        if (is_array($boxinfo) && $boxinfo['exists']) {
            /* if the box is ok, fetch the first to the last message, getting the size and the header */
            /* This is FAST under IMAP, so we scarf the whole dataset */

            $this->_mail_send_command('FETCH 1:'.$boxinfo['exists'].' (FLAGS RFC822.SIZE RFC822.HEADER)');
            $buffer = $this->_mail_get_line();

            /* if any problem, stop the procedure */
            if ($this->mail_nok_resp($buffer)) {
                return $messages;
            }

            $counter = 0;
            /* the end mark is <sid> OK FETCH, we are waiting for it*/
            while (!$this->mail_ok_resp($buffer)) {
                /* if the return is something such as * N FETCH, a new message will displayed  */
                if (preg_match('|[ ]?\\*[ ]?([0-9]+)[ ]?FETCH|i', $buffer, $regs)) {
                    $curmsg = $regs[1];
                    preg_match('|SIZE[ ]?([0-9]+)|i', $buffer, $regs);
                    $size = $regs[1];
                    preg_match('|FLAGS[ ]?\\((.*)\\)|i', $buffer, $regs);
                    $flags = $regs[1];
                /* if any problem, add the current line to buffer */
                } elseif (trim($buffer) != ")" && trim($buffer) != "") {
                    $header .= $buffer;

                /*	the end of message header was reached, increment the counter and store the last message */
                } elseif (trim($buffer) == ")") {
                    $messages[$counter]['id'] = $counter+1; //$msgs[0];
                    $messages[$counter]['msg'] = intval($curmsg);
                    $messages[$counter]['size'] = intval($size);
                    $messages[$counter]['flags'] = strtoupper($flags);
                    $messages[$counter]['header'] = $header;
                    $counter++;
                    $header = "";
                }
                $buffer = $this->_mail_get_line();
            }
        }

        return $messages;
    }

    protected function _mail_list_msgs_pop($boxname = 'inbox', $localmessages = array())
    {
        // $this->havespam = "";

        $messages = array();

        /*
        now working with POP3
        if the boxname is 'inbox' or 'spam', we can check in the server for messsages

        NOTE how special inbox is... This is the only Email box that lives on
        the actual Email server (the pophost) and so we need to jump thru a lot
        of hoops to determine which messages are there.

        Due to how SLOW POP is, we simply read in the full list of message
        but don't worry about headers at all, until we really, really
        need to.
        */
        if ($boxname == 'inbox' || $boxname == 'spam') {
            $this->_mail_send_command('LIST');
            $buffer = $this->_mail_get_line();
            /* if any problem with this messages list, stop the procedure */

            if ($this->mail_nok_resp($buffer)) {
                return -1;
            }

            $counter = 0;

            while (!feof($this->_mail_connection)) {
                $buffer = $this->_mail_get_line();
                $buffer = chop($buffer); // trim buffer here avoid CRLF include on msg size (causes error on TOP)
                if ($buffer == '.') {
                    break;
                }
                $msgs = explode(' ', $buffer);
                if (is_numeric($msgs[0])) {
                    $messages[$counter]['id'] = $counter+1; //$msgs[0];
                    $messages[$counter]['msg'] = intval($msgs[0]);
                    $messages[$counter]['size'] = intval($msgs[1]);
                    $counter++;
                }
            }

            if (!is_array($localmessages)) {
                $localmessages = (array) $localmessages;
            }
            $localcount = count($localmessages);
            $onservercount = count($messages);

            if ($onservercount < $localcount || $localcount == 0) {
                /*
                 * Someone deleted some messages on the server, refetch all
                 * headers via TOP, or we just didn't had any messages previously.
                 */

                ; // pass;
            } elseif ($onservercount >= $localcount) {
                /*
                 * More messages have arrived or we still have the same amount of messages.
                 * Keep our old array and skip all the rest. Check if the last message
                 * is still at the same place, else we refetch all message
                 * headers again, because it is too complicated to see which messages we
                 * have or haven't.
                 */
                $oldid = $localmessages[$localcount - 1]['uidl'];
                $newid = $this->_mail_get_uidl($messages[$localcount - 1]['msg']);

                if ("$oldid" == "$newid") {
                    // Ok the ids are the same and we have new messages

                    /*
                     * Quick check. If we have the same number and all
                     * have been seen, no need to parse anything.
                     */
                    if ($localcount == $onservercount) {
                        $seen_all = true;
                        for ($i = 0; $i<$onservercount; $i++) {
                            if (!$messages[$i]['hparsed']) {
                                $seen_all = false;
                                break;
                            }
                        }
                        if ($seen_all) {
                            return false;
                        }
                    }

                    for ($i = $localcount; $i<$onservercount; $i++) {
                        /**
                         * Add the basic info (index and size) and then msg header
                         * of the new msg to the old headers array
                         */
                        $localmessages[$i] = $messages[$i];
                        $localmessages[$i]['header'] = "";
                    }
                    // now the localmessages are updated with the new ones
                    $messages = $localmessages;
                }
            }
        } else {
            /* otherwise (not inbox or spam), we need get the message list from a cache (currently, hard disk)*/

            $datapath = $this->userfolder.$boxname;
            $i = 0;
            $d = dir($datapath);
            $dirsize = 0;

            while ($entry = $d->read()) {
                $fullpath = "$datapath/$entry";
                if (is_file($fullpath)) {
                    $thisheader = $this->_get_headers_from_cache($fullpath);
                    $messages[$i]['id'] = $i+1;
                    $messages[$i]['msg'] = $i;
                    $messages[$i]['header'] = $thisheader;
                    $messages[$i]['size'] = filesize($fullpath);
                    $messages[$i]['localname'] = $fullpath;
                    $i++;
                }
            }

            $d->close();
        }
        $this->array_qsort2int($messages, 'msg', 'DESC');

        return $messages;
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
    public function mail_list_msgs($boxname = 'inbox', $localmessages = array(), $start = 0, $wcount = 99999)
    {
        $fetched_part = 0;
        $parallelized = 0;
        // $this->havespam = "";

        /* choose the protocol */
        if ($this->mail_protocol == IMAP) {
            $messages = $this->_mail_list_msgs_imap($boxname, $localmessages);
        } else {
            $messages = $this->_mail_list_msgs_pop($boxname, $localmessages);
            if (!is_array($messages)) {
                $shortcut = array();
                $shortcut[0] = array();
                $shortcut[1] = array();
                $shortcut[2] = $messages;

                return $shortcut;
            }
        }
        /*
         * OK, now we have the message list, that contains id and size and possibly
         * the header as well (if not, we grab as needed).
         * This script will process the header to get subject, date and other
         * informations formatted to be displayed in the message list when needed
         */
        $i = 0;
        $j = 0;
        $y = 0;
        $messagescopy = array();
        $spamcopy = array();
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
        for ($i = 0; $i<$mcount; $i++) {
            $workit = false;
            if ((($j < $start) || ($j >= $end_pos)) && $messages[$i]['hparsed']) {
                $workit = true;
            }
            if (($j >= $start) && ($j <= $end_pos)) {
                $workit = true;
            }

            if (!$workit) {
                $messagescopy[$j] = $messages[$i];
                $j++;
                continue;
            }
            /*
             * At this point, we are within the view window. So we need
             * headers for the message list. We also check for SPAM here
             * as well
             */
            if ($messages[$i]['header'] == "") {
                $header = $this->mail_retr_header($messages[$i]);
                $messages[$i]['header'] = $header;
            }

            $mail_info = $this->get_mail_info($messages[$i]['header']);

            $havespam = 0;
            $spamsubject = $mail_info['subject'];
            $xspamlevel = $mail_info['x-spam-level'];
            /*
             * Only auto-populate the SPAM folder if
             * we are checking the inbox and we have _autospamfolder
             * set :)
             */
            if (($this->prefs['autospamfolder']) &&
                ($boxname == 'inbox' || $boxname == 'spam')) {
                foreach ($this->_spamregex as $spamregex) {
                    if (preg_match("/$spamregex/i", $spamsubject)) {
                        $havespam = 1;
                        $this->havespam = 'TRUE';
                        break;
                    }
                }
                if ($this->prefs['spamlevel']) {
                    preg_match('|[*+]+|', $xspamlevel, $matches);
                    if (strlen($matches[0]) >= $this->prefs['spamlevel']) {
                        $havespam = 1;
                        $this->havespam = 'TRUE';
                    }
                }
            }

            if (! $havespam) {
                $messagescopy[$j] = $messages[$i];

                if ($messages[$i]['hparsed']) {
                    $j++;
                    continue;
                }
                $messagescopy[$j]['hparsed'] = 1;
                $messagescopy[$j]['subject'] = $mail_info['subject'];
                $messagescopy[$j]['date'] = $mail_info['date'];
                $messagescopy[$j]['message-id'] = $mail_info['message-id'];
                $messagescopy[$j]['from'] = $mail_info['from'];
                $messagescopy[$j]['to'] = $mail_info['to'];
                $messagescopy[$j]['fromname'] = $mail_info['from'][0]['name'];
                $messagescopy[$j]['to'] = $mail_info['to'];
                $messagescopy[$j]['cc'] = $mail_info['cc'];
                $messagescopy[$j]['priority'] = $mail_info['priority'];
                $messagescopy[$j]['uidl'] = ((!$this->is_valid_md5($mail_info['uidl'])) ?
                                    $this->_mail_get_uidl($messagescopy[$j]['msg'], $mail_info) :
                                    $mail_info['uidl']);
                $messagescopy[$j]['attach'] = (preg_match('#(multipart/mixed|multipart/related|application)#i',
                                    $mail_info['content-type'])) ? 1 : 0;

                if ($messagescopy[$j]['localname'] == "") {
                    $messagescopy[$j]['localname'] = $this->_get_local_name($messagescopy[$j]['uidl'], $boxname);
                }

                // $messagescopy[$j]['read'] = file_exists($messagescopy[$j]['localname'])?1:0;

                /*
                 * ops, a trick. if the message is not imap, the flags are stored in
                 * a special field on headers
                 */

                if ($this->mail_protocol != IMAP && file_exists($messagescopy[$j]['localname'])) {
                    $iheaders = $this->_get_headers_from_cache($messagescopy[$j]['localname']);
                    $iheaders = $this->_decode_header($iheaders);
                    $messagescopy[$j]['flags'] = strtoupper($iheaders['x-um-flags']);
                    unset($iheaders);
                }
                $messagescopy[$j]['folder'] = $boxname;

                $j++;
            } else {
                $spamcopy[$y] = $messages[$i];
                if ($messages[$i]['hparsed']) {
                    $y++;
                    continue;
                }

                $spamcopy[$y]['hparsed'] = 1;
                $spamcopy[$y]['subject'] = $mail_info['subject'];
                $spamcopy[$y]['date'] = $mail_info['date'];
                $spamcopy[$y]['message-id'] = $mail_info['message-id'];
                $spamcopy[$y]['from'] = $mail_info['from'];
                $spamcopy[$y]['to'] = $mail_info['to'];
                $spamcopy[$y]['fromname'] = $mail_info['from'][0]['name'];
                $spamcopy[$y]['to'] = $mail_info['to'];
                $spamcopy[$y]['cc'] = $mail_info['cc'];
                $spamcopy[$y]['priority'] = $mail_info['priority'];
                $spamcopy[$y]['uidl'] = ((!$this->is_valid_md5($mail_info['uidl'])) ?
                                    $this->_mail_get_uidl($spamcopy[$y]['msg'], $mail_info) :
                                    $mail_info['uidl']);
                $spamcopy[$y]['attach'] = (preg_match('#(multipart/mixed|multipart/related|application)#i',
                                     $mail_info['content-type'])) ? 1 : 0;

                if ($spamcopy[$y]['localname'] == "") {
                    $spamcopy[$y]['localname'] = $this->_get_local_name($spamcopy[$y]['uidl'], $boxname);
                }

                // $spamcopy[$y]['read'] = file_exists($spamcopy[$y]['localname'])?1:0;

                /*
                 * ops, a trick. if the message is not imap, the flags are stored in
                 * a special field on headers
                 */

                if ($this->mail_protocol != IMAP && file_exists($spamcopy[$y]['localname'])) {
                    $iheaders = $this->_get_headers_from_cache($spamcopy[$y]['localname']);
                    $iheaders = $this->_decode_header($iheaders);
                    $spamcopy[$y]['flags'] = strtoupper($iheaders['x-um-flags']);
                    unset($iheaders);
                }
                $spamcopy[$y]['folder'] = 'spam';

                $y++;
            }
        }
        $myreturnarray = array();
        /*
         * Special Hack: if we are listing the SPAM folder for any
         * reason, ensure that the 1st array *IS* the SPAM folder
         */
        if ($boxname == 'spam') {
            $myreturnarray[0] = $spamcopy;
            $myreturnarray[1] = $messagescopy;
        } else {
            $myreturnarray[0] = $messagescopy;
            $myreturnarray[1] = $spamcopy;
        }
        $myreturnarray[2] = 1;
        unset($messagescopy);
        unset($spamcopy);

        return $myreturnarray;
    }

    protected function _get_local_name($message, $boxname)
    {
        if (is_array($message)) {
            $flocalname = trim($this->userfolder."$boxname/".md5(trim($message['subject'].$message['date'].$message['message-id'])).'.eml');
        } else {
            $flocalname = trim($this->userfolder."$boxname/".$message.'.eml');
        }

        return $flocalname;
    }

    protected function _mail_list_boxes_imap($boxname = '*')
    {
        $boxlist = array();
        $this->_mail_send_command("LIST \"\" $boxname");
        $buffer = $this->_mail_get_line();
        /* if any problem, stop the script */
        if ($this->mail_nok_resp($buffer)) {
            return false;
        }
        /* loop throught the list and split the parts */
        while (!$this->mail_ok_resp($buffer)) {
            $tmp = array();
            preg_match('|\\((.*)\\)|', $buffer, $regs);
            $flags = $regs[1];
            $tmp['flags'] = $flags;

            preg_match('|\\((.*)\\)|', $buffer, $regs);
            $flags = $regs[1];

            $pos = strpos($buffer, ")");
            $rest = substr($buffer, $pos+2);
            $pos = strpos($rest, ' ');
            $tmp['prefix'] = preg_replace('|"(.*)"|', "$1", substr($rest, 0, $pos));
            $tmp['name'] = $this->fix_prefix(trim(preg_replace('|"(.*)"|', "$1", substr($rest, $pos+1))), 0);
            if (function_exists(mb_convert_encoding)) {
                $tmp['name'] = mb_convert_encoding($tmp['name'], 'ISO_8859-1', 'UTF7-IMAP');
            }
            $buffer = $this->_mail_get_line();
            $boxlist[] = $tmp;
        }

        return $boxlist;
    }

    public function _mail_list_boxes_pop($boxname = '*')
    {
        $boxlist = array();
        /* if POP3, only list the available folders */
        foreach ($this->mbox->folders as $foo) {
            $boxlist[] = $foo;
        }
        return $boxlist;
    }
    /**
     * List available emailboxes
     * @param  string $boxname If specific name or glob
     * @return array
     */
    public function mail_list_boxes($boxname = '*')
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
        if ($this->mail_protocol == IMAP) {
            $original_name = preg_replace('|"(.*)"|', "$1", $boxname);
            $boxname = $this->fix_prefix($original_name, 1);
            $this->_mail_send_command("SELECT \"$boxname\"");
            $buffer = $this->_mail_get_line();
            if (preg_match("/^".$this->get_sid()." NO/i", $buffer)) {
                if ($this->mail_subscribe_box($original_name)) {
                    $this->_mail_send_command("SELECT \"$boxname\"");
                    $buffer = $this->_mail_get_line();
                }
            }
            if ($this->mail_nok_resp($buffer)) {
                return false;
            }
            $boxinfo = array();
            /* get total, recent messages and flags */
            while (!$this->mail_ok_resp($buffer)) {
                if (preg_match('|[ ]?\\*[ ]?([0-9]+)[ ]EXISTS|i', $buffer, $regs)) {
                    $boxinfo['exists'] = $regs[1];
                }
                if (preg_match('|[ ]?\\*[ ]?([0-9])+[ ]RECENT|i', $buffer, $regs)) {
                    $boxinfo['recent'] = $regs[1];
                }
                if (preg_match('|[ ]?\\*[ ]?FLAGS[ ]?\\((.*)\\)|i', $buffer, $regs)) {
                    $boxinfo['flags'] = $regs[1];
                }
                $buffer = $this->_mail_get_line();
            }
        }
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
            $this->_mail_send_command("SUBSCRIBE \"$boxname\"");
            $buffer = $this->_mail_get_line();
            if ($this->mail_nok_resp($buffer)) {
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
            $this->_mail_send_command("CREATE \"$boxname\"");
            $buffer = $this->_mail_get_line();
            if ($this->mail_ok_resp($buffer)) {
                @mkdir($this->userfolder.$this->fix_prefix($boxname, 0), $this->dirperm);

                return true;
            } else {
                return false;
            }
        } else {
            /* if POP3, only make a new folder */
            if (@mkdir($this->userfolder.$boxname, $this->dirperm)) {
                return $this->mbox->add($boxname);
            } else {
                return false;
            }
        }
    }

    private function _mail_delete_box_imap($boxname)
    {
        $boxname = $this->fix_prefix(preg_replace('|"(.*)"|', "$1", $boxname), 1);
        $this->_mail_send_command("DELETE \"$boxname\"");
        $buffer = $this->_mail_get_line();

        if ($this->mail_ok_resp($buffer)) {
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

    private function _mail_save_message_imap($boxname, $message, $flags = "")
    {
        $boxname = $this->fix_prefix(preg_replace('|"(.*)"|', "$1", $boxname), 1);

        // send an append command
        $mailcommand = "APPEND \"$boxname\" ($flags) {".strlen($message)."}";
        $this->_mail_send_command($mailcommand);

        // wait for a "+ Something" here and not after the msg sent!!
        $buffer = $this->_mail_get_line();
        if ($buffer[0] != '+') {
            return false;    // problem appending
        }

        // send the msg
        $mailcommand = "$message";
        $this->_mail_send_command($mailcommand, true);    // not send the session id here!

        $buffer = $this->_mail_get_line();

        if (!preg_match("/^(".$this->get_sid()." OK)/i", $buffer)) {
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
    public function mail_save_message($boxname, $message, $flags = "")
    {
        if ($this->mail_protocol == IMAP) {
            if (!$this->_mail_save_message_imap($boxname, $message, $flags)) {
                return false;
            }
        }

        if (is_dir($this->userfolder.$boxname)) {
            $email = $this->fetch_structure($message);
            $mail_info = $this->get_mail_info($email['header']);
            $filename = $this->_get_local_name($mail_info, $boxname);
            if (!empty($flags)) {
                $message = trim($email['header'])."\r\nX-UM-Flags: $flags\r\n\r\n".$email['body'];
            }
            unset($email);
            $this->save_file($filename, $message);

            return true;
        }
    }

    private function _mail_set_flag_imap(&$msg, $flagname, $flagtype = '+')
    {
        if ($this->_current_folder != $msg['folder']) {
            $this->mail_select_box($msg['folder']);
        }

        if ($flagtype != '+') {
            $flagtype = '-';
        }
        $this->_mail_send_command('STORE '.$msg['msg'].':'.$msg['msg'].' '.$flagtype."FLAGS ($flagname)");
        $buffer = $this->_mail_get_line();

        while (!preg_match("/^(".$this->get_sid()." (OK|NO|BAD))/i", $buffer)) {
            $buffer = $this->_mail_get_line();
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
            if ($this->config['log_errors']) {
                $this->trigger_error("unknown flag: $this->userfolder", __FUNCTION__);
            }
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
            $headerinfo = $this->_decode_header($header);

            $strFlags = trim(strtoupper($msg['flags']));

            $flags = array();
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
                if (isset($pos)) {
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
            $this->sync_mbox = true;

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
                $this->_mail_send_command('LOGOUT');
                $tmp = $this->_mail_get_line();
            } else {
                $this->_mail_send_command('QUIT');
                $tmp = $this->_mail_get_line();
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
            $this->_mail_send_command('FORCEDQUIT');
            $this->_mail_get_line();
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
            $this->_mail_send_command('EXPUNGE');
            $buffer = $this->_mail_get_line();
            if ($this->mail_nok_resp($buffer)) {
                return false;
            }
            while (!$this->mail_ok_resp($buffer)) {
                $buffer = $this->_mail_get_line();
            }
        }
        return true;
    }

    /*
     * Use the optional POP3 CAPA command to determine
     * what extensions the pop server supports. Returns
     * a hash of supported options.
     * NOTE: Any whitespace within a capability string is
     * squeezed down to a single '_'.
     */
    protected function _mail_capa_pop3()
    {
        $capa = array();
        $this->_mail_send_command('CAPA');
        $buffer = $this->_mail_get_line();
        if ($this->mail_ok_resp($buffer)) {
            while (!feof($this->_mail_connection)) {
                $buffer = trim($this->_mail_get_line());
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
        $capa = array();
        $this->_mail_send_command('cp01 CAPABILITY', false);
        while (!feof($this->_mail_connection)) {
            $buffer = trim($this->_mail_get_line());
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
            $this->capabilities[$key] = $value;
        }
    }

    /*
     * Get the UIDL for the specified message. If none
     * provided, then return an array of all UIDLs for
     * all non-deleted messages, indexed by message id.
     *
     * If the server does not provide for the UIDL command,
     * then we generate our own by reading the message
     * headers and using the Message-ID, Date and Subject
     * headers to craft one. If passed a message header
     * hash, we grab them from there, otherwise we need
     * to query the server. Note that the provided array
     * only makes sense for single UIDL lookups.
     */
    /**
     * Get UIDL of specific message or of all
     * @param  string $id      ID of message
     * @param  array  $message
     * @return array
     */
    protected function _mail_get_uidl($id = "", $message = array())
    {
        if (!empty($id)) {
            if ($this->capabilities['UIDL']) {
                $this->_mail_send_command("UIDL $id");
                $buffer = $this->_mail_get_line();
                list($resp, $num, $uidl) = preg_split("|\s+|", $buffer);
                if ($resp == '+OK') {
                    return md5($uidl);
                }
                // If we DON'T get the OK response, we drop through
            }
            if (count($message)) {// provided a header hash
                return md5(trim($message['subject'].$message['date'].$message['message-id']));
            } else {
                $this->_mail_send_command('TOP '.$id.' 0');
                $buffer = $this->_mail_get_line();

                /* if any problem with the server, stop the function */
                if ($this->mail_nok_resp($buffer)) {
                    return "";
                }
                unset($header);
                while (!feof($this->_mail_connection)) {
                    $buffer = $this->_mail_get_line();
                    if (chop($buffer) == '.') {
                        break;
                    }
                    $header .= $buffer;
                }
                $mail_info = $this->get_mail_info($header);

                return md5(trim($mail_info['subject'].$mail_info['date'].$mail_info['message-id']));
            }
        } else {
            $retarray = array();
            if ($this->capabilities['UIDL']) {
                $this->_mail_send_command('UIDL');

                $buffer = $this->_mail_get_line();
                if ($this->mail_ok_resp($buffer)) {
                    while (!feof($this->_mail_connection)) {
                        $buffer = $this->_mail_get_line();
                        if (trim($buffer) == '.') {
                            break;
                        }
                        list($num, $uidl) = explode(' ', $buffer);
                        if (!empty($uidl)) {
                            $retarray[intval($num)] = md5($uidl);
                        }
                    }
                }
            }
            // Drop through if we got a UIDL error (the array is still empty)
            if (!count($retarray)) {
                $this->_mail_send_command('LIST');
                $buffer = $this->_mail_get_line();

                if ($this->mail_ok_resp($buffer)) {
                    $messages = array();
                    while (!feof($this->_mail_connection)) {
                        $buffer = $this->_mail_get_line();
                        if (trim($buffer) == '.') {
                            break;
                        }
                        $msgs = explode(' ', $buffer);
                        if (is_numeric($msgs[0])) {// store message number
                            $messages[] = $msgs[0];
                        }
                    }
                    // now grab the header info
                    foreach ($messages as $id) {
                        $this->_mail_send_command('TOP '.$id.' 0');
                        $buffer = $this->_mail_get_line();

                        if ($this->mail_ok_resp($buffer)) {
                            unset($header);
                            while (!feof($this->_mail_connection)) {
                                $buffer = $this->_mail_get_line();
                                if (trim($buffer) == '.') {
                                    break;
                                }
                                $header .= $buffer;
                            }
                            $mail_info = $this->get_mail_info($header);
                            $retarray[intval($id)] = md5(trim($mail_info['subject'].$mail_info['date'].$mail_info['message-id']));
                        }
                    }
                }
            }

            return $retarray;
        }
    }

    /**
     * Cleanup a set of directorys
     * @param  string  $userfolder The user's local webmail directory
     * @param  boolean $logout     TRUE if we also log user out
     * @return void
     */
    public function cleanup_dirs($userfolder, $logout)
    {
        global $mbox;
        if (($this->config['force_unmark_read_overrule'] && $this->config['force_unmark_read_setting']) ||
                 ($this->prefs['unmark-read'] && !$this->config['force_unmark_read_overrule'])) {
            $cleanme = $userfolder.'inbox/';
            self::cleanup_dir($cleanme);
        }
        $cleanme = $userfolder.'_attachments/';
        self::cleanup_dir($cleanme);
        $cleanme = $userfolder.'spam/';
        self::cleanup_dir($cleanme);

        if ($logout) {
            if (is_array($mbox['headers']) && file_exists($userfolder)) {
                if (is_array($mbox['folders'])) {
                    $boxes = $mbox['folders'];
                    for ($n = 0;$n<count($boxes);$n++) {
                        $entry = $this->fix_prefix($boxes[$n]['name'], 1);
                        $file_list = array();

                        if (is_array($curfolder = $mbox['headers'][$entry])) {
                            for ($j = 0;$j<count($curfolder);$j++) {
                                $file_list[] = $curfolder[$j]['localname'];
                            }

                            $d = dir($userfolder."$entry/");

                            while ($curfile = $d->read()) {
                                if ($curfile != '.' && $curfile != '..') {
                                    $curfile = $userfolder."$entry/$curfile";
                                    if (!in_array($curfile, $file_list)) {
                                        unlink($curfile);
                                    }
                                }
                            }

                            $d->close();
                        }
                    }
                }

                if ($this->prefs['empty-trash']) {
                    if ($this->mail_protocol == IMAP) {
                        if (!$this->mail_connect()) $this->redirect_and_exit('index.php?err=1', true);
                        if (!$this->mail_auth()) $this->redirect_and_exit('index.php?err=0');
                    }
                    $trash = 'trash';
                    if (!is_array($mbox['headers'][$trash])) {
                        $retbox = $this->mail_list_msgs($trash);
                        $mbox['headers'][$trash] = $retbox[0];
                    }
                    $trash = $mbox['headers'][$trash];

                    if (count($trash) > 0) {
                        for ($j = 0;$j<count($trash);$j++) {
                            $this->mail_delete_msg($trash[$j], false);
                        }
                        $this->mail_expunge();
                    }
                    if ($this->mail_protocol == IMAP) {
                        $this->mail_disconnect();
                    }
                }

                if ($this->prefs['empty-spam']) {
                    if (!$this->mail_connect()) $this->redirect_and_exit('index.php?err=1', true);
                    if (!$this->mail_auth()) $this->redirect_and_exit('index.php?err=0');
                    $trash = 'spam';
                    if (!is_array($mbox['headers'][$trash])) {
                        $retbox = $this->mail_list_msgs($trash);
                        $mbox['headers'][$trash] = $retbox[0];
                    }
                    $trash = $mbox['headers'][$trash];

                    if (count($trash) > 0) {
                        for ($j = 0;$j<count($trash);$j++) {
                            $this->mail_delete_msg($trash[$j], false);
                        }
                        $this->mail_expunge();
                    }
                    $this->mail_disconnect();
                }
            }
        }
    }
}
