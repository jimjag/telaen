<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

//defines
require("./inc/init.php");

if(!isset($ix) || !isset($pag)) redirect_and_exit("index.php?err=3", true);

$folderkey = base64_encode(strtolower($folder));

$mysess			= $mbox["headers"][$folderkey];
$mail_info		= $mysess[$ix];
$arAttachment	= array();

if(isset($attachment)) {

	$is_attached = true;
	$arAttachment	= explode(",",$attachment);

	$TLN->current_level = $arAttachment;

	$root = $mail_info;
	foreach($arAttachment as $item )
		if(is_numeric($item))
			$root = &$root["attachments"][$item];

	if( !is_array($root) || 
		!file_exists($root["filename"])) redirect_and_exit("index.php?err=3");

	$result = $TLN->_read_file($root["filename"]);

} else {
	$is_attached = false;
	$arAttachment = array();
	if(!$TLN->mail_connect()) {
		redirect_and_exit("index.php?err=1", true);
	}
	if(!$TLN->mail_auth()) { redirect_and_exit("index.php?err=0"); }

	if(!($result = $TLN->mail_retr_msg($mail_info,1))) { redirect_and_exit("messages.php?err=2&folder=".urlencode($folder)."&pag=$pag&refr=true"); }
	if($TLN->mail_set_flag($mail_info,"\\SEEN","+")) {
		$mbox["headers"][$folderkey][$ix] = $mail_info;
	}

	$TLN->mail_disconnect(); 

}

// metas assigned to smarty
$smarty->assign("pageMetas", $nocache);

$TLN->displayimages = $prefs["display-images"];
$TLN->sanitize = ($sanitize_html || !$allow_scripts);

$email = $TLN->Decode($result);

if($ix > 0) {

	$umHavePrevious		= 1;
	$umPreviousSubject	= $mysess[($ix-1)]["subject"];
	$umPreviousLink		= "readmsg.php?folder=".urlencode($folder)."&pag=$pag&ix=".($ix-1)."";

	$smarty->assign("umHavePrevious",$umHavePrevious);
	$smarty->assign("umPreviousSubject",$umPreviousSubject);
	$smarty->assign("umPreviousLink",$umPreviousLink);

}

if($ix < (count($mysess)-1)) {
	$umHaveNext		= 1;
	$umNextSubject	= $mysess[($ix+1)]["subject"];
	$umNextLink		= "readmsg.php?folder=".urlencode($folder)."&pag=$pag&ix=".($ix+1)."";
	$smarty->assign("umHaveNext",$umHaveNext);
	$smarty->assign("umNextSubject",$umNextSubject);
	$smarty->assign("umNextLink",$umNextLink);
}

// message download link
$smarty->assign("downloadLink", "download.php?folder=".urlencode($folder)."&ix=".$ix);

$body	=	$email["body"];

$redir_path = "redir.php";	// why not just relative?? Now is relative (due to problems on https servers)! 

$body = preg_replace('|target=["]?[a-zA-Z_]+["]?|i',"target=\"blank\"",$body);
$body = preg_replace('|href="http([s]?)://|i',"target=\"_blank\" href=\"$redir_path?http$1://",$body);
$body = preg_replace('|href="mailto:|i',"target=\"_top\" href=\"newmsg.php?to=",$body);

// looking for browser type	   --vola's note: add check for safari and opera??
$uagent =	$_SERVER["HTTP_USER_AGENT"];

$ns4	=	(preg_match('|Mozilla/4|',$uagent) && !preg_match('|MSIE|',$uagent) && !preg_match('|Gecko|',$uagent));
$ns6moz =	preg_match('|Gecko|',$uagent);
$ie4up	=	preg_match('/MSIE (4|5|6|7)/',$uagent);
$other	=	(!$ns4 && !$ns6moz && !$ie4up);

// with no recognized browser display inline on the page
if ($other) {
	$body	=	preg_replace('|<base|i',"<telaen_base_not_alowed",
				preg_replace('|<link|i',"<telaen_link_not_alowed",
				$body));

	if(preg_match('/<[ ]*body.*background[ ]*=[ ]*["\']?([A-Za-z0-9._&?=:/{}%+-]+)["\']?.*>/i',$body,$regs))
		$backimg =	" background=\"".$regs[1]."\"";
	$smarty->assign("umBackImg",$backimg);
	if(preg_match('|<[ ]*body[A-Z0-9._&?=:/"\' -]*bgcolor=["\']?([A-Z0-9#]+)["\']?[A-Z0-9._&?=:/"\' -]*>|i',$body,$regs))
		$backcolor = " bgcolor=\"".$regs[1]."\"";
	$smarty->assign("umBackColor",$backcolor);

	$body = preg_replace('|<body|i',"<telaen_body_not_alowed",$body);
	$body = preg_replace("/a:(link|visited|hover)/i",".".uniqid(""),$body);
	$body = preg_replace('|(body)[ ]?\\{|i',".".uniqid(""),$body);

} 
// with ie4+/mozilla/ns6+ use iframe for display body  
elseif($ie4up || $ns6moz) {
	$auth["currentbody"] = $body;;
	$body = "<iframe src=\"show_body.php?folder=".htmlspecialchars($folder)."&ix=$ix\" width=\"100%\" height=\"400\" frameborder=\"0\"></iframe>";

} 
// with ns4 use ilayer
elseif($ns4) {
	$auth["currentbody"] = $body;;
	$body = "<ilayer width=\"100%\" left=\"0\" top=\"0\">$body</ilayer>";
}

$smarty->assign("umMessageBody",$body);

// look if the msg needs a receipt
if ($email["receipt-to"]) {
	$smarty->assign("receiptRequired", true);
}

$ARFrom = $email["from"];
$useremail = $auth["email"];

// from
$name = $ARFrom[0]["name"];
$thismail = $ARFrom[0]["mail"];
$ARFrom[0]["link"] = "newmsg.php?nameto=".urlencode($name)."&mailto=$thismail";
$ARFrom[0]["title"] = "$name <$thismail>";

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

$jssource = $commonJS;
$jssource .= "
<script type=\"text/javascript\">
//<![CDATA[
function deletemsg() { 
	if(confirm('".preg_replace("/'/","\\'",$confirm_delete)."')) 
		with(document.move) { decision.value = 'delete'; submit(); } 
}
function reply() { document.msg.submit(); }
function movemsg() { document.move.submit(); }
function newmsg() { location = 'newmsg.php?folder=$folder&pag=$pag'; }
function headers() { mywin = window.open('headers.php?folder=".urlencode($folder)."&ix=$ix','Headers','width=550, top=100, left=100, height=320,directories=no,toolbar=no,status=no,scrollbars=yes,resizable=yes'); }
function catch_addresses() { window.open('catch.php?folder=".urlencode($folder)."&ix=$ix','Catch','width=550, top=100, left=100, height=320,directories=no,toolbar=no,status=no,scrollbars=yes'); }
function block_addresses() { window.open('block_address.php?folder=".urlencode($folder)."&ix=$ix','Block','width=550, top=100, left=100, height=320,directories=no,toolbar=no,status=no,scrollbars=yes'); }

function replyall() { with(document.msg) { rtype.value = 'replyall'; submit(); } }
function forward() { with(document.msg) { rtype.value = 'forward'; submit(); } }
function newmsg() { location = 'newmsg.php?pag=$pag&folder=".urlencode($folder)."'; }
function folderlist() { location = 'folders.php?folder=".urlencode($folder)."'}
function goback() { location = 'messages.php?folder=".urlencode($folder)."&pag=$pag'; }
function search() { location = 'search.php'; }
function emptytrash() { location = 'folders.php?empty=trash&folder=".urlencode($folder)."&goback=true';}
function printit() { window.open('printmsg.php?folder=".urlencode($folder)."&ix=$ix','PrintView','resizable=1,top=10,left=10,width=700,height=500,scrollbars=1,status=0'); }
function openmessage(attach) { window.open('readmsg.php?folder=".urlencode($folder)."&pag=$pag&ix=$ix&attachment='+attach,'','resizable=1,top=10,left=10,width=700,height=500,scrollbars=1,status=0'); }
function openwin(targetUrl) { window.open(targetUrl); }



//]]>
</script>
<script type=\"text/javascript\" src=\"./js/ajax_prototype.js\"></script>
<script type=\"text/javascript\">
//<![CDATA[
function sendReceipt(subj, msg) {
	new Ajax.Request('ajax.php', {
		method: 'post',
		parameters: {action: 'sendReceipt', recipient: '" . $email["receipt-to"] . "', receipt_subj: subj, receipt_msg: msg}
	}); 
}

//]]>
</script>
";

$umDeleteForm = "<input type=\"hidden\" name=\"decision\" value=\"move\" />
<input type=\"hidden\" name=\"folder\" value=\"".htmlspecialchars($folder)."\" />
<input type=\"hidden\" name=\"pag\" value=\"$pag\" />
<input type=\"hidden\" name=\"start_pos\" value=\"$ix\" />
<input type=\"hidden\" name=\"end_pos\" value=\"".($ix+1)."\" />
<input type=\"hidden\" name=\"msg_$ix\" value=\"X\" />
<input type=\"hidden\" name=\"back\" value=\"true\" />";

$umReplyForm = "<form name=\"msg\" action=\"newmsg.php\" method=\"post\">
	<input type=\"hidden\" name=\"rtype\" value=\"reply\" />
	<input type=\"hidden\" name=\"folder\" value=\"".htmlspecialchars($folder)."\" />
	<input type=\"hidden\" name=\"ix\" value=\"$ix\" />
</form>
";

$smarty->assign("umDeleteForm",$umDeleteForm);
$smarty->assign("umReplyForm",$umReplyForm);
$smarty->assign("umJS",$jssource);

$smarty->assign("umSubject",$email["subject"]);
$smarty->assign("umDate",$email["date"]);

$anexos = $email["attachments"];
$haveattachs = (count($anexos) > 0)?1:0;

if(count($anexos) > 0) {
	$root = &$mail_info["attachments"];

	foreach($arAttachment as $item ) {
		if(is_numeric($item)) {
			$root = &$root[$item]["attachments"];
		}
	}

	$root = $email["attachments"];
	$mbox["headers"][$folderkey][$ix] = $mail_info;

	$nIndex = count($arAttachment);
	$attachAr = array();

	for($i=0;$i<count($anexos);$i++) {

		$arAttachment[$nIndex]	= $i;
		$link1 = "download.php?folder=$folder&ix=$ix&attach=".join(",",$arAttachment)."";
		$link2 = "$link1&down=1";

		if(!$anexos[$i]["temp"]) {
			if($anexos[$i]["content-type"] == "message/rfc822") 
				$anexos[$i]["normlink"] = "<a href=\"javascript:openmessage('".join(",",$arAttachment)."')\">";
			else
				$anexos[$i]["normlink"] = "<a href=\"$link1\" target=\"_new\">";

			$anexos[$i]["downlink"] = "<a href=\"$link2\">";
			$anexos[$i]["size"] = ceil($anexos[$i]["size"]/1024);
			$anexos[$i]["type"] = $anexos[$i]["content-type"];
			$attachAr[] = $anexos[$i];
		}
	}
	$smarty->assign("umHaveAttachments",(count($attachAr) > 0));
	$smarty->assign("umAttachList",$attachAr);
}

$AuthSession->Save($auth);


$avalfolders = array();
$d = dir($userfolder);
while($entry=$d->read()) {
	if( is_dir($userfolder.$entry) && 
		$entry != ".." && 
		$entry != "." && 
		substr($entry,0,1) != "_" && 
		$entry != $folder &&
		($TLN->mail_protocol == IMAP || ($entry != "inbox" && $entry != "spam"))) {
		$entry = $TLN->fix_prefix($entry,0);
		switch(strtolower($entry)) {
		case "inbox":
			$display = $inbox_extended;
			break;
		case "spam":
			$display = $spam_extended;
			break;
		case "sent":
			$display = $sent_extended;
			break;
		case "trash":
			$display = $trash_extended;
			break;
		default:
			$display = $entry;
		}
		$avalfolders[] = array("path" => $entry, "display" => $display);

	}
}
$d->close();
$smarty->assign("umAvalFolders",$avalfolders);
unset($TLN);

if($is_attached)
	$smarty->display("$selected_theme/readmsg_popup.htm");
else
	$smarty->display("$selected_theme/readmsg.htm");
?>
