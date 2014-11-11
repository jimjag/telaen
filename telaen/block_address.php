<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require("./inc/init.php");

if(!isset($ix) || !isset($folder)) redirect_and_exit("index.php?err=3", true);

$filename = $userfolder."_infos/filters.ucf";
$myfile = $UM->_read_file($filename);
$filters = array();

if($myfile != "") 
	$filters = unserialize(base64_decode($myfile));

function is_in_filter($email) {
	global $filters;
	foreach($filters as $filter) {
		if($filter["type"] == FL_TYPE_DELETE && $filter["match"] == $email)
			return true;
	}
	return false;
}

$mail_info = $auth["headers"][base64_encode(strtolower($folder))][$ix];

$emails = array();
$from = $mail_info["from"];
$to = $mail_info["to"];
$cc = $mail_info["cc"];


for($i=0;$i<count($from);$i++) {
	if(!is_in_filter($from[$i]["mail"])) {
		$from[$i]["index"] = $i;
		$emails[] = $from[$i];
	}
}
$aval = array();


if(isset($fFilter)) {
	for($i=0;$i<count($fFilter);$i++) {

		$filters[] = array(
					"type"		=> 2,
					"field"		=> 1,
					"match"		=>	$emails[$fFilter[$i]]["mail"],
					);
	}

	$UM->_save_file($filename,base64_encode(serialize($filters)));

	echo("
	<script language=javascript>
		self.close();
	</script>
	");
	exit;
} else {

	$smarty->assign("umFolder",$folder);
	$smarty->assign("umIx",$ix);
	$smarty->assign("umAvailableAddresses",count($emails));

	$smarty->assign("umAddressList",$emails);

	$smarty->display("$selected_theme/block-address.htm");
}
?>
