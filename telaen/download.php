<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://www.telaen.org/

*************************************************************************/
@ini_set ( 'output_buffering',    1024 );
@ob_start();

// load session management
require("./inc/inc.php");

// check for main parameters
if(!isset($_GET['folder']) || !isset($_GET['ix']))
    die();

$folder = $_GET['folder'];
$ix = $_GET['ix'];

// ensure we have email infos
$mail_info = $sess["headers"][base64_encode(strtolower($folder))][$ix];
if(!is_array($mail_info))
    die();

// check if we are downloading an attachment or the entire message
if(isset($_GET['attach'])) {
    $att = $_GET['attach'];
    $downAll = false;   
} else {
    $downAll = true;
}

if($downAll) {
    $sourceFile = $mail_info['localname']; 
    if(ereg("\\.\\.",$sourceFile) || !file_exists($sourceFile)) {
        die();
        }

    $size = filesize($sourceFile);
    $disposition = "attachment";
    $type = "message/rfc822";
    $dlfname = trim($mail_info["subject"]) . ".eml";

} else {
    $arAttachment = explode(",",$att);  
    $attach = $mail_info;
    foreach($arAttachment as $item)
        if(is_numeric($item))
            $attach = &$attach["attachments"][intval($item)];

    $sourceFile = $attach["filename"];
    if(ereg("\\.\\.",$sourceFile) || !file_exists($sourceFile)) {
        die();
    }
    
    $size = filesize($sourceFile);
    $disposition = (!$down)?"inline":"attachment";
    $type = (!preg_match('/[a-z0-9\-]+\/[a-z0-9\-]+/i',$attach["content-type"]))?"application/octet-stream":$attach["content-type"];
    $dlfname = $attach["name"];
}

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public"); 
header("Content-Description: File Transfer");
header("Content-Type: $type");
header("Content-Disposition: $disposition; filename=\"$dlfname\";");
header("Content-Transfer-Encoding: binary");
header("Content-Length: $size");

@ob_end_flush();

readfile($sourceFile);
?>
