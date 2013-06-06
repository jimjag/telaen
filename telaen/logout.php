<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', TRUE);

require("./inc/init.php");

cleanup_dirs($userfolder, 1);
	
$SS->Kill();
redirect_and_exit("./index.php");
?> 
