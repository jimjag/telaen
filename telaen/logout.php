<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://www.telaen.org/

Telaen is based on Uebimiau (http://uebimiau.sourceforge.net)
 by Aldoir Ventura (aldoir@users.sourceforge.net)
*************************************************************************/

require("./inc/inc.php");

cleanup_dirs($userfolder, 1);
	
$SS->Kill();
redirect_and_exit("./index.php");
?> 
