<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://www.telaen.com/

*************************************************************************/

require("./inc/inc.php");
if(!isset($folder) || !isset($ix)) die("Expected parameters");
$body = $sess["currentbody"];
$meta_charset = "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=" . $default_char_set . "\">";
echo($nocache);
echo($meta_charset);
echo($body);
?>
