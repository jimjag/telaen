<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

require("./inc/init.php");
if(!isset($folder) || !isset($ix)) die("Expected parameters");
$body = $sess["currentbody"];
$meta_charset = "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=" . $default_char_set . "\">";
echo($nocache);
echo($meta_charset);
echo($body);
?>
