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
echo($nocache);
$body = $sess["currentbody"];
echo($body);
?>
