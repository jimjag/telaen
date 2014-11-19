<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

/*
 * This module includes various useful and required
 * functions
 */

/**
 * Remove all files within a directory
 * @param  string $folder Directory to clean up
 * @return void
 */
function cleanup_dir($folder)
{
    if (file_exists($folder)) {
        $d = dir($folder.'/');
        while ($entry = $d->read()) {
            if ($entry != '.' && $entry != '..' && $entry != "") {
                unlink($folder."/$entry");
            }
        }
        $d->close();
    }
}

/**
 * Cleanup a set of directorys
 * @param  string  $userfolder The user's local webmail directory
 * @param  boolean $logout     TRUE if we also log user out
 * @return void
 */
function cleanup_dirs($userfolder, $logout)
{
    global $TLN, $prefs;

    if (($force_unmark_read_overrule && $force_unmark_read_setting) ||
             ($prefs['unmark-read'] && !$force_unmark_read_overrule)) {
        $cleanme = $userfolder.'inbox/';
        cleanup_dir($cleanme);
    }
    $cleanme = $userfolder.'_attachments/';
    cleanup_dir($cleanme);
    $cleanme = $userfolder.'spam/';
    cleanup_dir($cleanme);

    if ($logout) {
        if (is_array($mbox['headers']) && file_exists($userfolder)) {
            if (is_array($mbox['folders'])) {
                $boxes = $mbox['folders'];
                for ($n = 0;$n<count($boxes);$n++) {
                    $entry = $TLN->fix_prefix($boxes[$n]['name'], 1);
                    $file_list = array();

                    if (is_array($curfolder = $mbox['headers'][base64_encode(strtolower($entry))])) {
                        if ($TLN->is_system_folder($entry)) {
                            $entry = strtolower($entry);
                        }
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

            if ($prefs['empty-trash']) {
                if ($TLN->mail_protocol == IMAP) {
                    if (!$TLN->mail_connect()) {
                        redirect_and_exit('index.php?err=1', true);
                    }
                    if (!$TLN->mail_auth()) {
                        redirect_and_exit('index.php?err=0');
                    }
                }
                $trash = 'trash';
                if (!is_array($mbox['headers'][base64_encode($trash)])) {
                    $retbox = $TLN->mail_list_msgs($trash);
                    $mbox['headers'][base64_encode($trash)] = $retbox[0];
                }
                $trash = $mbox['headers'][base64_encode($trash)];

                if (count($trash) > 0) {
                    for ($j = 0;$j<count($trash);$j++) {
                        $TLN->mail_delete_msg($trash[$j], false);
                    }
                    $TLN->mail_expunge();
                }
                if ($TLN->mail_protocol == IMAP) {
                    $TLN->mail_disconnect();
                }
            }

            if ($prefs['empty-spam']) {
                if (!$TLN->mail_connect()) {
                    redirect_and_exit('index.php?err=1', true);
                }
                if (!$TLN->mail_auth()) {
                    redirect_and_exit('index.php?err=0');
                }
                $trash = 'spam';
                if (!is_array($mbox['headers'][base64_encode($trash)])) {
                    $retbox = $TLN->mail_list_msgs($trash);
                    $mbox['headers'][base64_encode($trash)] = $retbox[0];
                }
                $trash = $mbox['headers'][base64_encode($trash)];

                if (count($trash) > 0) {
                    for ($j = 0;$j<count($trash);$j++) {
                        $TLN->mail_delete_msg($trash[$j], false);
                    }
                    $TLN->mail_expunge();
                }
                $TLN->mail_disconnect();
            }
        }
    }
}

function get_microtime()
{
    $mtime = microtime();
    $mtime = explode(' ', $mtime);
    $mtime = (double) ($mtime[1]) + (double) ($mtime[0]);

    return ($mtime);
}

function simpleoutput($p1)
{
    printf($p1);
}

$func = strrev('tuptuoelpmis');

function get_usage_graphic($used, $aval)
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
function create_http_url()
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
function create_abs_url($url, $add_scheme_host = true)
{
    $nurl = "";
    if ($add_scheme_host) {
        $nurl .= create_http_url();
    }
    $nurl .= rtrim(dirname($_SERVER['PHP_SELF']), '/\\').'/'.$url;
    $nurl = str_replace('\\', '/', $nurl);    // Windows path fix
    return $nurl;
}

function redirect_and_exit($location, $killsession = false)
{
    global $enable_debug;
    global $redirects_use_meta;
    global $redirects_are_relative;
    global $AuthSession;

    // on error the session should be killed, on badlogin no, i want my selected theme/lang
    if ($killsession) {
        $AuthSession->Kill();
    }

    if ($redirects_are_relative) {
        $url = $location;
    } else {
        $url = create_abs_url($location);
    }
    if ($enable_debug) {
        echo("<hr><br><strong><font color=red>Debug enabled:</font></strong> <br><br><h3><a href=\"$url\">Click here</a> to go to <a href=\"$url\">$url</a></h3><br><br><br><br>");
    } elseif ($redirects_use_meta) {
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
    if (ob_get_level()) {
        ob_end_flush();
    }
    exit;
}

function array_qsort2ic(&$array, $column = 0, $order = 'ASC')
{
    if (!is_array($array)) {
        return;
    }
    $oper = ($order == 'ASC') ? (1) : (-1);
    usort($array, create_function('$a,$b', "return strcasecmp(\$a['$column'],\$b['$column']) * $oper;"));
    reset($array);
}

function array_qsort2(&$array, $column = 0, $order = 'ASC')
{
    if (!is_array($array)) {
        return;
    }
    $oper = ($order == 'ASC') ? (1) : (-1);
    usort($array, create_function('$a,$b', "return strnatcmp(\$a['$column'],\$b['$column']) * $oper;"));
    reset($array);
}

function array_qsort2int(&$array, $column = 0, $order = 'ASC')
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

/**
 * Simple PHP Helper for file-based Email data
 */
class Mbox
{
    private $path = "";

    public function Mbox()
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

// load settings
function load_prefs()
{
    global    $userfolder,
        $auth,
        $default_preferences,
        $appversion;

    extract($default_preferences);

    $pref_file = $userfolder.'_infos/prefs.upf';

    if (!file_exists($pref_file)) {
        $prefs['real-name'] = UCFirst(substr($auth['email'], 0, strpos($auth['email'], '@')));
        $prefs['reply-to'] = $auth['email'];
        $prefs['save-to-trash'] = $send_to_trash_default;
        $prefs['st-only-read'] = $st_only_ready_default;
        $prefs['empty-trash'] = $empty_trash_default;
        $prefs['empty-spam'] = $empty_spam_default;
        $prefs['unmark-read'] = $unmark_read_default;
        $prefs['save-to-sent'] = $save_to_sent_default;
        $prefs['sort-by'] = $sortby_default;
        $prefs['sort-order'] = $sortorder_default;
        $prefs['rpp'] = $rpp_default;
        $prefs['add-sig'] = $add_signature_default;
        $prefs['signature'] = $signature_default;
        $prefs['require-receipt'] = $require_receipt_default;
        $prefs['timezone'] = $timezone_default;
        $prefs['display-images'] = $display_images_default;
        $prefs['editor-mode'] = $editor_mode_default;
        $prefs['refresh-time'] = $refresh_time_default;
        $prefs['spamlevel'] = $spamlevel_default;
        $prefs['version'] = $appversion;
    } else {
        $prefs = file($pref_file);
        $prefs = join("", $prefs);
        $prefs = unserialize(~$prefs);
    }

    return $prefs;
}

//save preferences
function save_prefs($prefarray)
{
    global $userfolder;
    $pref_file = $userfolder.'_infos/prefs.upf';
    $f = fopen($pref_file, 'w');
    fwrite($f, ~serialize($prefarray));
    fclose($f);
}

//get only headers from a file
function get_headers_from_file($strfile)
{
    if (!file_exists($strfile)) {
        return;
    }
    $f = fopen($strfile, 'rb');
    while (!feof($f)) {
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

function debug_print_struc($obj)
{
    echo('<pre>');
    print_r($obj);
    echo('</pre>');
}

function valid_folder_name($name, $checksys = false)
{
    global $TLN;
    if ($name == "") {
        return false;
    }
    // Folder names that match system folder names are NOT valid
    if ($checksys && $TLN->is_system_folder($name)) {
        return false;
    }

    return !preg_match('/[^A-Za-z0-9\-]/', $name);
}

function caster($var, $cast = 'string')
{
    switch (gettype($cast)) {
        case 'boolean':
            $var = (boolean) $var; break;
        case 'integer':
            $var = (integer) $var; break;
        case 'double':
            $var = (double) $var; break;
        case 'string':
            $var = Telaen::safe_print(trim((string) $var));
            break;
        case 'array':
            $var = (array) $var; break;
        case 'object':
            $var = (object) $var; break;
    }

    return $var;
}

function pull_from_array(&$whofrom, $my_vars = array(), $cast = 'string')
{
    $reta = array();
    foreach ($my_vars as $to_pull) {
        if (isset($whofrom[$to_pull])) {
            $reta[$to_pull] = caster($whofrom[$to_pull], $cast);
        }
    }

    return $reta;
}
