<?php
defined('I_AM_TELAEN') or die('Direct access not permitted');

/*
 * Basic error handling
 */
$log_fname = $TLN->config['log_fname'];
trim($log_fname);
if (empty($log_fname)) {
    $log_fname = "telaen_error.log";
}

function errorHandler($errno, $errmsg, $filename, $linenum, $vars)
{
    global $log_fname, $TLN;
    if ($log_fname[0] == '/') {
        $elog = $log_fname;
    } else {
        $elog = $TLN->config['temporary_directory'].'/'.$log_fname;
    }

    $dt = date('Ymd H:i:s T');

    $etype = array(
        E_ERROR => 'Error',
        E_WARNING => 'Warning',
        E_PARSE => 'Parsing Error',
        E_NOTICE => 'Notice',
        E_CORE_ERROR => 'Core Error',
        E_CORE_WARNING => 'Core Warning',
        E_COMPILE_ERROR => 'Compile Error',
        E_COMPILE_WARNING => 'Compile Warning',
        E_USER_ERROR => 'User Error',
        E_USER_WARNING => 'User Warning',
        E_USER_NOTICE => 'User Notice',
        E_STRICT => 'Runtime Notice',
        E_RECOVERABLE_ERROR => 'Catchable Fatal Error',
    );
    $errmsg = preg_replace_callback(
            '|([^[:print:]])|',
            function ($match) { return '\x{'.dechex(ord($match[1])).'}'; },
            $errmsg);
    $err = "$dt: [$errno/{$etype[$errno]}] ($filename:$linenum): $errmsg\n";

    error_log($err, 3, $elog);
}

error_reporting(0);
$oeh = set_error_handler('errorHandler');
