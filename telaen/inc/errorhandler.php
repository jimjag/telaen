<?php
if (!defined('I_AM_TELAEN')) {
    die('Direct access not premitted');
}

/*
 * Basic error handling
 */
trim($log_fname);
if (empty($log_fname)) {
    $log_fname = "telaen_error.log";
}

function safe_print($str)
{
    return preg_replace_callback(
        '|([^[:print:]])|',
        function ($match) { return '\x{'.dechex(ord($match[1])).'}'; },
        $str
    );
}

function errorHandler($errno, $errmsg, $filename, $linenum, $vars)
{
    global $log_fname, $temporary_directory;
    if ($log_fname[0] == '/') {
        $elog = $log_fname;
    } else {
        $elog = $temporary_directory.'/'.$log_fname;
    }

    $dt = date('Ymd H:i:s T');

    $etype = array(
        E_ERROR            => 'Error',
        E_WARNING        => 'Warning',
        E_PARSE            => 'Parsing Error',
        E_NOTICE        => 'Notice',
        E_CORE_ERROR        => 'Core Error',
        E_CORE_WARNING        => 'Core Warning',
        E_COMPILE_ERROR        => 'Compile Error',
        E_COMPILE_WARNING    => 'Compile Warning',
        E_USER_ERROR        => 'User Error',
        E_USER_WARNING        => 'User Warning',
        E_USER_NOTICE        => 'User Notice',
        E_STRICT        => 'Runtime Notice',
        E_RECOVERABLE_ERROR    => 'Catchable Fatal Error',
    );
    $err = "$dt: [$errno/{$etype[$errno]}] ($filename:$linenum): ".safe_print($errmsg)."\n";

    error_log($err, 3, $elog);
}

error_reporting(0);
$oeh = set_error_handler('errorHandler');
