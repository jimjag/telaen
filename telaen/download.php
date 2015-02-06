<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

@ini_set('output_buffering',      1024);
@ob_start();

// load session management
require './inc/init.php';
/* @var $TLN Telaen */

if (!$auth['auth']) {
   $TLN->redirectAndExit('index.php?err=4', true);
}
if (!isset($uidl) || !isset($folder)) {
    $TLN->redirectAndExit('index.php?err=3', true);
}

// ensure we have email infos
$msg = $TLN->tdb->getMessage($uidl, $folder);
if (empty($msg)) {
    $TLN->redirectAndExit('messages.php?err=2&folder='.urlencode($folder)."&refr=true");
}

// check if we are downloading an attachment or the entire message
extract(Telaen::pullFromArray($_GET, array('name', 'down'), 'str'));

if (!isset($name)) {
    $sourceFile = $TLN->getPathName($msg)[0];
    $size = filesize($sourceFile);
    $disposition = 'attachment';
    $type = 'message/rfc822';
    $dlfname = trim($msg['subject']).'.eml';
} else {
    $attach = $TLN->tdb->getAttachments($msg);
    $cattachs = count($attach);
    $name = urldecode($name);
    $i = 0;
    for ($i = 0; $i < $cattachs; $i++) {
        if ($attach[$i]['name'] == $name) {
            break;
        }
    }
    if ($i >= $cattachs) {
        // Couldn't find it, or no attachments at all
        $TLN->redirectAndExit('messages.php?err=2&folder='.urlencode($folder)."&refr=true");
    }

    $sourceFile = $TLN->getPathName($attach[$i], '_attachments')[0];
    if (!file_exists($sourceFile)) {
        $TLN->triggerError("Couldn't find attachment for {$folder}:{$uidl} at: $sourcefile");
        $TLN->redirectAndExit('messages.php?err=2&folder='.urlencode($folder)."&refr=true");
    }

    $size = filesize($sourceFile);
    $disposition = (!$down) ? 'inline' : 'attachment';
    $type = $attach[$i]['type'].'/'.$attach[$i]['subtype'];
    $dlfname = $name;
}

header('Pragma: public');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Cache-Control: public');
header('Content-Description: File Transfer');
header("Content-Type: $type");
header("Content-Disposition: $disposition; filename=\"$dlfname\";");
header('Content-Transfer-Encoding: binary');
header("Content-Length: $size");

@ob_end_flush();

readfile($sourceFile);
