<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://www.telaen.com/

*************************************************************************/

require("./inc/inc.php");

$smarty->assign("pageMetas", $nocache);

if (isset($rem) && $rem != "") {

    $attchs = $sess["attachments"];
    @unlink($attchs[$rem]["localname"]);
    unset($attchs[$rem]);
    $c = 0;
    $newlist = Array();
    while(list($key,$value) =  each($attchs)) {
        $newlist[$c] = $value; $c++;
    }
    $sess["attachments"] = $newlist;
    $SS->Save($sess);
    echo("
    <script language=javascript>\n
        if(window.opener) window.opener.doupload();\n
        setTimeout('self.close()',500);\n
    </script>\n
    ");

} elseif (  isset($userfile) && 
        ((!is_array($userfile) && is_uploaded_file($userfile)) || 
        is_uploaded_file($userfile["tmp_name"]))) {

    //if(file_exists($userfile["tmp_name"])) {


    $userfile_name  = $userfile["name"];
    $userfile_type  = $userfile["type"];
    $userfile_size  = $userfile["size"];
    $userfile   = $userfile["tmp_name"];


    if(!is_array($sess["attachments"])) $ind = 0;
    else $ind = count($sess["attachments"]);

    $filename = $userfolder."_attachments/".md5(uniqid("")).$userfile_name;

    move_uploaded_file($userfile, $filename);

    $sess["attachments"][$ind]["localname"] = $filename;
    $sess["attachments"][$ind]["name"] = $userfile_name;
    $sess["attachments"][$ind]["type"] = $userfile_type;
    $sess["attachments"][$ind]["size"] = $userfile_size;

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
