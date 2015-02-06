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
$TLN->arrayQsort2ic($addressbook, 'name');

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

extract(Telaen::pullFromArray($_GET, array('opt'), 'str'));
extract(Telaen::pullFromArray($_POST, array('name', 'email', 'street', 'city', 'state', 'work', 'phone',
    'cell', 'note', 'opt'), 'str'));
extract(Telaen::pullFromArray($_GET, array('id'), 1));
extract(Telaen::pullFromArray($_POST, array('id'), 1));

switch ($opt) {
    // save an edited contact

    case 'save':
        $addressbook[$id]['name'] = $name;
        $addressbook[$id]['email'] = $email;
        $addressbook[$id]['street'] = $street;
        $addressbook[$id]['city'] = $city;
        $addressbook[$id]['state'] = $state;
        $addressbook[$id]['work'] = $work;
        $addressbook[$id]['phone'] = $phone;
        $addressbook[$id]['cell'] = $cell;
        $addressbook[$id]['note'] = $note;

        $TLN->saveFile($filename, base64_encode(serialize($addressbook)));

        $smarty->assign('umOpt', 1);
        $templatename = 'address-results.tpl';

        break;

    // add a new contact
    case 'add':
        $id = count($addressbook);
        $addressbook[$id]['name'] = $name;
        $addressbook[$id]['email'] = $email;
        $addressbook[$id]['street'] = $street;
        $addressbook[$id]['city'] = $city;
        $addressbook[$id]['state'] = $state;
        $addressbook[$id]['work'] = $work;
        $addressbook[$id]['phone'] = $phone;
        $addressbook[$id]['cell'] = $cell;
        $addressbook[$id]['note'] = $note;

        $TLN->saveFile($filename, base64_encode(serialize($addressbook)));

        $smarty->assign('umOpt', 2);
        $templatename = 'address-results.tpl';

        break;

    //delete an existing contact
    case 'dele':
        unset($addressbook[$id]);
        $newaddr = array();
        while (list($l, $value) = each($addressbook)) {
            $newaddr[] = $value;
        }
        $addressbook = $newaddr;
        $TLN->saveFile($filename, base64_encode(serialize($addressbook)));

        $smarty->assign('umOpt', 3);
        $templatename = 'address-results.tpl';

        break;

    // show the form to edit
    case 'edit':

        $smarty->assign('umAddrName', $addressbook[$id]['name']);
        $smarty->assign('umAddrEmail', $addressbook[$id]['email']);
        $smarty->assign('umAddrStreet', $addressbook[$id]['street']);
        $smarty->assign('umAddrCity', $addressbook[$id]['city']);
        $smarty->assign('umAddrState', $addressbook[$id]['state']);
        $smarty->assign('umAddrWork', $addressbook[$id]['work']);
        $smarty->assign('umAddrPhone', $addressbook[$id]['phone']);
        $smarty->assign('umAddrCell', $addressbook[$id]['cell']);
        $smarty->assign('umAddrNote', $addressbook[$id]['note']);
        $smarty->assign('umOpt', 'save');
        $smarty->assign('umAddrID', $id);
        $templatename = 'address-form.tpl';

        break;

    // display the details for an especified contact
    case 'display':

        $smarty->assign('umAddrName', $addressbook[$id]['name']);
        $smarty->assign('umAddrEmail', $addressbook[$id]['email']);
        $smarty->assign('umAddrStreet', $addressbook[$id]['street']);
        $smarty->assign('umAddrCity', $addressbook[$id]['city']);
        $smarty->assign('umAddrState', $addressbook[$id]['state']);
        $smarty->assign('umAddrWork', $addressbook[$id]['work']);
        $smarty->assign('umAddrPhone', $addressbook[$id]['phone']);
        $smarty->assign('umAddrCell', $addressbook[$id]['cell']);
        $smarty->assign('umAddrNote', $addressbook[$id]['note']);

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

        $addresslist = array();
        $nummsg = count($addressbook);
        if (!isset($pag) || !is_numeric(trim($pag))) {
            $pag = 1;
        }

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


        for ($i = $start_pos; $i < $end_pos; $i++) {
            $ind = count($addresslist);
            $addresslist[$ind]['viewlink'] = "addressbook.php?opt=display&id=$i";
            $addresslist[$ind]['composelink'] = "newmsg.php?nameto=".htmlspecialchars($addressbook[$i]['name'])."&mailto=".htmlspecialchars($addressbook[$i]['email'])."";
            $addresslist[$ind]['editlink'] = "addressbook.php?opt=edit&id=$i";
            $addresslist[$ind]['dellink'] = "addressbook.php?opt=dele&id=$i";

            $addresslist[$ind]['name'] = $addressbook[$i]['name'];
            $addresslist[$ind]['email'] = $addressbook[$i]['email'];
        }
        $templatename = 'address-list.tpl';
        $smarty->assign('umAddressList', $addresslist);
}

$smarty->display("$themez/$templatename");
