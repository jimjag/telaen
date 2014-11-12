<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require("./inc/init.php");

if(!isset($folder) || !isset($ix)) die("Expected parameters");
$mail_info = $mbox["headers"][base64_encode(strtolower($folder))][$ix];

$smarty->assign("pageMetas", $nocache);

if(!file_exists($mail_info["localname"])) die("File not found");;
$email = $TLN->read_file($mail_info["localname"]);

$TLN->displayimages = $prefs["display-images"];
$TLN->sanitize = ($sanitize_html || !$allow_scripts);

$email = $TLN->Decode($email);
$body = $email["body"];

//cleanning bad tags to show
if(preg_match('|<[ ]*body.*background[ ]*=[ ]*["\']?([A-Za-z0-9._&?=:/{}%+-]+)["\']?.*>|i',$body,$regs))
	$backimg =	" background=\"".$regs[1]."\"";
$smarty->assign("umBackImg",$backimg);
if(preg_match('|<[ ]*body[A-Z0-9._&?=:/"\' -]*bgcolor=["\']?([A-Z0-9#]+)["\']?[A-Z0-9._&?=:/"\' -]*>|i',$body,$regs))
	$backcolor = " bgcolor=\"".$regs[1]."\"";
$smarty->assign("umBackColor",$backcolor);

$body = preg_replace('|<body|i',"<telaen_body_not_alowed",$body);
$body = preg_replace('/a:(link|visited|hover)/i',".".uniqid(""),$body);
$body = preg_replace('|(body)[ ]?\\{|i',".".uniqid(""),$body);

$smarty->assign("umMessageBody",$body);


$ARFrom = $email["from"];
$useremail = $auth["email"];
// from
$name = $ARFrom[0]["name"];
$thismail = $ARFrom[0]["mail"];
$ARFrom[0]["link"] = "newmsg.php?nameto=".urlencode($name)."&mailto=$thismail";
$ARRom[0]["title"] = "$name <$thismail>";

$smarty->assign("umFromList",$ARFrom);

// To
$ARTo = $email["to"];

for($i=0;$i<count($ARTo);$i++) {
	$name = $ARTo[$i]["name"];
	$thismail = $ARTo[$i]["mail"];
	$link = "newmsg.php?nameto=".urlencode($name)."&mailto=$thismail";
	$ARTo[$i]["link"] = $link;
	$ARTo[$i]["title"] = "$name <$thismail>";
	$smarty->assign("umTOList",$ARTo);
}

// CC
$ARCC = $email["cc"];
if(count($ARCC) > 0) {
	$smarty->assign("umHaveCC",1);
	for($i=0;$i<count($ARCC);$i++) {
		$name = $ARCC[$i]["name"];
		$thismail = $ARCC[$i]["mail"];
		$link = "newmsg.php?nameto=".urlencode($name)."&mailto=$thismail";
		$ARCC[$i]["link"] = $link;
		$ARCC[$i]["title"] = "$name <$thismail>";
	}
	$smarty->assign("umCCList",$ARCC);
}

$smarty->assign("umPageTitle",$email["subject"]);

$smarty->assign("umSubject",$email["subject"]);
$smarty->assign("umDate",$email["date"]);

$anexos = $email["attachments"];


$haveattachs = (count($anexos) > 0)?1:0;
$smarty->assign("umHaveAttachments",$haveattachs);

if(count($anexos) > 0) {
	for($i=0;$i<count($anexos);$i++) {
		$safefname = rawurlencode($anexos[$i]["name"]);
		$link1 = "download.php?folder=$folder&ix=$ix&mnum=$mnum&bound=".base64_encode($anexos[$i]["boundary"])."&part=".$anexos[$i]["part"]."";
		$link2 = "$link1&down=1";
		$anexos[$i]["normlink"] = "$link1&fname=$safefname";
		$anexos[$i]["downlink"] = "$link2&fname=$safefname";
		$anexos[$i]["size"] = ceil($anexos[$i]["size"]/1024);
		$anexos[$i]["type"] = trim($anexos[$i]["content-type"]);
	}
	$smarty->assign("umAttachList",$anexos);
}

unset($TLN);

$smarty->display("$selected_theme/print-message.htm");

?>
