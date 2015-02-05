<?php
// namespace Telaen;
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

require_once './inc/class/class.PHPMailer_extra.php';
require_once './inc/class/class.LocalMbox.php';
require_once './inc/class/class.Mparser.php';

define('IMAP', 1);
define('POP3', 2);
define('STATUS_OK', 0);
define('STATUS_NOK', 1);
define('STATUS_NOK_FILE', 2);

/**
 * Telaen_core - Core Telaen functionality.
 * @package Telaen
 * @author Jim Jagielski (jimjag) <jimjag@gmail.com>
 */
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
    public $CRLF = "\r\n";
    public $dirperm = 0700;
    public $buffersz = 4194304; // 4M

    public $sanitize = true;
    public $use_html = false;
    public $charset = 'UTF-8';
    public $userfolder = './';
    public $userdatafolder = './_infos';
    public $temp_folder = './_tmp';
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
    private $_sid = 0;
    protected $_mail_connection = null;
    protected $_authenticated = false;
    protected $_uidvalidity = "";

    /*******************/

    /**
     * Create LocalMbox instance
     * @param  boolean $force_new Force creation of DB file
     * @return void
     */
    public function initTdb($force_new = false)
    {
        $this->tdb = new LocalMbox($this->userfolder, $force_new);
    }

    /**
     * Echo out string or stream
     * @param mixed $s What to print/echo
     */
    static public function myEcho($s) {
        if (is_resource($s)) {
            echo(stream_get_contents($s));
        } else {
            echo($s);
        }
    }

    /**
     *
     */
    static public function debugPrintStruct($obj)
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
    static public function safePrint($str)
    {
        return preg_replace_callback(
            '|([^[:print:]])|',
            function ($match) { return '\x'.dechex(ord($match[1])); },
            $str
        );
    }

    /**
     * Print out debugging info as HTML comments
     * @param  string $str
     * @return void
     */
    public function debugMsg($str, $caller = "", $line = 0)
    {
        if ($this->config['enable_debug']) {
            echo "<!-- $caller:\n";
            echo preg_replace('|-->|', '__>', self::safePrint($str));
            echo "\n-->\n";
            @flush();
        }
        if ($this->config['log_debug']) {
            \trigger_error(sprintf('%s[%d]: %s', $caller, $line, self::safePrint($str)));
        }
    }

    /**
     * Print out debugging info as HTML comments
     * @param  string $str
     * @return void
     */
    public function triggerError($str, $caller = "", $line = 0)
    {
        $this->debugMsg($str, $caller, $line);
        if ($this->config['log_errors']) {
            \trigger_error(sprintf('%s[%d]: %s', $caller, $line, self::safePrint($str)));
        }
    }

    /**
     * Strip all non-hex from a string
     * @param string $str
     * @return string
     */
    static public function stripNonHex($str)
    {
        return preg_replace('|[^A-Fa-f0-9]+|', '', $str);
    }

    /**
     * Return a file-system safe filename
     * @param string $str
     * @param boolean $delete
     * @return string
     */
    static public function fsSafeFile($str, $delete = false)
    {
        $ret = preg_replace('|[.]{2,}|', ".", $str); // no dir
        return preg_replace('|[^A-Za-z0-9_.-]+|', ($delete ? '' : '_'), $ret);
    }

    /**
     * Return a file-system safe folder name
     * @param string $str
     * @return string
     */
    static public function fsSafeFolder($str, $delete = true)
    {
        $ret = self::fsSafeFile($str);
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
     * Our mkdir wrapper
     * @param string $dir Directory to create
     * @param string $perm Permissions to use
     * @return void
     */
    protected function _mkdir($dir, $perm = null)
    {
        if ($perm === null) $perm = $this->dirperm;
        if (!is_dir($dir)) {
            if (!@mkdir($dir, $this->dirperm)) {
                $this->triggerError("mkdir error: $this->userfolder", __FUNCTION__, __LINE__);
            }
        }
    }

    /**
     * Open a file and read it until a double line break
     * is reached.
     * Used to get the list of cached messages from cache
     */
    protected function _getHeadersFromCache($strfile)
    {
        if ($strfile == "" || !file_exists($strfile)) {
            return '';
        }
        $fp = fopen($strfile, 'rb');
        if (!$fp) {
            $this->triggerError("cannot fopen $strfile", __FUNCTION__, __LINE__);
            $this->status = STATUS_NOK_FILE;
            return "";
        }
        $result = "";
        while (!self::_feof($fp)) {
            $buffer = preg_replace('/\r?\n/', "\r\n", fread($fp, 4096));
            $pos = strpos($buffer, "\r\n\r\n");
            if ($pos === false) {
                $result .= $buffer;
            } else {
                $result .= substr($buffer, 0, $pos);
                break;
            }
        }
        fclose($fp);
        unset($fp);
        unset($pos);
        unset($strfile);
        $this->status = STATUS_OK;
        return $result;
    }

    /**
     * Open a file and read the message body, as determined
     * by the content after 2 blank lines (\r\n\r\n).
     * @param string $strfile File to read from
     * @return resource
     */
    protected function _getBodyFromCache($strfile)
    {
        if ($strfile == "" || !file_exists($strfile)) {
            return '';
        }
        $fp = fopen($strfile, 'rb');
        if (!$fp) {
            $this->triggerError("cannot fopen $strfile", __FUNCTION__, __LINE__);
            $this->status = STATUS_NOK_FILE;
            return "";
        }
        $pts = $this->tstream();
        while (!self::_feof($fp)) {
            $buffer = preg_replace('/\r?\n/', "\r\n", fread($fp, 4096));
            $pos = strpos($buffer, "\r\n\r\n");
            if ($pos !== false) {
                fwrite($pts, substr($buffer, $pos+4));
                break;
            }
        }
        while (!self::_feof($fp)) {
            $buffer = preg_replace('/\r?\n/', "\r\n", fread($fp, 4096));
            fwrite($pts, $buffer);
        }
        $this->status = STATUS_OK;
        rewind($pts);
        return $pts;
    }

    protected function _createLocalFname($msg)
    {
        $fname = trim($msg['uidl']);
        if (empty($fname)) {
            $fname = self::uniqID();
        }
        if (!self::isMD5($fname)) {
            $fname = self::md5($fname);
        }
        return $fname.'.eml';
    }

    /**
     * Get the full pathname for the message
     * @param $msg
     * @param mixed $boxname Foldername to use (default is msg's folder)
     * @return array
     */
    public function getPathName($msg, $boxname = null)
    {
        if ($boxname === null) {
            $boxname = $msg['folder'];
        }
        if (!$msg['flat']) {
            $dirpath = trim($this->userfolder.$boxname.'/'.$msg['localname'][0]);
        } else {
            $dirpath = trim($this->userfolder.$boxname);
        }
        return [$dirpath.'/'.$msg['localname'], $dirpath];
    }

    /**
     * Open a file and read it fixing possible mistakes
     * on the line breaks. A single variable is returned
     * @param string $strfile File to read from
     * @return string
     */

    public function readFile($strfile)
    {
        if ($strfile == "" || !file_exists($strfile)) {
            return '';
        }
        $result = file_get_contents($strfile);
        $result = preg_replace('|\r?\n|', "\r\n", $result);
        $this->status = STATUS_OK;
        return $result;
    }

    /* stream_copy_to_stream() is slow and takes gobs of mem */
    protected function _sXfer($from, $to, $mem = 4194304)
    {
        rewind($from);
        while (!$this->_feof($from)) {
            fwrite($to, fread($from, $mem));
        }
    }

    /**
     * Save content to file
     * @param  string $filename The filename to write to
     * @param  mixed $content The content to write
     * @return boolean
     */
    public function saveFile($filename, $content)
    {
        $tmpfile = fopen($filename, 'wb+');
        if ($tmpfile) {
            if (is_resource($content)) {
                $this->_sXfer($content, $tmpfile);
            } else {
                fwrite($tmpfile, $content);
            }
            fclose($tmpfile);
            $this->status = STATUS_OK;
            return true;
        } else {
            $this->triggerError("cannot fopen $filename", __FUNCTION__, __LINE__);
            $this->status = STATUS_NOK_FILE;
            return false;
        }
    }

    /**
     * Save $msg content to file
     * @param  array $msg The message associated w/ the content
     * @param  mixed $content The content to write
     * @return boolean
     */
    public function saveMsg($msg, $content)
    {
        list($path, $dir) = $this->getPathName($msg);
        if (!$msg['flat']) {
            $this->_mkdir($dir);
        }
        return $this->saveFile($path, $content);
    }

    /**
     * Recursivelly remove files and directories
     */
    protected function _rmDirR($location)
    {
        if (substr($location, -1) != '/') {
            $location = $location.'/';
        }
        $all = opendir($location);
        while ($file = readdir($all)) {
            if (is_dir($location.$file) && $file != '..' && $file != '.') {
                $this->_rmDirR($location.$file);
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
    public function mimeEncodeHeaders($string)
    {
        if ($string == "") return '';
        if (!preg_match("/^([[:print:]]*)$/", $string))
            $string = "=?".$this->charset."?Q?".str_replace("+", "_", str_replace("%", "=", urlencode($string)))."?=";
        return $string;
    }

    /**
     * This function will convert any string between charsets.
     * @param string $string String to convert
     * @param string $from Charset to convert from
     * @param string $to Charset to convert to
     * @return string
     */
    static public function convertCharset($string, $from, $to)
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
     * parseBody headers strings. Inverse of mimeEncodeHeaders()
     */
    protected function _decodeMimeString($subject)
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
                $mystring = self::convertCharset($mystring, $charset, $this->charset);
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
    protected function _parseHeaders($header)
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
    public function getNames($strmail)
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
                $ARfrom[$i]['name'] = $this->_decodeMimeString($name);
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
     * @param $strMail
     * @return string
     */
    public function clearNames($strMail)
    {
        $result = '';
        $strMail = $this->getNames($strMail);
        for ($i = 0;$i<count($strMail);$i++) {
            $thismail = $strMail[$i];
            $thisline = ($thismail['mail'] != $thismail['name']) ? "\"".$thismail['name']."\""." <".$thismail['mail'].">" : $thismail['mail'];
            if ($thismail['mail'] != "" && strpos($result, $thismail['mail']) === false) {
                if ($result != "") {
                    $result .= ', '.$thisline;
                } else {
                    $result = $thisline;
                }
            }
        }
        return $result;
    }

    /**
     * Try to extract the first name in a specified field (from, to, cc)
     * In order to guess what is the format (the RFC support 3), it will
     * try different ways to get the name and email
     * @param string $strmail
     * @return array
     */
    public function getFirstOfNames($strmail)
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
            $ARfrom[0]['name'] = $this->_decodeMimeString($name);
            $ARfrom[0]['mail'] = $email;

            unset($name);
            unset($email);
        }
        unset($armail);
        unset($thisPart);

        return $ARfrom;
    }

    /**
     * Format a plain text string into a HTML formated string
     */
    protected function _returnTextBody($body)
    {
        $body = preg_replace('/(\r\n|\n|\r|\n\r)/', "<br>$1", $this->_makeLinkClickable(htmlspecialchars($body)));

        return "<font face=\"Courier New\" size=\"2\">$body</font>";
    }

    /**
     * parseBody Quoted-Printable strings
     */
    protected function _decodeQp($str)
    {
        return quoted_printable_decode(preg_replace('|=\r?\n|', "", $str));
    }

    /**
     * Convert URL and Emails into clickable links
     */
    protected function _makeLinkClickable($str)
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
     * Compile a string following the encoded method
     */
    protected function _convertBody($body, $enctype, $ctype)
    {
        $enctype = explode(' ', $enctype);
        $enctype = $enctype[0];
        if (strtolower($enctype) == 'base64') {
            $body = base64_decode($body);
        } elseif (strtolower($enctype) == 'quoted-printable') {
            $body = $this->_decodeQp($body);
        }

        if (preg_match('|koi8|', $ctype)) {
            $body = convert_cyr_string($body, 'k', 'w');
        } elseif (preg_match('|charset ?= ?"?([a-z0-9-]+)"?|i', $ctype, $regs)) {
            if ($regs[1] != $this->charset) {
                $body = self::convertCharset($body, $regs[1], $this->charset);
            }
        }

        return $body;
    }

    /**
     * True if string is a valid md5 hexadec
     * @param  string  $val
     * @return boolean
     */
    static public function isMD5($val)
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
     * Generate a unique ID string
     * @param string $prefix prefix to prepend
     * @return string
     */
    static public function uniqID($prefix = '') {
        return uniqid($prefix).(string)mt_rand();
    }

    /**
     * Get all needed info about an email message
     *  - create ['headers'] : hash of headers and values
     *  - create ['ouidl']
     *  - create ['uidl']
     *  - create ['flags']
     *  - create ['unread']
     * @param  string $header Header of email
     * @param  string $first  Names
     * @return array
     */
    public function parseHeaders($header)
    {
        $myarray = [];
        $headers = $this->_parseHeaders($header);

        /*
         * First, create some message fields
         */
        if (self::isMD5($headers['x-um-uidl'])) {
            $myarray['ouidl'] = $headers['x-um-uidl'];
        }
        if (self::isMD5($headers['x-tln-uidl'])) {
            $myarray['uidl'] = $headers['x-tln-uidl'];
        } elseif (!empty($myarray['ouidl'])) {
            $myarray['uidl'] = $myarray['ouidl'];
        }
        $myarray['flags'] = $headers['x-um-flags'];
        $myarray['unread'] = (!preg_match("|{$this->flags['seen']}|i", $headers['x-um-status']) ? 1 : 0);

        /*
         * Now, create canon Date
         */
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
        $headers['date'] = $this->buildMimeDate($mydate, $mytimezone);

        /*
         * Now, clean up some headers[] values
         */
        $headers['subject'] = $this->_decodeMimeString($headers['subject']);

        $receiptTo = $this->getFirstOfNames($headers['disposition-notification-to']);
        $headers['x-receipt-to'] = $receiptTo[0]['mail'];

        if (!empty($headers['message-id'])) {
            $headers['message-id'] = preg_replace('|<(.*)>|', "$1", trim($headers['message-id']));
        }
        if (!empty($headers['x-priority']) && empty($headers['priority'])) {
            $headers['priority'] = $headers['x-priority'][0];
        } elseif (empty($headers['priority'])) {
            $headers['priority'] = 3;
        }
        if (!empty($headers['content-transfer-encoding'])) {
            $headers['content-transfer-encoding'] = str_replace('GM', '-', $headers['content-transfer-encoding']);
        }

        /*
         * Date and Subject are top level, as well as in the headers[]
         */
        $myarray['date'] = $headers['date'];
        $myarray['subject'] = $headers['subject'];
        $myarray['message-id'] = $headers['message-id'];
        $myarray['headers'] = $headers;
        return $myarray;
    }

    /**
     * Convert a TIMESTAMP value into a RFC-compliant date
     * Vola's note: I think it does exactly the opposite...
     */
    public function buildMimeDate($mydate, $timezone = '+0000', $server_timezone_offset='-0000')
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
     * Parse the body content of the message
     * @param  array $msg Email message
     * @return boolean
     */
    public function parseBody($msg)
    {
        if (!$msg['bparsed']) {
            $parser = new Mparser();
            $parser->decode_bodies = 1;
            //$parser->decode_headers = 0;
            //$parser->extract_addresses = 0;
            $parser->ignore_syntax_errors = 1;
            $parser->track_lines = 0;
            $parser->use_part_file_names = 1;
            $parser->message_buffer_length = $this->buffersz;
            $p = [
                'File' => $path = $this->getPathName($msg)[0],
                'SkipBody' => 0,
                'SaveBody' => $this->userfolder.'_tmp',
            ];
            $decoded = [];
            if (!$parser->Decode($p, $decoded)) {
                $this->triggerError("Bad decoding of message[{$msg['folder']}:{$msg['uidl']}",
                    __FUNCTION__, __LINE__);
                return false;
            }
            $a = [];
            $parser->Analyze($decoded[0], $a);
            $path = $this->getPathName($msg)[0].'.msg';
            /*
             * Uggg. when we are treating w/ the actual email
             * message itself (txt or html) we need to do so
             * as a string. Hopefully, this is OK since the
             * actual message is small where it's the attachments
             * et.al. which are the sizable bits (we hope!)
             * TODO: Chunk this somehow
             */
            $data = file_get_contents($a['DataFile']);
            unlink($a['DataFile']);
            if (isset($a['Encoding']) && strcasecmp($a['Encoding'], $this->charset)) {
                $m = self::convertCharset($data, $a['Encoding'], $this->charset);
            }
            /*
             * Now scan thru CIDs ('Related')
             */
            $cids = [];
            $i = 0;
            foreach ($a['Related'] as $b) {
                $filename = trim(basename($b['FileName']));
                $safefilename = self::fsSafeFile($filename);
                $cids[$i]['name'] = $filename;
                $cids[$i]['size'] = intval($b['DataLength']);
                $cids[$i]['cid'] = $b['ContentID'];
                $cids[$i]['localname'] = self::uniqID().'_'.$safefilename;
                $cids[$i]['type'] = $b['Type'];
                $cids[$i]['subtype'] = $b['SubType'];
                $cids[$i]['disposition'] = $b['FileDisposition'];
                $cids[$i]['flat'] = $msg['flat'];
                $cids[$i]['uidl'] = $msg['uidl'];
                $cids[$i]['folder'] = $msg['folder'];
                list($path, $dir) = $this->getPathName($cids, '_attachments');
                $this->_mkdir($dir);
                rename($b['DataFile'], $path);
                $this->tdb->addAttachment($cids[$i]);
                $i++;
            }
            /*
             * Now scan thru Attachments ('Related')
             */
            $attachments = [];
            $i = 0;
            foreach ($a['Attachments'] as $b) {
                $filename = trim(basename($b['FileName']));
                $safefilename = self::fsSafeFile($filename);
                $attachments[$i]['name'] = $filename;
                $attachments[$i]['size'] = intval($b['DataLength']);
                $attachments[$i]['localname'] = self::uniqID().'_'.$safefilename;
                $attachments[$i]['type'] = $b['Type'];
                $attachments[$i]['subtype'] = $b['SubType'];
                $attachments[$i]['disposition'] = $b['FileDisposition'];
                $attachments[$i]['flat'] = $msg['flat'];
                $attachments[$i]['uidl'] = $msg['uidl'];
                $attachments[$i]['folder'] = $msg['folder'];
                list($path, $dir) = $this->getPathName($attachments, '_attachments');
                $this->_mkdir($dir);
                rename($b['DataFile'], $path);
                $this->tdb->addAttachment($attachments[$i]);
                $i++;
            }
            if ($a['Type'] == 'html') {
                if ($this->sanitize) {
                    $data = $this->sanitizeHTML($data);
                }
                foreach ($cids as $cid) {
                    $rep = '${1}=${2}download.php?folder='.urlencode($cid['folder']).'&uidl='.$cid['uidl'].'&name='.urlencode($cid['name'].'${3}');
                    $pat = '(...)\s*=\s*(.)cid:'.$cid['cid'].'(.)';
                    $data = preg_replace('|'.preg_quote($pat, '|').'|i', $rep, $data);
                }
            }
            $this->saveFile($path, $data);
            $msg['bparsed'] = true;
            $this->tdb->doMessage($msg);
            return true;
        }
    }

    /**
     * Split header and body into an array and return body as stream
     * @param mixed $email Email message
     * @param boolean $inisout If we are given a string, return a string
     * @return array
     */
    public function fetchStructure($email, $inisout = true)
    {
        $header = '';
        $body = $this->tstream();
        if (is_resource($email)) {
            rewind($email);
            while (!$this->_feof($email)) {
                $line = preg_replace('|\r?\n|',"\r\n", fread($email, 4096));
                $pos = strpos($line,"\r\n\r\n");
                if($pos === false) {
                    $header .= $line;
                } else {
                    $header .= substr($line, 0, $pos);
                    fwrite($body, substr($line, $pos + 4));
                    break;
                }
            }
            while (!$this->_feof($email)) {
                $line = preg_replace('|\r?\n|',"\r\n", fread($email, 4096));
                fwrite($body, $line);
            }
            rewind($body);
            return ['header' => $header, 'body' => $body];
        }
        $separator = "\n\r\n";
        $header = trim(substr($email, 0, strpos($email, $separator)));
        $bodypos = strlen($header) + strlen($separator);
        if ($inisout) {
            return ['header' => $header, 'body' => substr($email, $bodypos, strlen($email) - $bodypos)];
        }
        // else stream
        fwrite($body, substr($email, $bodypos, strlen($email) - $bodypos));
        rewind($body);
        return ['header' => $header, 'body' => $body];
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
     * @param string $str Message to convert
     * @return string
     */
    static public function html2Text($str)
    {
        require_once 'inc/vendor/Html2Text.php';
        $converter = new Html2Text\Html2Text($str);
        return $converter->getText();
    }

    /**
     * parseBody UUEncoded attachments
     */
    protected function _uuDecode($data)
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
     * Removes or Add prefix to INBOX folder names as required
     * @param  string  $folder Folder name
     * @param  boolean $add    Add prefix?
     * @return string
     */
    public function fixPrefix($folder, $add = false)
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
    static public function cleanupDir($folder)
    {
        if (file_exists($folder) && is_dir($folder)) {
            foreach (scandir($folder) as $entry) {
                if ($entry != '.' && $entry != '..' && $entry != "") {
                    if (is_file($folder.'/'.$entry))
                        unlink($folder.'/'.$entry);
                    elseif (is_dir($folder.'/'.$entry))
                        self::cleanupDir($folder.'/'.$entry);
                }
            }
        }
    }

    static public function getMicrotime()
    {
        $mtime = microtime();
        $mtime = explode(' ', $mtime);
        $mtime = (double) ($mtime[1]) + (double) ($mtime[0]);

        return ($mtime);
    }

    /**
     * Best guess on server name
     * @return string
     */
    static public function getServerName()
    {
        if (isset($_SERVER) && !empty($_SERVER['SERVER_NAME'])) {
            return $_SERVER['SERVER_NAME'];
        } elseif (function_exists('gethostname') && gethostname() != false) {
            return gethostname();
        } elseif (php_uname('n') != false) {
            return php_uname('n');
        } else {
            return 'localhost@localdomain';
        }
    }

    static public function simpleOutput($p1)
    {
        printf($p1);
    }

    static public function getUsageGraphic($used, $aval)
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
    static public function createHttpUrl()
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
    static public function createAbsUrl($url, $add_scheme_host = true)
    {
        $nurl = "";
        if ($add_scheme_host) {
            $nurl .= self::createHttpUrl();
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
    public function redirectAndExit($location, $killsession = false)
    {
        // on error the session should be killed, on badlogin no, i want my selected theme/lang
        if ($killsession) {
            $this->AuthSession->Kill();
        }

        if ($this->config['redirects_are_relative']) {
            $url = $location;
        } else {
            $url = self::createAbsUrl($location);
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
    static public function arrayQsort2ic(&$array, $column = 0, $order = 'ASC')
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
    static public function arrayQsort2(&$array, $column = 0, $order = 'ASC')
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
    static public function arrayQsort2int(&$array, $column = 0, $order = 'ASC')
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
    public function loadPrefs($user='unknown@example.com', $file = 'prefs.upf')
    {
        extract($this->config['default_preferences']);

        $pref_file = $this->userdatafolder.'/'.self::fsSafeFile($file);

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
    public function savePrefs($prefarray, $file = 'prefs.upf')
    {
        $pref_file = $this->userdatafolder.'/'.self::fsSafeFile($file);

        $f = fopen($pref_file, 'w');
        if (!$f) {
            $this->triggerError("cannot fopen $pref_file", __FUNCTION__, __LINE__);
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
    public function loadConfig($cfile='configv2', $merge=true)
    {
        $cfile = self::fsSafeFile($cfile);
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
    static public function getHeadersFromCache($strfile)
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
                $var = self::safePrint(trim((string) $var));
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
    static public function pullFromArray(&$whofrom, $my_vars = [], $cast = 'string')
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
    protected function _getSid($getnext = false)
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

    /**
     * Return the representation of $var (large chunk o' data)
     * as either a large string or a resource (temp stream handle)
     * @param mixed $var
     * @param bool $stream
     * @param mixed $mem
     * @return resource|string
     */
    public function blob($var, $stream = true, $mem = null)
    {
        if ($stream) {
            if (is_resource($var)) {
                rewind($var);
                return $var;
            }
            $pts = $this->tstream($mem);
            if (!is_null($var)) {
                fwrite($pts, $var);
                rewind($pts);
            }
            return $pts;
        } else {
            if (is_resource($var)) {
                rewind($var);
                return stream_get_contents($var);
            }
            return strval($var);
        }
    }

    /**
     * Create a PHP Temporary stream for large data blobs
     * @param mixed $mem Memory size to allocate (0 == all memory)
     * @return resource
     */
    public function tstream($mem = null)
    {
        if ($mem === null) {
            $mem = $this->buffersz;
        }
        if ($mem) {
            $f = fopen("php://temp/maxmemory:{$mem}", 'wb+');
        } else {
            $f = fopen("php://memory", 'wb+');
        }
        if ($f === null) {
            $this->triggerError("fopen failed", __FUNCTION__, __LINE__);
        }
        return $f;
    }

    /**
     * Parse a THREAD string (eg: '(2)(3 6 (4 23)(44 7 96))'
     * @param string $thread
     * @return array
     */
    static public function parseThread($thread)
    {
        $thread = preg_replace('|[^ ()[:alnum:]]|', '', $thread);
        $end = strlen($thread);
        $stack = [];
        $pstack = [];
        $depth = 0;
        $start = null;
        $out = [];
        $parent = null;
        for ($i = 0; $i < $end; $i++) {
            switch ($thread[$i]) {
                case '(':
                    $stack[] = $depth;
                    $start = null;
                    $pstack[] = $parent;
                    break;
                case ' ':
                    if ($start !== null) {
                        $parent = array_pop($pstack);
                        $uid = substr($thread, $start, $i - $start);
                        $out[] = [$uid, $depth, $parent];
                        $pstack[] = $parent = $uid;
                        $depth++;
                        $start = null;
                    }
                    break;
                case ')':
                    $parent = array_pop($pstack);
                    if ($start !== null) {
                        $out[] = [substr($thread, $start, $i - $start), $depth, $parent];
                    }
                    $parent = end($pstack);
                    $depth = array_pop($stack);
                    $start = null;
                    break;
                default:
                    if ($start === null) {
                        $start = $i;
                    }
                    break;
            }
        }
        return $out;
    }

}
