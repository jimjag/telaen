<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require './inc/init.php';
/* @var $TLN Telaen */

if (!isset($ix) || !isset($folder)) {
    $TLN->redirectAndExit('index.php?err=3', true);
}

extract(Telaen::pullFromArray($_POST, array('ckaval'), 1));

$filename = $TLN->userdatafolder.'/addressbook.ucf';
$myfile = $TLN->readFile($filename);
$addressbook = array();

if ($myfile != "") {
    $addressbook = unserialize(base64_decode($myfile));
}

function valid_email($thismail)
{
    $valid_regex = '/^[-a-z0-9_{|}~!#$+]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$/iD';
    if (!preg_match($valid_regex, $thismail)) {
        return 0;
    }
    global $addressbook,$f_email;
    for ($i = 0;$i<count($addressbook);$i++) {
        if (trim($addressbook[$i]['email']) == trim($thismail)) {
            return 0;
        }
    }
    if (trim($f_email) == trim($thismail)) {
        return 0;
    }

    return 1;
}

$mail_info = $mbox['headers'][$folder][$ix];

$emails = array();
$from = $mail_info['from'];
$to = $mail_info['to'];
$cc = $mail_info['cc'];

for ($i = 0;$i<count($from);$i++) {
    $emails[] = $from[$i];
}
for ($i = 0;$i<count($to);$i++) {
    $emails[] = $to[$i];
}
for ($i = 0;$i<count($cc);$i++) {
    $emails[] = $cc[$i];
}

$aval = array();
for ($i = 0;$i<count($emails);$i++) {
    if (valid_email($emails[$i]['mail'])) {
        $aval[] = $emails[$i];
    }
}

$aval_count = count($aval);

if (isset($ckaval)) {
    for ($i = 0;$i<count($ckaval);$i++) {
        $idchecked = $ckaval[$i];
        $id = count($addressbook);
        $addressbook[$id]['name'] = $aval[$idchecked]['name'];
        $addressbook[$id]['email'] = $aval[$idchecked]['mail'];
    }

    $TLN->saveFile($filename, $addressbook);

    echo("
	<script language=javascript>
		self.close();
	</script>
	");
    exit;
} else {
    $smarty->assign('umFolder', $folder);
    $smarty->assign('umIx', $ix);
    $smarty->assign('umAvailableAddresses', $aval_count);

    if ($aval_count > 0) {
        for ($i = 0;$i<$aval_count;$i++) {
            $aval[$i]['index'] = $i;
        }
        $smarty->assign('umAddressList', $aval);
    }
    $smarty->display("$themez/catch-address.tpl");
}
