<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require './inc/init.php';

cleanup_dirs($TLN->userfolder, 1);

$AuthSession->Kill();
$TLN->redirect_and_exit('./index.php');
