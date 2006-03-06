<?
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://www.telaen.org/

Telaen is based on Uebimiau (http://uebimiau.sourceforge.net)
 by Aldoir Ventura (aldoir@users.sourceforge.net)
*************************************************************************/

require("./inc/inc.php");
if(!isset($folder) || !isset($ix)) die("Expected parameters");
$body = $sess["currentbody"];
$meta_charset = "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=" . $default_char_set . "\">";
echo($nocache);
echo($meta_charset);
echo($body);
?>
