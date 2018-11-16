<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

use Telaen\Telaen\Telaen;

// load session management
require './inc/init.php';
require './inc/vendor/vCard.php';
/* @var $TLN Telaen */

// meta assigned to smarty
$smarty->assign('pageMetas', $pmetas);
$filename = $TLN->userdatafolder.'/'.$addressBook;
$myfile = $TLN->blob($TLN->readFile($filename, false), false);
if ($myfile != "") {
    $mab = unserialize(base64_decode($myfile));
} else {
    $mab = [];
}

/* One time: Check for old format addressbook, convert, delete */
$ofilename = $TLN->userdatafolder.'/addressbook.ucf';
if (file_exists($ofilename)) {
    $myfile = $TLN->blob($TLN->readFile($filename, false), false);
    if ($myfile != "") {
        $obook = unserialize(base64_decode($myfile));
        if (is_array($obook)) {
            $newbook = [];
            // Old format of addressbook. xfer to vCard format
            foreach ($obook as $a) {
                $v = new vCard();
                $v->fn($a['name']);
                $v->email($a['email'], 'internet', 'pref');
                $v->tel($a['phone'], 'pref', 'voice');
                $v->tel($a['cell'], 'cell', 'voice');
                $v->x_work($a['work']);
                $v->note($a['note']);
                $v->adr("", 'pref', 'home');
                $v->adr($a['pobox'], 'pobox');
                $v->adr($a['extended'], 'extendedaddress');
                $v->adr($a['street'], 'streetaddress');
                $v->adr($a['city'], 'locality');
                $v->adr($a['state'], 'region');
                $v->adr($a['pcode'], 'postalcode');
                $v->adr($a['country'], 'country');
                $v->rev(date("Ymd") . 'T' . date("His") . 'Z');
                $newbook[$a['name']] = strval($v);
                unset($v);
            }
            Telaen::add2me($mab, $newbook);
        }
    }
    $TLN->saveFile($filename, base64_encode(serialize($mab)));
    unlink($ofilename);
}
ksort($mab);

eval('$jssource = "' . $commonJS . '";');
$jssource .= "
<script type=\"text/javascript\">
//<![CDATA[
function refreshlist() { location = 'addressbook.php' }
//]]>
</script>
";

$smarty->assign('smJS', $jssource);
$smarty->assign('smGoBack', 'addressbook.php');

extract(Telaen::pullFromArray($_GET, ['opt', 'id'], 'str'));
extract(Telaen::pullFromArray($_POST, ['name', 'email', 'street', 'city', 'state', 'country', 'work', 'phone',
    'cell', 'note', 'fax', 'opt', 'id'], 'str'));

$id = urldecode($id);
switch ($opt) {
    // save an edited contact

    case 'save':
        try {
            $v = new vCard(false, $mab[$id]);
        }
        catch (Exception $e) {
            $smarty->assign('smOpt', -1);
            $templatename = 'address-results.tpl';
            break;
        }
        $v->fn($name);
        $v->email($email, 'internet', 'pref');
        $v->adr('adr', 'pref', 'home');
        $v->adr($pobox, 'pobox');
        $v->adr($extended, 'extendedaddress');
        $v->adr($street, 'streetaddress');
        $v->adr($city, 'locality');
        $v->adr($state, 'region');
        $v->adr($pcode, 'postalcode');
        $v->adr($country, 'country');
        $v->x_work($work);
        $v->tel($phone, 'pref', 'voice');
        $v->tel($cell, 'cell', 'voice');
        $v->note($note);
        $v->rev(date("Ymd") . 'T' . date("His") . 'Z');

        $mab[$id] = strval($v);
        $TLN->saveFile($filename, base64_encode(serialize($mab)));

        $smarty->assign('smOpt', 1);
        $templatename = 'address-results.tpl';

        break;

    // add a new contact
    case 'add':
        $v = new vCard();
        $v->fn($name);
        $v->email($email, 'internet', 'pref');
        $v->adr('adr', 'pref', 'home');
        $v->adr($pobox, 'pobox');
        $v->adr($extended, 'extendedaddress');
        $v->adr($street, 'streetaddress');
        $v->adr($city, 'locality');
        $v->adr($state, 'region');
        $v->adr($pcode, 'postalcode');
        $v->adr($country, 'country');
        $v->x_work($work);
        $v->tel($phone, 'pref', 'voice');
        $v->tel($cell, 'cell', 'voice');
        $v->note($note);
        $v->rev(date("Ymd") . 'T' . date("His") . 'Z');

        $mab[$name] = strval($v);
        $TLN->saveFile($filename, base64_encode(serialize($mab)));

        $smarty->assign('smOpt', 2);
        $templatename = 'address-results.tpl';

        break;

    //delete an existing contact
    case 'dele':
        unset($mab[$id]);
        $TLN->saveFile($filename, base64_encode(serialize($mab)));

        $smarty->assign('smOpt', 3);
        $templatename = 'address-results.tpl';

        break;

    // show the form to edit
    case 'edit':
        $templatename = 'address-form.tpl';
        try {
            $v = new vCard(false, $mab[$id]);
        }
        catch (Exception $e) {
            $smarty->assign('smOpt', -1);
            $templatename = 'address-results.tpl';
            break;
        }
        foreach ($v->tel as $p) {
            if (in_array('cell', $p['type'])) {
                $cell = $p['value'];
            }
            if (in_array('voice', $p['type'])) {
                $phone = $p['value'];
            }
        }
        $smarty->assign('smAddrName', $v->fn[0]);
        $smarty->assign('smAddrEmail', $v->email[0]['value']);
        $smarty->assign('smAddrPObox', $v->adr[0]['pobox']);
        $smarty->assign('smAddrExtended', $v->adr[0]['extendedaddress']);
        $smarty->assign('smAddrStreet', $v->adr[0]['streetaddress']);
        $smarty->assign('smAddrCity', $v->adr[0]['locality']);
        $smarty->assign('smAddrState', $v->adr[0]['region']);
        $smarty->assign('smAddrPCode', $v->adr[0]['postalcode']);
        $smarty->assign('smAddrCountry', $v->adr[0]['country']);
        $smarty->assign('smAddrWork', $v->x_work[0]);
        $smarty->assign('smAddrPhone', $phone);
        $smarty->assign('smAddrCell', $cell);
        $smarty->assign('smAddrNote', $v->note[0]);

        $smarty->assign('smOpt', 'save');
        $smarty->assign('smAddrID', $id);

        break;

    // display the details for an especified contact
    case 'display':
        $templatename = 'address-display.tpl';
        try {
            $v = new vCard(false, $mab[$id]);
        }
        catch (Exception $e) {
            $smarty->assign('smOpt', -1);
            $templatename = 'address-results.tpl';
            break;
        }
        foreach ($v->tel as $p) {
            if (in_array('cell', $p['type'])) {
                $cell = $p['value'];
            }
            if (in_array('voice', $p['type'])) {
                $phone = $p['value'];
            }
        }
        $smarty->assign('smAddrName', $v->fn[0]);
        $smarty->assign('smAddrEmail', $v->email[0]['value']);
        $smarty->assign('smAddrPObox', $v->adr[0]['pobox']);
        $smarty->assign('smAddrExtended', $v->adr[0]['extendedaddress']);
        $smarty->assign('smAddrStreet', $v->adr[0]['streetaddress']);
        $smarty->assign('smAddrCity', $v->adr[0]['locality']);
        $smarty->assign('smAddrState', $v->adr[0]['region']);
        $smarty->assign('smAddrPCode', $v->adr[0]['postalcode']);
        $smarty->assign('smAddrCountry', $v->adr[0]['country']);
        $smarty->assign('smAddrWork', $v->x_work[0]);
        $smarty->assign('smAddrPhone', $phone);
        $smarty->assign('smAddrCell', $cell);
        $smarty->assign('smAddrNote', $v->note[0]);

        $smarty->assign('smAddrID', $id);

        break;

    // show the form to a new contact
    case 'new':

        $templatename = 'address-form.tpl';

        $smarty->assign('smOpt', 'add');
        $smarty->assign('smAddrID', 'N');

        break;

    // export a contact

    case 'expo':
        require './inc/lib.export.php';
        export2ou($mab[$id]);
        break;

    // default is list

    default:

        $smarty->assign('smNew', 'addressbook.php?opt=new');

        $nummsg = count($mab);
        $reg_pp = $TLN->prefs['rpp'];
        $start_pos = ($pag-1)*$reg_pp;
        $end_pos = (($start_pos+$reg_pp) > $nummsg) ? $nummsg : $start_pos+$reg_pp;

        if (($start_pos >= $end_pos) && ($pag != 1)) {
            $TLN->redirectAndExit("addressbook.php?pag=".($pag-1)."");
        }

        if ($nummsg > 0) {
            if ($pag > 1) {
                $smarty->assign('smFirstLink', "addressbook.php?pag=1");
                $smarty->assign('smPreviousLink', "addressbook.php?pag=".($pag-1)."");
            }

            for ($i = 1;$i <= ceil($nummsg / $reg_pp);$i++) {
                if ($pag == $i) {
                    $navigation .= "[<b>$i</b>] ";
                } else {
                    $navigation .= "<a href=\"addressbook.php?pag=$i\" class=\"navigation\">$i</a> ";
                }
            }

            $totPages = ceil($nummsg / $reg_pp);
            if ($end_pos < $nummsg) {
                $smarty->assign('smNextLink', "addressbook.php?pag=".($pag+1)."");
                $smarty->assign('smLastLink', "addressbook.php?&pag=".$totPages."");
            }
            $navigation .= " ($pag/".$totPages.")";
        }

        $smarty->assign('smNavBar', $navigation);

        $addresslist = [];
        $i = 0;
        foreach ($mab as $k => $a) {
            $k = urlencode($k);
            try {
                $v = new vCard(false, $a);
            }
            catch (Exception $e) {
                continue;
            }

            $addresslist[$i]['viewlink'] = "addressbook.php?opt=display&id=$k";
            $addresslist[$i]['composelink'] = "newmsg.php?nameto=".urlencode($v->fn)."&mailto=".urlencode($v->email[0]['value'])."";
            $addresslist[$i]['editlink'] = "addressbook.php?opt=edit&id=$k";
            $addresslist[$i]['dellink'] = "addressbook.php?opt=dele&id=$k";

            $addresslist[$i]['name'] = $v->fn[0];
            $addresslist[$i]['email'] = $v->email[0]['value'];
            $i++;
        }
        $templatename = 'address-list.tpl';
        $smarty->assign('smAddressList', $addresslist);
}

$smarty->display("$themez/$templatename");
