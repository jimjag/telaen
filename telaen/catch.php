<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require './inc/init.php';
/* @var $TLN Telaen */

if (!isset($uidl) || !isset($folder)) {
    $TLN->redirectAndExit('index.php?err=3', true);
}

extract(Telaen::pullFromArray($_POST, array('ckaval'), 1));

$filename = $TLN->userdatafolder.'/addressbook.ucf';
$myfile = $tln->blob($TLN->readFile($filename, false), false);
$addressbook = array();

if ($myfile != "") {
    $addressbook = unserialize(base64_decode($myfile));
}

$msg = $TLN->tdb->getMessage($uidl, $folder);
$emails = [];
$from = $TLN->getNames($msg['headers']['from']);
$to = $TLN->getNames($msg['headers']['to']);
$cc = $TLN->getNames($msg['headers']['cc']);

$emails = array_merge($from, $to, $cc);

$aval = [];
for ($i = 0;$i<count($emails);$i++) {
    if (PHPMailer::validateAddress($emails[$i]['mail'])) {
        $aval[] = $emails[$i];
    }
}
$aval = array_unique($aval);
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
    $smarty->assign('smFolder', $folder);
    $smarty->assign('smIx', $uidl);
    $smarty->assign('smAvailableAddresses', $aval_count);

    if ($aval_count > 0) {
        for ($i = 0;$i<$aval_count;$i++) {
            $aval[$i]['index'] = $i;
        }
        $smarty->assign('smAddressList', $aval);
    }
    $smarty->display("$themez/catch-address.tpl");
}
