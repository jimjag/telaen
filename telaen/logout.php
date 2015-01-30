<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require './inc/init.php';
/* @var $TLN Telaen */

$TLN->cleanupDirs($TLN->userfolder, 1);

$AuthSession->Kill();
$TLN->redirectAndExit('./index.php');
