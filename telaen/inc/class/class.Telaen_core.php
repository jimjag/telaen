<?php
// namespace Telaen;
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

require_once './inc/class/class.PHPMailer_extra.php';
require_once './inc/class/class.LocalMbox.php';

define('IMAP', 1);
define('POP3', 2);
define('STATUS_OK', 0);
define('STATUS_NOK', 1);
define('STATUS_NOK_FILE', 2);

class Telaen_core
{
    public $mail_server = 'localhost';
    public $mail_port = 110;
    public $use_tls = false;
    public $upgrade_tls = false;
    public $mail_user = 'unknown';
    public $mail_pass = "";
    public $mail_email = 'unknown@localhost';
    public $mail_protocol = POP3;
    public $mail_prefix = "";

    public $sanitize = true;
    public $use_html = false;
    public $charset = 'UTF-8';
    public $userfolder = './';
    public $userdatafolder = './_infos';
    public $temp_folder = './';
    public $idle_timeout = 10;
    public $displayimages = false;
    public $save_temp_attachs = true;
    public $current_level = [];
    public $config = [];
    public $prefs = [];
    public $appversion = "2.0.0.dev";
    public $appname = 'Telaen Webmail';
    /* @var $tdb LocalMbox */
    public $tdb = null;
    public $AuthSession = "";
    public $status = STATUS_OK;
    public $flags = [
        'seen' =>' \\SEEN',
        'deleted' => '\\DELETED',
        'answered' => '\\ANSWERED',
        'draft' => '\\DRAFT',
        'flagged' => '\\FLAGGED',
        'recent' => '\\RECENT',
        'forwarded' => '\\FORWARDED'
    ];

    // internal
    protected $_msgbody = "";
    protected $_content = [];
    private $_sid = 0;
    protected $_tnef = "";
    protected $_mail_connection = null;
    protected $_authenticated = false;
    protected $_uidvalidity = "";

    /*******************/

    /**
     * Create LocalMbox instance
     * @param  boolean $force_new Force creation of DB file
     * @return void
     */
    public function init_tdb($force_new = false)
    {
        $this->tdb = new LocalMbox($this->userfolder, $force_new);
    }

    /**
     * Print out debugging info as HTML comments
     * @param  string $str
     * @return void
     */
    public function debug_msg($str, $caller = "")
    {
        if ($this->config['enable_debug']) {
            echo "<!-- $caller:\n";
            echo preg_replace('|-->|', '__>', self::safe_print($str));
            echo "\n-->\n";
            @flush();
        }
        if ($this->config['log_debug']) {
            \trigger_error($str);
        }
    }

    /**
     * Print out debugging info as HTML comments
     * @param  string $str
     * @return void
     */
    public function trigger_error($str, $caller = "")
    {
        $this->debug_msg($str, $caller);
        if ($this->config['log_errors']) {
            \trigger_error($str);
        }
    }

    /**
     * Strip all non-hex from a string
     * @param string $str
     * @return string
     */
    static public function strip_nonhex($str)
    {
        return preg_replace('|[^A-Fa-f0-9]+|', '', $str);
    }

    /**
     * Return a file-system safe filename
     * @param string $str
     * @return string
     */
    static public function fs_safe_file($str, $delete = false)
    {
        $ret = preg_replace('|[.]{2,}|', ".", $str); // no dir
        return preg_replace('|[^A-Za-z0-9_.-]+|', ($delete ? '' : '_'), $ret);
    }

    /**
     * Return a file-system safe folder name
     * @param string $str
     * @return string
     */
    static public function fs_safe_folder($str, $delete = true)
    {
        $ret = self::fs_safe_file($str);
        return preg_replace('|[^A-Za-z0-9_-]|', ($delete ? '' : '_'), $ret);
    }

    /**
     * Add elements of $n to $m. $m is updated inline (since a ref)
     * @param array ref $m Array to add to
     * @param array $n Array to grab from
     */
    static public function add2me(&$m, $n)
    {
        foreach ($n as $k=>$v) {
            if ($v === null) continue;
            $m[$k] = $v;
        }
    }

    /**
     * Open a file and read it until a double line break
     * is reached.
     * Used to get the list of cached messages from cache
     */
    protected function _get_headers_from_cache($strfile)
    {
        if (!file_exists($strfile)) {
            return;
        }
        $f = fopen($strfile, 'rb');
        $result = "";
        while (!self::_feof($f)) {
            $result .= preg_replace('/\r?\n/', "\r\n", fread($f, 4096));
            $pos = strpos($result, "\r\n\r\n");
            if (!($pos === false)) {
                $result = substr($result, 0, $pos);
                break;
            }
        }
        fclose($f);
        unset($f);
        unset($pos);
        unset($strfile);

        return $result;
    }

    /**
     * Open a file and read it fixing possible mistakes
     * on the line breaks. A single variable is returned
     * @param string $strfile File to read from
     * @return string
     */

    public function read_file($strfile)
    {
        if ($strfile == "" || !file_exists($strfile)) {
            return '';
        }
        $fp = fopen($strfile, 'rb');
        if (!$fp) {
            $this->trigger_error("cannot fopen $strfile", __FUNCTION__);
            $this->status = STATUS_NOK_FILE;
            return "";
        }
        fseek($fp, 0, SEEK_END);
        $size = ftell($fp);
        rewind($fp);
        $result = preg_replace('|\r?\n|', "\r\n", fread($fp, $size));
        fclose($fp);
        unset($fp);
        unset($size);

        $this->status = STATUS_OK;
        return $result;
    }

    /**
     * Save content to file
     * @param  string $filename The filename to write to
     * @param  string $content The content to write
     * @return boolean
     */
    public function save_file($filename, $content)
    {
        $tmpfile = fopen($filename, 'wb');
        if ($tmpfile) {
            fwrite($tmpfile, $content);
            fclose($tmpfile);
            unset($content, $tmpfile);
            $this->status = STATUS_OK;
            return true;
        } else {
            $this->trigger_error("cannot fopen $filename", __FUNCTION__);
            $this->status = STATUS_NOK_FILE;
            return false;
        }
    }

    /**
     * Recursivelly remove files and directories
     */
    protected function _RmdirR($location)
    {
        if (substr($location, -1) != '/') {
            $location = $location.'/';
        }
        $all = opendir($location);
        while ($file = readdir($all)) {
            if (is_dir($location.$file) && $file != '..' && $file != '.') {
                $this->_RmdirR($location.$file);
                unset($file);
            } elseif (!is_dir($location.$file)) {
                unlink($location.$file);
                unset($file);
            }
        }
        closedir($all);
        unset($all);
        rmdir($location);
    }

    /**
     * Encode header strings to be MIME compliant
     * @param string $string string to encode
     * @return string
     */
    public function mime_encode_headers($string)
    {
        if ($string == "") return '';
        if (!preg_match("/^([[:print:]]*)$/", $string))
            $string = "=?".$this->charset."?Q?".str_replace("+", "_", str_replace("%", "=", urlencode($string)))."?=";
        return $string;
    }

    /**
     * Add a body, to a container.
     * Some malformed messages have more than one body.
     * Used to display inline attachments (images) too.
     */
    protected function _add_body($strbody)
    {
        if ($this->_msgbody == "") {
            $this->_msgbody = $strbody;
        } else {
            $this->_msgbody .= "\r\n<br>\r\n<br>\r\n<hr>\r\n<br>\r\n$strbody";
        }
    }

    /**
     * This function will convert any string between charsets.
     * @param string $string String to convert
     * @param string $from Charset to convert from
     * @param string $to Charset to convert to
     * @return string
     */
    static public function convert_charset($string, $from, $to)
    {
        return mb_convert_encoding($string, $to, $from);
    }

    /**
     * Clean-up/sanitize HTML
     * @param string $html HTML to sanitize
     * @param boolean $use_htmLawed Use newer sanitize via htmLawed
     * @param string $rep_image Path to replacement image (htmlfilter)
     * @param boolean $block Block external images (htmlfilter)
     * @return string Sanitized HTML
     */
    static public function sanitizeHTML($html, $use_htmLawed = true, $rep_image = 'images/trans.gif', $block = true)
    {
        if ($use_htmLawed) {
            require_once './inc/htmLawed.php';
            $config = array(
                'safe' => 1,
                'comment' => 1,
                'cdata' => 1,
                'css_expression' => 1,
                'deny_attribute' => 'on*,style',
                'unique_ids' => 0,
                'elements' => '*-applet-form-input-textarea-iframe-script-style-embed-object',
                'keep_bad' => 0,
                'schemes' => 'classid:clsid; href: aim, feed, file, ftp, gopher, http, https, irc, mailto, news, nntp, sftp, ssh, telnet; style: nil; *:file, http, https', // clsid allowed in class
                'valid_xhtml' => 0,
                'direct_list_nest' => 1,
                'balance' => 1
            );
            return htmLawed($html, $config);
        } else {
            require_once './inc/htmlfilter.php';
            return HTMLFilter($html, $rep_image, $block);
        }
    }

    /**
     * Decode headers strings. Inverse of mime_encode_headers()
     */
    protected function _decode_mime_string($subject)
    {
        $string = $subject;
        $newresult = "";

        if (($pos = strpos($string, "=?")) === false) {
            return $string;
        }

        while (!($pos === false)) {
            $newresult .= substr($string, 0, $pos);
            $string = substr($string, $pos+2, strlen($string));
            $intpos = strpos($string, "?");
            $charset = substr($string, 0, $intpos);
            $enctype = strtolower(substr($string, $intpos+1, 1));
            $string = substr($string, $intpos+3, strlen($string));
            $endpos = strpos($string, "?=");
            $mystring = substr($string, 0, $endpos);
            $string = substr($string, $endpos+2, strlen($string));
            if ($enctype == 'q') {
                $mystring = quoted_printable_decode(preg_replace('|_|', ' ', $mystring));
            } elseif ($enctype == 'b') {
                $mystring = base64_decode($mystring);
            }

            if ($charset != $this->charset) {
                $mystring = self::convert_charset($mystring, $charset, $this->charset);
            }

            $newresult .= $mystring;
            $pos = strpos($string, "=?");
            unset($intpos);
            unset($endpos);
            unset($charset);
            unset($enctype);
            unset($mystring);
        }
        $result = $newresult.$string;
        unset($mystring);
        unset($newresult);
        unset($pos);

        if (preg_match('|koi8|', $subject)) {
            $result = convert_cyr_string($result, 'k', 'w');
        }
        unset($subject);

        return $result;
    }

    /**
     * Split headers into an array, where the key is the same found in the header.
     *
     * Subject: Hi
     *
     * 	will be converted in
     *
     * $decodedheaders['subject'] = 'Hi';
     *
     * Some headers are broken into multiples lines, prefixed with a TAB (\t)
     */
    protected function _decode_header($header)
    {
        $headers = explode("\r\n", $header);
        $decodedheaders = [];
        $lasthead = "";
        for ($i = 0;$i<count($headers);$i++) {
            // If current header starts with a TAB or is not very standard,
            // attach it at the prev header
            if (empty($headers[$i])) {
                continue;
            } elseif (($headers[$i][0] == "\t") || !preg_match('|^[A-Z0-9a-z_-]+:|', trim($headers[$i]))) {
                if (!empty($lasthead)) {
                    $decodedheaders[$lasthead] .= ' ' . trim($headers[$i]);
                }
            } else { // otherwise extract the header
                $thisheader = trim($headers[$i]);
                if (!empty($thisheader)) {
                    $dbpoint = strpos($thisheader, ':');
                    $headname = strtolower(substr($thisheader, 0, $dbpoint));
                    $headvalue = trim(substr($thisheader, $dbpoint+1));
                    if (!empty($decodedheaders[$headname])) {
                        $decodedheaders[$headname] .= "; $headvalue";
                    } else {
                        $decodedheaders[$headname] = $headvalue;
                    }
                    $lasthead = $headname;
                }
                unset($thisheader);
            }
        }
        unset($headers);

        return $decodedheaders;
    }

    /**
     * Try to extract all names in a specified field (from, to, cc)
     * In order to guess what is the format (the RFC support 3), it will
     * try different ways to get an array with name and email
     * @param string $strmail String to parse
     * @return array
     */
    public function get_names($strmail)
    {
        $ARfrom = [];
        $strmail = stripslashes(preg_replace('/(\t|\r|\n)/', "", $strmail));

        if (trim($strmail) == "") {
            return $ARfrom;
        }

        $armail = [];
        $counter = 0;
        $inthechar = 0;
        $chartosplit = ',;';
        $protectchar = "\"";
        $temp = "";
        $lt = '<';
        $gt = '>';
        $closed = 1;

        for ($i = 0;$i<strlen($strmail);$i++) {
            $thischar = $strmail[$i];
            if ($thischar == $lt && $closed) {
                $closed = 0;
            }
            if ($thischar == $gt && !$closed) {
                $closed = 1;
            }
            if ($thischar == $protectchar) {
                $inthechar = ($inthechar) ? 0 : 1;
            }
            if (!(strpos($chartosplit, $thischar) === false) && !$inthechar && $closed) {
                $armail[] = $temp;
                $temp = "";
            } else {
                $temp .= $thischar;
            }
        }

        if (trim($temp) != "") {
            $armail[] = trim($temp);
            unset($temp);
        }

        for ($i = 0;$i<count($armail);$i++) {
            $thisPart = trim(preg_replace('|^"(.*)"$|iD', "$1", trim($armail[$i])));
            if ($thisPart != "") {
                if (preg_match('|(.*)<(.*)>|i', $thisPart, $regs)) {
                    $email = trim($regs[2]);
                    $name = trim($regs[1]);
                } else {
                    if (preg_match('|([-a-z0-9_$+.]+@[-a-z0-9_.]+[-a-z0-9_]+)((.*))|i', $thisPart, $regs)) {
                        $email = $regs[1];
                        $name = $regs[2];
                    } else {
                        $email = $thisPart;
                    }
                }

                $email = preg_replace('|<(.*)\\>|', "$1", $email);
                $name = preg_replace('|"(.*)"|', "$1", trim($name));
                $name = preg_replace('|\((.*)\)|', "$1", $name);

                if ($name == "") {
                    $name = $email;
                }
                if ($email == "") {
                    $email = $name;
                }
                $ARfrom[$i]['name'] = $this->_decode_mime_string($name);
                $ARfrom[$i]['mail'] = $email;
                unset($name);
                unset($email);
            }
        }
        unset($armail);
        unset($thisPart);

        return $ARfrom;
    }

    /**
     * Try to extract the first name in a specified field (from, to, cc)
     * In order to guess what is the format (the RFC support 3), it will
     * try different ways to get the name and email
     */
    protected function _get_first_of_names($strmail)
    {
        $ARfrom = [];
        $strmail = stripslashes(preg_replace('/(\t|\r|\n)/', "", $strmail));

        if (trim($strmail) == "") {
            return $ARfrom;
        }
        $counter = 0;
        $inthechar = 0;
        $chartosplit = ',;';
        $protectchar = "\"";
        $temp = "";
        $lt = '<';
        $gt = '>';
        $closed = 1;

        if (preg_match("/[$chartosplit]/i", $strmail)) {
            for ($i = 0;$i<strlen($strmail);$i++) {
                $thischar = $strmail[$i];
                if ($thischar == $lt && $closed) {
                    $closed = 0;
                }
                if ($thischar == $gt && !$closed) {
                    $closed = 1;
                }
                if ($thischar == $protectchar) {
                    $inthechar = ($inthechar) ? 0 : 1;
                }
                if (!(strpos($chartosplit, $thischar) === false) && !$inthechar && $closed) {
                    $armail = $temp;
                    $temp = "";
                    $i = strlen($strmail);
                } else {
                    $temp .= $thischar;
                }
            }
        } else {
            $armail = $strmail;
        }

        $thisPart = trim(preg_replace('|^"(.*)"$|iD', "$1", trim($armail)));
        if ($thisPart != "") {
            if (preg_match('|(.*)<(.*)>|i', $thisPart, $regs)) {
                $email = trim($regs[2]);
                $name = trim($regs[1]);
            } else {
                if (preg_match('|([-a-z0-9_$+.]+@[-a-z0-9_.]+[-a-z0-9_]+)((.*))|i', $thisPart, $regs)) {
                    $email = $regs[1];
                    $name = $regs[2];
                } else {
                    $email = $thisPart;
                }
            }

            $email = preg_replace('|<(.*)\\>|', "$1", $email);
            $name = preg_replace('|"(.*)"|', "$1", trim($name));
            $name = preg_replace('|\((.*)\)|', "$1", $name);

            if ($name == "") {
                $name = $email;
            }
            if ($email == "") {
                $email = $name;
            }
            $ARfrom[0]['name'] = $this->_decode_mime_string($name);
            $ARfrom[0]['mail'] = $email;

            unset($name);
            unset($email);
        }
        unset($armail);
        unset($thisPart);

        return $ARfrom;
    }

    /**
     * Compile a body for multipart/alternative format.
     * Guess the format we want and add it to the bod container
     */
    protected function _build_add_alternative_body($ctype, $body)
    {
        // get the boundary
        $boundary = $this->_get_boundary($ctype);
        // split the parts
        $parts = $this->_split_parts($boundary, $body);

        // not needed.. $thispart = ($this->config['allow_html'])?$parts[1]:$parts[0];

        // multipart flag
        $multipartSub = false;

        // look at the better part we can display
        foreach ($parts as $index => $value) {
            $email = $this->fetch_structure($value);

            $parts[$index] = $email;
            $parts[$index]['headers'] = $headers = $this->_decode_header($email['header']);
            unset($email);
            $ctype = explode(';', $headers['content-type']);
            $ctype = strtolower($ctype[0]);
            $parts[$index]['type'] = $ctype;

            // in this case the alternative is not html or text but multipart/*
            if (preg_match('!^multipart/(mixed|signed|related|report)!i', $ctype)) {
                $part = $parts[$index];
                $multipartSub = true;
                break;
            // if html enabled use it
            } elseif ($this->config['allow_html'] && $ctype == 'text/html') {
                $part = $parts[$index];
                break;
            // else use the text part
            } elseif (!$this->config['allow_html'] && $ctype == 'text/plain') {
                $part = $parts[$index];
                break;
            }
        }

        // no recognizable content, use first part, usually text only
        if (empty($part)) {
            $part = $parts[0];
        }
        unset($parts);

        // if the subcontent is multipart go to multipart function
        if ($multipartSub) {
            unset($body);
            $this->_build_add_complex_body($part['headers']['content-type'], $part['body']);
        } else {
            $body = $this->_compile_body($part['body'], $part['headers']['content-transfer-encoding'], $part['headers']['content-type']);
            if (!$this->config['allow_html'] && $part['type'] != 'text/plain') {
                $body = $this->_html2text($body);
            }
            if (!$this->config['allow_html']) {
                $body = $this->_return_text_body($body);
            }
            $this->_add_body($body);
        }
    }

    /**
     *  Recursively compile the parts of multipart/* emails.
     * 'complex' means multipart/signed|mixed|related|report and other
     * types that can be added in the future
     */
    protected function _build_add_complex_body($ctype, $body)
    {
        global $ix, $folder;

        $Rtype = trim(substr($ctype, strpos($ctype, "type=")+5, strlen($ctype)));

        if (strpos($Rtype, ";") != 0) {
            $Rtype = substr($Rtype, 0, strpos($Rtype, ";"));
        }
        if (substr($Rtype, 0, 1) == "\"" && substr($Rtype, -1) == "\"") {
            $Rtype = substr($Rtype, 1, strlen($Rtype)-2);
        }

        $boundary = $this->_get_boundary($ctype);
        $part = $this->_split_parts($boundary, $body);

        // only for debug
        //echo "<br>Boundary: ".$boundary." parts count: ".count($part);

        for ($i = 0;$i<count($part);$i++) {
            $email = $this->fetch_structure($part[$i]);

            $header = $email['header'];
            $body = $email['body'];

            // free unused vars
            unset($email);

            $headers = $this->_decode_header($header);
            $ctype = $headers['content-type'];

            //echo "<br>Part: $i - ctype: $ctype";

            /*
             * Special case for mac with resource and data fork
             * Ignore apple data parts.
             */
            if (preg_match('|application/applefile|i', $ctype)) {
                continue;
            }

            $cid = $headers['content-id'];

            $Actype = explode(';', $headers['content-type']);
            $types = explode('/', $Actype[0]);
            $rctype = strtolower($Actype[0]);

            $is_download = (preg_match('|name=|', $headers['content-disposition'].$headers['content-type']) || $headers['content-id'] != "" || $rctype == 'message/rfc822');

            if ($rctype == 'multipart/alternative') {
                $this->_build_add_alternative_body($ctype, $body);
            } elseif ($rctype == 'multipart/appledouble') {
                /*
                 * Special case for mac with resource and data fork
                 */
                $this->_build_add_complex_body($ctype, $body);
            } elseif ($rctype == 'text/plain' && !$is_download) {
                $body = $this->_compile_body($body, $headers['content-transfer-encoding'], $headers['content-type']);
                $this->_add_body($this->_return_text_body($body));
            } elseif ($rctype == 'text/html' &&    !$is_download) {
                $body = $this->_compile_body($body, $headers['content-transfer-encoding'], $headers['content-type']);

                if (!$this->config['allow_html']) {
                    $body = $this->_return_text_body($this->_html2text($body));
                }
                $this->_add_body($body);
            } elseif ($rctype == 'application/ms-tnef') {
                $body = $this->_compile_body($body, $headers['content-transfer-encoding'], $headers['content-type']);
                $this->_extract_tnef($body, $boundary, $i);
            } elseif ($is_download) {
                $thisattach = $this->_build_attach($header, $body, $boundary, $i);
                $tree = array_merge((array) $this->current_level, [$thisattach['index']]);
                $thisfile = 'download.php?folder='.urlencode($folder).'&ix='.$ix.'&attach='.join(',', $tree);
                $filename = $thisattach['filename'];
                $cid = preg_replace('|<(.*)\\>|', "$1", $cid);

                if ($cid != "") {
                    $cid = "cid:$cid";
                    $this->_msgbody = preg_replace('/'.preg_quote($cid, '/').'/i', $thisfile, $this->_msgbody);
                } elseif ($this->displayimages) {
                    $ext = strtolower(substr($thisattach['name'], -4));
                    $allowed_ext = ['.gif','.jpg','.png','.bmp'];
                    if (in_array($ext, $allowed_ext)) {
                        $this->_add_body("<img src=\"$thisfile\" alt=\"\">");
                    }
                }
            } else {
                $this->_process_message($header, $body);
            }
        }
    }

    /**
     * Format a plain text string into a HTML formated string
     */
    protected function _return_text_body($body)
    {
        $body = preg_replace('/(\r\n|\n|\r|\n\r)/', "<br>$1", $this->_make_link_clickable(htmlspecialchars($body)));

        return "<font face=\"Courier New\" size=\"2\">$body</font>";
    }

    /**
     * Decode Quoted-Printable strings
     */
    protected function _decode_qp($str)
    {
        return quoted_printable_decode(preg_replace('|=\r?\n|', "", $str));
    }

    /**
     * Convert URL and Emails into clickable links
     */
    protected function _make_link_clickable($str)
    {
        $str = preg_replace("!(\s)((f|ht)tps?://[a-z0-9~#%@\&:=?+/\.,_-]+[a-z0-9~#%@\&=?+/_.;-]+)!i", "$1<a class=autolink href=\"$2\" target=\"_blank\">$2</a>", $str); //http
        $str = preg_replace("|(\s)(www\.[a-z0-9~#%@\&:=?+/\.,_-]+[a-z0-9~#%@\&=?+/_.;-]+)|i", "$1<a class=autolink href=\"http://$2\" target=\"_blank\">$2</a>", $str); // www.
        $str = preg_replace("|(\s)([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})|i", "$1<a class=autolink href=\"mailto:$2\">$2</a>", $str); // mail

        $str = preg_replace("!^((f|ht)tp://[a-z0-9~#%@\&:=?+/\.,_-]+[a-z0-9~#%@\&=?+/_.;-]+)!i", "<a href=\"$1\" target=\"_blank\">$1</a>", $str); //http
        $str = preg_replace("|^(www\.[a-z0-9~#%@\&:=?+/\.,_-]+[a-z0-9~#%@\&=?+/_.;-]+)|i", "<a class=autolink href=\"http://$1\" target=\"_blank\">$1</a>", $str); // www.
        $str = preg_replace("|^([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})|i", "<a class=autolink href=\"mailto:$1\">$1</a>", $str); // mail

        return $str;
    }

    /**
     * Guess the type of the part and call the appropriate
     * method
     */
    protected function _process_message($header, $body)
    {
        $mail_info = $this->get_mail_info($header);
        $ctype = $mail_info['content-type'];
        $ctenc = $mail_info['content-transfer-encoding'];

        if ($ctype == "") {
            $ctype = 'text/plain';
        }

        $type = $ctype;

        $ctype = explode(';', $ctype);
        $types = explode('/', $ctype[0]);

        $maintype = trim(strtolower($types[0]));
        $subtype = trim(strtolower($types[1]));

        switch ($maintype) {
        case 'text':
            $body = $this->_compile_body($body, $ctenc, $mail_info['content-type']);
            switch ($subtype) {
            case 'html':
                if (!$this->config['allow_html']) {
                    $body = $this->_return_text_body($this->_html2text($body));
                }
                $msgbody = $body;
                break;
            default:
                $this->_extract_uuencoded($body);
                $msgbody = $this->_return_text_body($body);
                break;
            }
            $this->_add_body($msgbody);
            break;
        case 'multipart':
            if (preg_match("/$subtype/", "signed,mixed,related,report,appledouble")) {
                $subtype = 'complex';
            }

            switch ($subtype) {
            case 'alternative':
                $this->_build_add_alternative_body($ctype[1], $body);
                break;
            case 'complex':
                $this->_build_add_complex_body($type, $body);
                break;
            default:
                $this->_build_attach($header, $body, "", 0);
            }
            break;
        default:
            $this->_build_attach($header, $body, "", 0);
        }
    }

    /**
     * Compile the attachment, saving it to cache and
     * add it to the $attachments array if needed
     */
    protected function _build_attach($header, $body, $boundary, $part)
    {
        $headers = $this->_decode_header($header);
        $cdisp = $headers['content-disposition'];
        $ctype = $headers['content-type'];

        // for debug
        //echo "<br>CDisp: ". $cdisp." - CType: ".$ctype;

        // try to extract filename from content-disposition
        preg_match('|filename ?= ?"(.+)"|i', $cdisp, $matches);
        $filename = trim($matches[1]);

        // if the first not work, same regex without duoblequote
        if (!$filename) {
            preg_match('|filename ?= ?(.+)|i', $cdisp, $matches);
            $filename = trim($matches[1]);
        }

        // try to extract from content-type
        if (!$filename) {
            preg_match('|name ?= ?"(.+)"|i', $ctype, $matches);
            $filename = trim($matches[1]);
        }

        $tenc = $headers['content-transfer-encoding'];

        // extract content-disposition	(ex 'attachment')
        preg_match('|[a-z0-9]+|i', $cdisp, $matches);
        $content_disposition = $matches[0];

        // extract content-type		(ex 'text/plain' or 'application/vnd.ms-excel' note the DOT)
        preg_match('|[a-z0-9/\.-]+|i', $ctype, $matches);
        $content_type = $matches[0];

        $tmp = explode('/', $content_type);
        $main_type = $tmp[0];
        $sub_type = $tmp[1];

        // This set determine if an attachement is embedded (like some images) so there no download link
        // Note: added check for use it only for images, some clients adds id where not necessary
        $is_embed = ($main_type == 'image' && $headers['content-id'] != "") ? 1 : 0;

        $body = $this->_compile_body($body, $tenc, $ctype);

        if ($filename == "" && $main_type == 'message') {
            $attachheader = $this->fetch_structure($body);
            $attachheader = $this->_decode_header($attachheader['header']);
            $filename = $attachheader['subject'].'.eml';
            unset($attachheader);
        } elseif ($filename == "") {
            $filename = uniqid("").'.tmp';
        }

        $filename = preg_replace('|[.]{2,}|', ".", preg_replace("'(/|\\\\)+'", "_", trim($this->_decode_mime_string($filename))));
        $safefilename = self::fs_safe_file($filename);
        $nIndex = count($this->_content['attachments']);
        $temp_array['name'] = trim($filename);
        $temp_array['size'] = strlen($body);
        $temp_array['temp'] = $is_embed;
        $temp_array['content-type'] = strtolower(trim($content_type));
        $temp_array['content-disposition'] = strtolower(trim($content_disposition));
        $temp_array['boundary'] = $boundary;
        $temp_array['part'] = $part;
        $temp_array['filename'] = $this->userfolder.'_attachments/'.self::md5($temp_array['boundary']).'_'.$safefilename;
        $temp_array['type'] = 'mime';
        $temp_array['index'] = $nIndex;

        $this->save_file($temp_array['filename'], $body);
        unset($body);
        $this->_content['attachments'][$nIndex] = $temp_array;

        return $temp_array;
    }

    /**
     * Compile a string following the encoded method
     */
    protected function _compile_body($body, $enctype, $ctype)
    {
        $enctype = explode(' ', $enctype);
        $enctype = $enctype[0];
        if (strtolower($enctype) == 'base64') {
            $body = base64_decode($body);
        } elseif (strtolower($enctype) == 'quoted-printable') {
            $body = $this->_decode_qp($body);
        }

        if (preg_match('|koi8|', $ctype)) {
            $body = convert_cyr_string($body, 'k', 'w');
        } elseif (preg_match('|charset ?= ?"?([a-z0-9-]+)"?|i', $ctype, $regs)) {
            if ($regs[1] != $this->charset) {
                $body = self::convert_charset($body, $regs[1], $this->charset);
            }
        }

        return $body;
    }

    /**
    TODO: Remove this function

    protected function download_attach($header,&$body,$bound="",$part=0,$down=1,$type,$tnef) {
        if ($type == 'uue') {
            $this->get_uuencoded($body,$bound,$down,'down');
        }else {
            if ($bound != "") {
                $parts = $this->split_parts($bound,$body);
                // split the especified part of mail, body and headers
                $email = $this->fetch_structure($parts[$part]);
                $header = $email['header'];
                $body = $email['body'];
                unset($email);
            }
            if($type == 'tnef' && is_numeric($tnef))
                $this->get_tnef($header,$body,$tnef,$down,'down');
            else
                $this->build_attach($header,$body,"",0,$mode='down',$down);
        }
    }

    */

    /**
     * Guess the attachment format and call the specific method
     */
    protected function _save_attach($header, &$body, $filename, $type = 'mime', $tnef = '-1', $bound)
    {
        switch ($type) {
        case 'uue':
            $this->get_uuencoded($body, $bound, 0, 'save', $filename);
            break;
        case 'tnef':
            $this->get_tnef($header, $body, $tnef, 0, $mode = 'save', $filename);
            break;
        default:
            $this->_build_attach($header, $body, "", 0, $mode = 'save', 0, $filename);
        }
    }

    /**
     * True if string is a valid md5 hexadec
     * @param  string  $val
     * @return boolean
     */
    static public function is_md5($val)
    {
        return preg_match('|^[A-Fa-f0-9]{32}$|', $val);
    }


    /**
     * Return valid MD5 hash
     * (NOTE: hash(md5...) is faster than md5()
     * @param  string  $val String to hash
     * @return string
     */
    static public function md5($val)
    {
        return hash('md5', $val);
    }

    /**
     * Get all needed info about an email message
     * @param  string $header Header of email
     * @param  string $first  Names
     * @return array
     */
    public function get_mail_info($header, $first = 'ALL')
    {
        $myarray = [];
        $headers = $this->_decode_header($header);

        if (!empty($headers['message-id'])) {
            $myarray['message-id'] = preg_replace('|<(.*)>|', "$1", trim($headers['message-id']));
        }
        if (!empty($headers['content-type'])) {
            $myarray['content-type'] = $headers['content-type'];
        }
        if (!empty($headers['x-priority'])) {
            $myarray['priority'] = $headers['x-priority'][0];
        }
        $myarray['flags'] = $headers['x-um-flags'];
        $myarray['unread'] = (!preg_match("|{$this->flags['seen']}|i", $headers['x-um-status']) ? 1 : 0);
        $myarray['content-transfer-encoding'] = (!empty($headers['content-transfer-encoding'])) ? str_replace('GM', '-', $headers['content-transfer-encoding']) : null;

        $received = preg_replace('|  |', ' ', $headers['received']);
        $user_date = preg_replace('|  |', ' ', $headers['date']);

        if (preg_match('/([0-9]{1,2}[ ]+[A-Z]{3}[ ]+[0-9]{4}[ ]+[0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2})[ ]?((\+|-)[0-9]{4})?/', $received, $regs)) {
            //eg. Tue, 4 Sep 2001 16:22:31 -0000
            $mydate = $regs[1];
            $mytimezone = $regs[2];
            if (empty($mytimezone)) {
                if (preg_match('/((\\+|-)[0-9]{4})/i', $user_date, $regs)) {
                    $mytimezone = $regs[1];
                } else {
                    $mytimezone = $this->prefs['timezone'];
                }
            }
        } elseif (preg_match('|(([A-Z]{3})[ ]+([0-9]{1,2})[ ]+([0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2})[ ]+([0-9]{4}))|i', $received, $regs)) {
            //eg. Tue Sep 4 16:26:17 2001 (Cubic Circle's style)
            $mydate = $regs[3].' '.$regs[2].' '.$regs[5].' '.$regs[4];
            if (preg_match('/((\\+|-)[0-9]{4})/i', $user_date, $regs)) {
                $mytimezone = $regs[1];
            } else {
                $mytimezone = $this->prefs['timezone'];
            }
        } elseif (preg_match('/([0-9]{1,2}[ ]+[A-Z]{3}[ ]+[0-9]{4}[ ]+[0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2})[ ]?((\+|-)[0-9]{4})?/i', $user_date, $regs)) {
            //eg. Tue, 4 Sep 2001 16:22:31 -0000 (from Date header)
            $mydate = $regs[1];
            $mytimezone = $regs[2];
            if (empty($mytimezone)) {
                if (preg_match('/((\\+|-)[0-9]{4})/i', $user_date, $regs)) {
                    $mytimezone = $regs[1];
                } else {
                    $mytimezone = $this->prefs['timezone'];
                }
            }
        } else {
            $mydate = date('d M Y H:i');
            $mytimezone = $this->prefs['timezone'];
        }

        $myarray['date'] = $this->build_mime_date($mydate, $mytimezone);
        $myarray['subject'] = $this->_decode_mime_string($headers['subject']);
        if ($first == 'FIRST_ONLY') {
            $myarray['from'] = $this->_get_first_of_names($headers['from']);
            $myarray['to'] = $this->_get_first_of_names($headers['to']);
            $myarray['cc'] = $this->_get_first_of_names($headers['cc']);
            $myarray['reply-to'] = $this->_get_first_of_names($headers['reply-to']);
        } else {
            $myarray['from'] = $this->get_names($headers['from']);
            $myarray['to'] = $this->get_names($headers['to']);
            $myarray['cc'] = $this->get_names($headers['cc']);
            $myarray['reply-to'] = $this->get_names($headers['reply-to']);
        }
        $myarray['status'] = $headers['status'];
        $myarray['x-spam-level'] = $headers['x-spam-level'];

        $receiptTo = $this->_get_first_of_names($headers['disposition-notification-to']);
        $myarray['receipt-to'] = $receiptTo[0]['mail'];

        $ouidl = self::is_md5($headers['x-um-uidl']);
        if (!empty($ouidl)) {
            $myarray['ouidl'] = $ouidl;
        }
        $uidl = self::is_md5($headers['x-tln-uidl']);
        if (!empty($uidl)) {
            $myarray['uidl'] = $uidl;
        }

        $myarray['hparsed'] = true;
        unset($headers);

        return $myarray;
    }

    /**
     * Convert a TIMESTAMP value into a RFC-compliant date
     * Vola's note: I think it does exactly the opposite...
     */
    public function build_mime_date($mydate, $timezone = '+0000', $server_timezone_offset='-0000')
    {
        // check if $timezone is valid
        if (!preg_match('/((\\+|-)[0-9]{4})/', $timezone)) {
            $timezone = '+0000';
        }
        // check if $mydate is valid, if no return current server time
        if (!$intdate = @strtotime($mydate)) {
            return time();
        }
        if (preg_match('/(\\+|-)+([0-9]{2})([0-9]{2})/', $timezone, $regs)) {
            $datetimezone = ($regs[1].$regs[2]*3600)+($regs[1].$regs[3]*60);
        } else {
            $datetimezone = 0;
        }
        if (preg_match('/(\\+|-)+([0-9]{2})([0-9]{2})/', $this->prefs['timezone'], $regs)) {
            $usertimezone = ($regs[1].$regs[2]*3600)+($regs[1].$regs[3]*60);
        } else {
            $usertimezone = 0;
        }
        if (preg_match('/(\\+|-)+([0-9]{2})([0-9]{2})/', $server_timezone_offset, $regs)) {
            $servertimezone = ($regs[1].$regs[2]*3600)+($regs[1].$regs[3]*60);
        } else {
            $servertimezone = 0;
        }

        /** Umm... the out time must be:
            mailTime - mailTimeOffset = UTCmailtime (es: 10.00 AM +0200 = 8.00 AM UTC or 10.00 AM -0400 = 2.00 PM... 10-(-4) = 14)
            UTCmailtime + useroffset = UserMailTime (es: user zone +0200, mailUTC 8.00 AM = 10.00 AM or with -0400 = 6.00 AM)
        */

        // debug echos
/**		echo "Server offset time config:" .$server_timezone_offset ."<br>";
        echo "Date time offset:".$timezone ."<br>";
        echo "Date on function:".$mydate ."<br>";
        echo "Converted date + date offset + user offset  + server offset:".$intdate." ". $datetimezone ." ". $usertimezone ." ". $servertimezone ."<br>";
        echo "Returned time:".($intdate - $datetimezone + $usertimezone + $servertimezone) ."<br>"; */

        return ($intdate - $datetimezone + $usertimezone + $servertimezone);
    }

    /**
     * Main method called by script, start the decoding process
     * @param  string $email Email message
     * @return array
     */
    public function Decode(&$email)
    {
        $this->_content = [];
        $memail = $this->fetch_structure($email);
        $this->_msgbody = "";
        $body = $memail['body'];
        $header = $memail['header'];
        $mail_info = $this->get_mail_info($header);
        $this->_process_message($header, $body);
        self::add2me($this->_content, $mail_info);
        $this->_content['headers'] = $header;
        $this->_content['body'] = $this->_msgbody;

        return $this->_content;
    }

    /**
     * Split an email by its boundary
     */
    protected function _split_parts($boundary, $body)
    {
        $startpos = strpos($body, $boundary)+strlen($boundary)+2;
        $lenbody = strpos($body, "\r\n$boundary--") - $startpos;
        $body = substr($body, $startpos, $lenbody);

        return explode($boundary."\r\n", $body);
    }

    /**
     * Split header and body into an array
     * @param  string $email Email message
     * @return array
     */
    public function fetch_structure(&$email)
    {
        $ARemail = [];
        $separator = "\n\r\n";
        $header = trim(substr($email, 0, strpos($email, $separator)));
        $bodypos = strlen($header)+strlen($separator);
        $body = substr($email, $bodypos, strlen($email)-$bodypos);
        $ARemail['header'] = $header;
        $ARemail['body'] = $body;
        unset($header);
        unset($body);

        return $ARemail;
    }

    /**
     * Guess the boundary from header
     */
    protected function _get_boundary($ctype)
    {
        if (preg_match('|boundary[ ]?=[ ]?["]?([^";]*)["]?.*$|iD', $ctype, $regs)) {     //preg_match('/boundary[ ]?=[ ]?(["]?.*)/i',$ctype,$regs)) {
            //$boundary = preg_replace('/^\"(.*)\"$/', "$1", $regs[1])
            return trim("--$regs[1]");
        }
    }

    /**
     * Oposite of htmlentities.
     */
    protected function _unhtmlentities($string)
    {
        $trans_tbl = get_html_translation_table(HTML_ENTITIES);
        $trans_tbl = array_flip($trans_tbl);

        return strtr($string, $trans_tbl);
    }

    /**
     * Format a HTML message to be displayed as text if allow_html is off
     */
    protected function _html2text($str)
    {
        return $this->_unhtmlentities(preg_replace(
                array(    "'<(SCRIPT|STYLE)[^>]*?>.*?</(SCRIPT|STYLE)[^>]*?>'si",
                        "'(\r|\n)'",
                        "'<BR[^>]*?>'i",
                        "'<P[^>]*?>'i",
                        "'<\/?\w+[^>]*>'e",
                        ),
                array(    "",
                        "",
                        "\r\n",
                        "\r\n\r\n",
                        "", ),
                $str));
    }

    /**
     * Decode UUEncoded attachments
     */
    protected function _UUDecode($data)
    {
        $b64chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/A';
        $uudchars = '`!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_ ';
        $lines = preg_split('/\r?\n/', $data);
        $encode = "";
        foreach ($lines as $line) {
            if ($line != '') {
                $count = (ord($line[0])-32)%64;
                $count = ceil(($count*4)/3);
                $encode .= substr(ltrim($line), 1, $count);
            }
        }
        $encode = strtr($encode, $uudchars, $b64chars);
        while (strlen($encode) % 4) {
            $encode .= '=';
        }

        return base64_decode($encode);
    }

    /**
     * Guess all UUEncoded in the body
     */
    protected function _extract_uuencoded(&$body)
    {
        $regex = "/(begin ([0-7]{3}) (.+))\r?\n(.+)\r?\nend/Us";
        preg_match_all($regex, $body, $matches);
        for ($i = 0; $i < count($matches[3]); $i++) {
            $boundary = $matches[1][$i];
            $fileperm = $matches[2][$i];
            $filename = $matches[3][$i];
            $stream = $this->_UUDecode($matches[4][$i]);

            $temp_array['index'] = count($this->_content['attachments']);
            $temp_array['name'] = $filename;
            $temp_array['size'] = strlen($stream);
            $temp_array['content-type'] = 'application/unknown';
            $temp_array['content-disposition'] = 'attachment';
            $temp_array['boundary'] = $boundary;
            $temp_array['part'] = 0;
            $temp_array['type'] = 'uue';
            $temp_array['filename'] = $this->userfolder.'_attachments/'.self::md5($temp_array['boundary']).'_'.$temp_array['name'];
            $this->_content['attachments'][] = $temp_array;
            $this->save_file($temp_array['filename'], $stream);
            unset($temp_array);
        }
        $body = preg_replace($regex, "", $body);
    }

    /**
     * Extract all attachmentes contained in a MS-TNEF attachment
     */
    protected function _extract_tnef(&$body, $boundary, $part)
    {
        $tnefobj = $this->_tnef->Decode($body);

        for ($i = 0;$i<count($tnefobj);$i++) {
            $content = $tnefobj[$i]['stream'];
            $temp_array['index'] = count($this->_content['attachments']);
            $temp_array['name'] = $tnefobj[$i]['name'];
            $temp_array['size'] = $tnefobj[$i]['size'];
            $temp_array['content-type'] = $tnefobj[$i]['type0'].'/'.$tnefobj[$i]['type1'];
            $temp_array['content-disposition'] = 'attachment';
            $temp_array['boundary'] = $boundary;
            $temp_array['part'] = $part;
            $temp_array['type'] = 'tnef';
            $temp_array['tnef'] = $i;
            $temp_array['filename'] = $this->userfolder.'_attachments/'.self::md5($temp_array['boundary']).'_'.$temp_array['name'];

            $this->_content['attachments'][] = $temp_array;

            $this->save_file($temp_array['filename'], $content);
            unset($temp_array);
        }
    }

    /**
     * Removes or Add prefix to INBOX folder names as required
     * @param  string  $folder Folder name
     * @param  boolean $add    Add prefix?
     * @return string
     */
    public function fix_prefix($folder, $add = false)
    {
        if ($this->mail_protocol == IMAP
            && !preg_match('|^inbox$|i', $folder)
            && $this->mail_prefix
            && !preg_match('|^_|', $folder)) {
            if ($add) {
                if (!preg_match('/^'.preg_quote($this->mail_prefix).'/', $folder)) {
                    return $this->mail_prefix.$folder;
                } else {
                    return $folder;
                }
            } else {
                return preg_replace("/^".preg_quote($this->mail_prefix)."/", "", $folder);
            }
        } else {
            return $folder;
        }
    }

    /**
     * Remove all files within a directory
     * @param  string $folder Directory to clean up
     * @return void
     */
    static public function cleanup_dir($folder)
    {
        if (file_exists($folder) && is_dir($folder)) {
            foreach (scandir($folder) as $entry) {
                if ($entry != '.' && $entry != '..' && $entry != "") {
                    if (is_file($folder.'/'.$entry))
                        unlink($folder.'/'.$entry);
                    elseif (is_dir($folder.'/'.$entry))
                        self::cleanup_dir($folder.'/'.$entry);
                }
            }
        }
    }

    static public function get_microtime()
    {
        $mtime = microtime();
        $mtime = explode(' ', $mtime);
        $mtime = (double) ($mtime[1]) + (double) ($mtime[0]);

        return ($mtime);
    }

    static public function simpleoutput($p1)
    {
        printf($p1);
    }

    static public function get_usage_graphic($used, $aval)
    {
        if ($used >= $aval) {
            $redsize = 100;
            $graph = "<img src=\"images/red.gif\" height=\"10\" width=\"$redsize\" alt=\"\" />";
        } elseif ($used == 0) {
            $greesize = 100;
            $graph = "<img src=\"images/green.gif\" height=\"10\" width=\"$greesize\" alt=\"\" />";
        } else {
            $usedperc = $used*100/$aval;
            $redsize = ceil($usedperc);
            $greesize = ceil(100-$redsize);
            $red = "<img src=\"images/red.gif\" height=\"10\" width=\"$redsize\" alt=\"\" />";
            $green = "<img src=\"images/green.gif\" height=\"10\" width=\"$greesize\" alt=\"\" />";
            $graph = $red.$green;
        }

        return $graph;
    }

    /**
     * Create TLS/SSL aware URL for server (eg: http://www.example.com/)
     * @return string
     */
    static public function create_http_url()
    {
        $hurl = 'http';
        if ((strtolower($_SERVER['HTTPS']) == 'on') || ($_SERVER['SERVER_PORT'] == 443)) {
            $hurl .= 's://';
        } else {
            $hurl .= '://';
        }
        $hurl .= ($_SERVER['HTTP_HOST'] ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME']);

        return $hurl;
    }

    /**
     * Create absolute URL of PHP script
     * @param  string  $url             URL to add
     * @param  boolean $add_scheme_host Whether we need http: part
     * @return string
     */
    static public function create_abs_url($url, $add_scheme_host = true)
    {
        $nurl = "";
        if ($add_scheme_host) {
            $nurl .= self::create_http_url();
        }
        $nurl .= rtrim(dirname($_SERVER['PHP_SELF']), '/\\').'/'.$url;
        $nurl = str_replace('\\', '/', $nurl);    // Windows path fix
        return $nurl;
    }

    /**
     * Redirect user to location and die
     * @param string $location URL location
     * @param boolean $killsession Destroy session data
     * @return void
     */
    public function redirect_and_exit($location, $killsession = false)
    {
        // on error the session should be killed, on badlogin no, i want my selected theme/lang
        if ($killsession) {
            $this->AuthSession->Kill();
        }

        if ($this->config['redirects_are_relative']) {
            $url = $location;
        } else {
            $url = self::create_abs_url($location);
        }
        if ($this->config['enable_debug']) {
            echo("<hr><br><strong><font color=red>Debug enabled:</font></strong> <br><br><h3><a href=\"$url\">Click here</a> to go to <a href=\"$url\">$url</a></h3><br><br><br><br>");
        } elseif ($this->config['redirects_use_meta']) {
            echo <<<ENDOFREDIRECT
    <html>
     <head>
      <meta http-equiv="refresh" content="0;url=$url">
      <script language="JavaScript">
       <!--
        window.location = "$url"
       -->
      </script>
     </head>
     <body></body>
    </html>
ENDOFREDIRECT;
        } else {
            Header("Location: $url");
        }
 //       if (ob_get_level()) {
 //           ob_end_flush();
 //       }
        exit;
    }

    /**
     *
     */
    static public function array_qsort2ic(&$array, $column = 0, $order = 'ASC')
    {
        if (!is_array($array)) {
            return;
        }
        $oper = ($order == 'ASC') ? (1) : (-1);
        usort($array, create_function('$a,$b', "return strcasecmp(\$a['$column'],\$b['$column']) * $oper;"));
        reset($array);
    }

     /**
     *
     */
    static public function array_qsort2(&$array, $column = 0, $order = 'ASC')
    {
        if (!is_array($array)) {
            return;
        }
        $oper = ($order == 'ASC') ? (1) : (-1);
        usort($array, create_function('$a,$b', "return strnatcmp(\$a['$column'],\$b['$column']) * $oper;"));
        reset($array);
    }

    /**
     *
     */
    static public function array_qsort2int(&$array, $column = 0, $order = 'ASC')
    {
        // The column value must be an int value
        if (!is_array($array)) {
            return;
        }
        if ($order == 'ASC') {
            usort($array, create_function('$a,$b', "return ((\$a['$column']==\$b['$column']) ? 0 : ((\$a['$column']<\$b['$column'])?-1:1));"));
        } else {
            usort($array, create_function('$a,$b', "return ((\$a['$column']==\$b['$column']) ? 0 : ((\$a['$column']>\$b['$column'])?-1:1));"));
        }
        reset($array);
    }

    /**
     * Load user prefs
     * @param string $user User email
     * @param string $file Prefs filename
     * @return void
     */
    public function load_prefs($user='unknown@example.com', $file = 'prefs.upf')
    {
        extract($this->config['default_preferences']);

        $pref_file = $this->userdatafolder.'/'.self::fs_safe_file($file);

        if (!file_exists($pref_file)) {
            foreach ($this->config['default_preferences'] as $key => $val) {
                if (preg_match('|_default$|', $key)) {
                    $pref = substr($key, 0, -8);
                    $this->prefs[$pref] = $val;
                }
            }
            $this->prefs['real-name'] = UCFirst(substr($user, 0, strpos($user, '@')));
            $this->prefs['reply-to'] = $user;
            $this->prefs['version'] = '0.0.0'; // Just in case we want them to check on 1st login
        } else {
            $prefs = file_get_contents($pref_file);
            $this->prefs = unserialize(~$prefs);
        }
        foreach ($this->config['default_preferences'] as $key => $val) {
            if (preg_match('|^force_|', $key)) {
                if ($val !== null) {
                    $pref = substr($key, 6);
                    $this->prefs[$pref] = $val;
                }
            }
        }
    }

    /**
     * Save prefs
     * @param string $prefarray Hash of user prefs
     * @param string $file Prefs filename
     * @return void
     */
    public function save_prefs($prefarray, $file = 'prefs.upf')
    {
        $pref_file = $this->userdatafolder.'/'.self::fs_safe_file($file);

        $f = fopen($pref_file, 'w');
        if (!$f) {
            $this->trigger_error("cannot fopen $pref_file", __FUNCTION__);
            return;
        }
        fwrite($f, ~serialize($prefarray));
        fclose($f);
    }

    /**
     * Load in Telaen config
     * @param string $cfile File to read config from
     * @param boolean $merge Merge w/ existing stored config
     * @return array
     */
    public function load_config($cfile='configv2', $merge=true)
    {
        $cfile = self::fs_safe_file($cfile);
        $config = [];
        @include_once './inc/config/'.$cfile.'-default.php';
        @include_once './inc/config/'.$cfile.'.php';
        if ($merge) $this->config = array_merge($this->config, $config);
        return $config;
    }

    /**
     * Get Email headers from stored file
     * @param string $strfile File to read headers from
     * @return string
     */
    static public function get_headers_from_file($strfile)
    {
        if (!file_exists($strfile)) {
            return;
        }
        $result = "";
        $f = fopen($strfile, 'rb');
        while (!self::_feof($f)) {
            $result .= preg_replace('|\n|', "", fread($f, 100));
            $pos = strpos($result, '\r\r');
            if (!($pos === false)) {
                $result = substr($result, 0, $pos);
                break;
            }
        }
        fclose($f);
        unset($f);
        unset($pos);
        unset($strfile);

        return preg_replace('|\r|', '\r\n', trim($result));
    }

    /**
     *
     */
    static public function debug_print_struc($obj)
    {
        echo('<pre>');
        print_r($obj);
        echo('</pre>');
    }
    /**
     * Remove unsafe chars with hex equiv
     * @param string $str
     * @return string
     */
    static public function safe_print($str)
    {
        return preg_replace_callback(
            '|([^[:print:]])|',
            function ($match) { return '_x'.dechex(ord($match[1])); },
            $str
        );
    }


    /**
     * Force variable to a specific type
     * @param mixed $var Variable to cast
     * @param mixed $cast Type to cast $var to
     * @return mixed
     */
    static public function caster($var, $cast = 'string')
    {
        switch (gettype($cast)) {
            case 'boolean':
                $var = (boolean) $var; break;
            case 'integer':
                $var = (integer) $var; break;
            case 'double':
                $var = (double) $var; break;
            case 'string':
                $var = self::safe_print(trim((string) $var));
                break;
            case 'array':
                $var = (array) $var; break;
            case 'object':
                $var = (object) $var; break;
        }

        return $var;
    }

    /**
     * Pull various elements from array if they exist
     * @param array $whofrom Array to pull elements from
     * @param array $my_vars Elements to pull from $whofrom
     * @param mixed $cast Type to cast ELement to
     * @return array
     */
    static public function pull_from_array(&$whofrom, $my_vars = [], $cast = 'string')
    {
        $whoto = [];
        foreach ($my_vars as $to_pull) {
            if (isset($whofrom[$to_pull])) {
                $whoto[$to_pull] = self::caster($whofrom[$to_pull], $cast);
            }
        }
        return $whoto;
    }

    /**
     * Convert bytes to Kilo/Mega/Gigabytes
     * @param int $val Number of bytes
     * @return string Converted value
     */
    static public function bytes2bkmg($val)
    {
        $a = "";
        foreach (array('b', 'k', 'M', 'G') as $a) {
            if ($val > 1024) {
                $val /= 1024;
            } else {
                break;
            }
        }
        return round($val, 1).$a;
    }

    /**
     * Convert Kilo/Mega/Gigabytes to actual bytes
     * @param string $val Size
     * @return int Number of bytes
     */
    static public function bkmg2bytes($val)
    {
        switch (substr(trim($val), -1)) {
            case 'k':
            case 'K':
                $val = intval($val) * 1024;
                break;
            case 'm':
            case 'M':
                $val = intval($val) * 1024 * 1024;
                break;
            case 'G':
            case 'g':
                $val = intval($val) * 1024 * 1024 * 1024;
                break;
            case 'b':
            case 'B':
                break;
      }
      return intval($val);
    }

    /**
     * Return sid value for IMAP
     */
    protected function _get_sid($getnext = false)
    {
        if ($getnext) $this->_sid++;
        return sprintf('a%03d', $this->_sid);
    }

    static protected function _feof($handle)
     {
         if (!isset($handle) || !is_resource($handle)) {
             return true;
         }
         return feof($handle);
     }
}
