<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require("./inc/init.php");

$smarty->assign("pageMetas", $nocache);

extract(pull_from_array($_GET, array("rem"), "str"));
extract(pull_from_array($_FILES, array("userfile"), "str"));

if (isset($rem) && $rem != "") {

	$attchs = $auth["attachments"];
	@unlink($attchs[$rem]["localname"]);
	unset($attchs[$rem]);
	$c = 0;
	$newlist = array();
	while(list($key,$value) =  each($attchs)) {
		$newlist[$c] = $value; $c++;
	}
	$auth["attachments"] = $newlist;
	$SS->Save($sess);
	echo("
	<script language=javascript>\n
		if(window.opener) window.opener.doupload();\n
		setTimeout('self.close()',500);\n
	</script>\n
	");

} elseif (	isset($userfile) && 
		((!is_array($userfile) && is_uploaded_file($userfile)) || 
		is_uploaded_file($userfile["tmp_name"]))) {

	//if(file_exists($userfile["tmp_name"])) {


	$userfile_name	= $userfile["name"];
	$userfile_type	= $userfile["type"];
	$userfile_size	= $userfile["size"];
	$userfile	= $userfile["tmp_name"];


	if(!is_array($auth["attachments"])) $ind = 0;
	else $ind = count($auth["attachments"]);

	$filename = $userfolder."_attachments/".md5(uniqid("")).$userfile_name;

	move_uploaded_file($userfile, $filename);

	$auth["attachments"][$ind]["localname"] = $filename;
	$auth["attachments"][$ind]["name"] = $userfile_name;
	$auth["attachments"][$ind]["type"] = $userfile_type;
	$auth["attachments"][$ind]["size"] = $userfile_size;

	$SS->Save($sess);

	echo("
	<script language=javascript>\n
		if(window.opener) window.opener.doupload();\n
		setTimeout('self.close()',500);\n
	</script>\n
	");

} else {

	$smarty->display("$selected_theme/upload-attach.htm");

}
?>
