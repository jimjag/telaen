<?
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://www.telaen.org/

Telaen is based on Uebimiau (http://uebimiau.sourceforge.net)
 by Aldoir Ventura (aldoir@users.sourceforge.net)
*************************************************************************/


// load session management
require("./inc/inc.php");
// check for all parameters

if(	$attach == "" || 
	$folder == "" || 
	$ix == "") redirect("error.php?err=3&sid=$sid&tid=$tid&lid=$lid");

$mail_info = $sess["headers"][base64_encode(strtolower($folder))][$ix];

if(!is_array($mail_info)) redirect("error.php?err=3&sid=$sid&tid=$tid&lid=$lid");

$arAttachment = explode(",",$attach);
$attach = $mail_info;
foreach($arAttachment as $item )
	if(is_numeric($item))
		$attach = &$attach["attachments"][$item];

if(ereg("\\.\\.",$attach["filename"]) || !file_exists($attach["filename"])) { redirect("error.php?err=3&sid=$sid&tid=$tid&lid=$lid"); exit; }


$size = filesize($attach["filename"]);

$disposition = (!$down)?"inline":"attachment";
$type = (!preg_match("/[a-z]+\/[a-z\-]+/i",$attach["content-type"]))?"application/octet-stream":$attach["content-type"];
$dlfname = $attach["name"];

// Header("Content-Type: $type; name=\"".$attach["name"]."\"\r\n");
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public"); 
header("Content-Description: File Transfer");
header("Content-Type: $type");
header("Content-Disposition: $disposition; filename=\"$dlfname\";");
header("Content-Transfer-Encoding: binary");
header("Content-Length: $size");

readfile($attach["filename"]);

?>
