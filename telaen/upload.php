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

extract(Telaen::pullFromArray($_POST, array('rem'), 'str'));
$userfile = $_FILES['userfile'];

if (isset($rem) && $rem != "") {
    $rem = urldecode($rem);
    $attch = $TLN->tdb->getAttachments(['uidl' => 'tmp', 'folder' => 'tmp']);
    foreach ($attch as $a) {
        if ($a['name'] == $rem) {
            $TLN->tdb->delAttachment($rem, ['uidl' => 'tmp', 'folder' => 'tmp']);
            if (substr($a['localname'], 0, 3) == 'u__') {
                @unlink($TLN->userfolder . '_tmp/'.$a['localname']);
            }
            break;
        }
    }
} elseif (isset($userfile) && is_array($userfile) && $userfile['tmp_name'])) {

    $safefilename = Telaen::fsSafeFile($userfile['name']);
    $type = 'application';
    $subtype = 'octet-stream';
    if (preg_match('|(.+)/(.+)|', $userfile['type'], $m)) {
        $type = $m[1];
        $subtype = $m[2];
    }

    $upload['name'] = $userfile['name'];
    $upload['size'] = $userfile['size'];
    $upload['localname'] = Telaen::uniqID('u__').$safefilename;
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

$attch = $TLN->tdb->getAttachments(['uidl' => 'tmp', 'folder' => 'tmp']);
foreach ($attch as $a) {
    echo "
    <tr>
     <td width=\"50%\" class=\"default\">".urlencode($a['name'])."</td>
     <td width=\"10%\" class=\"right\">".Telaen::bytes2bkmg($a['size'])."</td>
     <td width=\"30%\" class=\"default\">".$a['type'].'/'.$a['subtype']."</td>
     <td width=\"10%\" class=\"default\"><a href=\"javascript:delatt(".urlencode($a['name']).")\">OK</a></td>
     </tr>
";
}