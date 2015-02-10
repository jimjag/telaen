<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

// load session management
require './inc/init.php';
/* @var $TLN Telaen */

// meta assigned to smarty
$smarty->assign('pageMetas', $pmetas);

$filename = $TLN->userdatafolder.'/addressbook.ucf';
$myfile = $TLN->blob($TLN->readFile($filename, false), false);

if ($myfile != "") {
    $addressbook = unserialize(base64_decode($myfile));
}
if (isset($addressbook[0]['name'])) {
    // Old format of addressbook. xfer to vCard format
    foreach ($addressbook as $a) {
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
    $addressbook = $newbook;
}
ksort($addressbook);

eval('$jssource = "' . $commonJS . '";');
$jssource .= "
<script type=\"text/javascript\">
//<![CDATA[
function refreshlist() { location = 'addressbook.php' }
//]]>
</script>
";

$smarty->assign('umJS', $jssource);
$smarty->assign('umGoBack', 'addressbook.php');

extract(Telaen::pullFromArray($_GET, array('opt', 'id'), 'str'));
extract(Telaen::pullFromArray($_POST, array('name', 'email', 'street', 'city', 'state', 'country', 'work', 'phone',
    'cell', 'note', 'fax', 'opt', 'id'), 'str'));

$id = urldecode($id);
switch ($opt) {
    // save an edited contact

    case 'save':
        $v = new vCard(false, $addressbook[$id]);
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

        $addressbook[$id] = strval($v);
        $TLN->saveFile($filename, base64_encode(serialize($addressbook)));

        $smarty->assign('umOpt', 1);
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

        $addressbook[$name] = strval($v);
        $TLN->saveFile($filename, base64_encode(serialize($addressbook)));

        $smarty->assign('umOpt', 2);
        $templatename = 'address-results.tpl';

        break;

    //delete an existing contact
    case 'dele':
        unset($addressbook[$id]);
        $TLN->saveFile($filename, base64_encode(serialize($addressbook)));

        $smarty->assign('umOpt', 3);
        $templatename = 'address-results.tpl';

        break;

    // show the form to edit
    case 'edit':
        $v = new vCard(false, $addressbook[$id]);
        foreach ($v->tel as $p) {
            if (in_array('cell', $p['type'])) {
                $cell = $p['value'];
            }
            if (in_array('voice', $p['type'])) {
                $phone = $p['value'];
            }
        }
        $smarty->assign('umAddrName', $v->fn[0]);
        $smarty->assign('umAddrEmail', $v->email[0]['value']);
        $smarty->assign('umAddrPObox', $v->adr[0]['pobox']);
        $smarty->assign('umAddrExtended', $v->adr[0]['extendedaddress']);
        $smarty->assign('umAddrStreet', $v->adr[0]['streetaddress']);
        $smarty->assign('umAddrCity', $v->adr[0]['locality']);
        $smarty->assign('umAddrState', $v->adr[0]['region']);
        $smarty->assign('umAddrPCode', $v->adr[0]['postalcode']);
        $smarty->assign('umAddrCountry', $v->adr[0]['country']);
        $smarty->assign('umAddrWork', $v->x_work[0]);
        $smarty->assign('umAddrPhone', $phone);
        $smarty->assign('umAddrCell', $cell);
        $smarty->assign('umAddrNote', $v->note[0]);

        $smarty->assign('umOpt', 'save');
        $smarty->assign('umAddrID', $id);
        $templatename = 'address-form.tpl';

        break;

    // display the details for an especified contact
    case 'display':
        $v = new vCard(false, $addressbook[$id]);
        foreach ($v->tel as $p) {
            if (in_array('cell', $p['type'])) {
                $cell = $p['value'];
            }
            if (in_array('voice', $p['type'])) {
                $phone = $p['value'];
            }
        }
        $smarty->assign('umAddrName', $v->fn[0]);
        $smarty->assign('umAddrEmail', $v->email[0]['value']);
        $smarty->assign('umAddrPObox', $v->adr[0]['pobox']);
        $smarty->assign('umAddrExtended', $v->adr[0]['extendedaddress']);
        $smarty->assign('umAddrStreet', $v->adr[0]['streetaddress']);
        $smarty->assign('umAddrCity', $v->adr[0]['locality']);
        $smarty->assign('umAddrState', $v->adr[0]['region']);
        $smarty->assign('umAddrPCode', $v->adr[0]['postalcode']);
        $smarty->assign('umAddrCountry', $v->adr[0]['country']);
        $smarty->assign('umAddrWork', $v->x_work[0]);
        $smarty->assign('umAddrPhone', $phone);
        $smarty->assign('umAddrCell', $cell);
        $smarty->assign('umAddrNote', $v->note[0]);

        $smarty->assign('umAddrID', $id);
        $templatename = 'address-display.tpl';

        break;

    // show the form to a new contact
    case 'new':

        $templatename = 'address-form.tpl';

        $smarty->assign('umOpt', 'add');
        $smarty->assign('umAddrID', 'N');

        break;

    // export a contact

    case 'expo':
        require './inc/lib.export.php';
        export2ou($addressbook[$id]);
        break;

    // default is list

    default:

        $smarty->assign('umNew', 'addressbook.php?opt=new');

        $nummsg = count($addressbook);
        $reg_pp = $TLN->prefs['rpp'];
        $start_pos = ($pag-1)*$reg_pp;
        $end_pos = (($start_pos+$reg_pp) > $nummsg) ? $nummsg : $start_pos+$reg_pp;

        if (($start_pos >= $end_pos) && ($pag != 1)) {
            $TLN->redirectAndExit("addressbook.php?pag=".($pag-1)."");
        }

        if ($nummsg > 0) {
            if ($pag > 1) {
                $smarty->assign('umFirstLink', "addressbook.php?pag=1");
                $smarty->assign('umPreviousLink', "addressbook.php?pag=".($pag-1)."");
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
                $smarty->assign('umNextLink', "addressbook.php?pag=".($pag+1)."");
                $smarty->assign('umLastLink', "addressbook.php?&pag=".$totPages."");
            }
            $navigation .= " ($pag/".$totPages.")";
        }

        $smarty->assign('umNavBar', $navigation);

        $addresslist = [];
        $i = 0;
        foreach ($addressbook as $k => $a) {
            $k = urlencode($k);
            $v = new vCard(false, $a);
            $addresslist[$i]['viewlink'] = "addressbook.php?opt=display&id=$k";
            $addresslist[$i]['composelink'] = "newmsg.php?nameto=".urlencode($v->fn)."&mailto=".urlencode($v->email[0]['value'])."";
            $addresslist[$i]['editlink'] = "addressbook.php?opt=edit&id=$k";
            $addresslist[$i]['dellink'] = "addressbook.php?opt=dele&id=$k";

            $addresslist[$i]['name'] = $v->fn;
            $addresslist[$i]['email'] = $v->email[0]['value'];
            $i++;
        }
        $templatename = 'address-list.tpl';
        $smarty->assign('umAddressList', $addresslist);
}

$smarty->display("$themez/$templatename");
