<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require './inc/init.php';
/* @var $TLN Telaen */

$smarty->assign('pageMetas', $pmetas);

extract(Telaen::pullFromArray($_GET, array('rem'), 'str'));
extract(Telaen::pullFromArray($_FILES, array('userfile'), 'str'));

if (isset($rem) && $rem != "") {
    $attchs = $mbox['attachments'];
    @unlink($attchs[$rem]['localname']);
    unset($attchs[$rem]);
    $c = 0;
    $newlist = array();
    while (list($key, $value) =  each($attchs)) {
        $newlist[$c] = $value;
        $c++;
    }
    $mbox['attachments'] = $newlist;
    $UserMbox->Save($mbox);
    echo("
	<script language=javascript>\n
		if(window.opener) window.opener.doupload();\n
		setTimeout('self.close()',500);\n
	</script>\n
	");
} elseif (isset($userfile) && is_uploaded_file($userfile['tmp_name'])) {

    $safefilename = Telaen::fsSafeFile($userfile['name']);
    $type = 'application';
    $subtype = 'octet-stream';
    if (preg_match('|(.+)/(.+)|', $userfile['type'], $m)) {
        $type = $m[1];
        $subtype = $m[2];
    }

    $upload['name'] = $userfile['name'];
    $upload['size'] = $userfile['size'];
    $upload['localname'] = Telaen::uniqID('u_').$safefilename;
    $upload['type'] = $type;
    $upload['subtype'] = $subtype;
    $upload['flat'] = 1;
    $upload['uidl'] = 'tmp';
    $upload['folder'] = 'tmp';
    $filename = $TLN->userfolder.'_tmp/'.$upload['localname'];
    $this->debugMsg("Adding upload attachment: {$userfile['tmp_name']} -> {$filename}");
    move_uploaded_file($userfile['tmp_name'], $filename);
    $this->tdb->addAttachment($upload);
}
