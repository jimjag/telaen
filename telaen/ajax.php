<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://www.telaen.org/

*************************************************************************/

/**
 * This file provides a support for ajax calls
 * All parameters must be sended via POST and the 'action' is mandatory
 */
session_name('telaen');
session_start();

// cheking for main param
if(isset($_POST['action'])) {
	
	// config & session
	require("./inc/config.php");
	require("./inc/lib.php");
	
	$action = $_POST['action'];
	switch($action) {
	
		case "sendReceipt":
			sendReceipt();									
			break;

		case "pingSession":
			pingSession();	
			break;
		default:
			echo "This action does not exist";
	}

} else {
	// no action, no fun
	echo "No action specified";
}

/** functions implementations */

// send return receipt
function sendReceipt() {
	echo "This action awaits implementation...";	
}

// Refresh the session, so it remains active 
function pingSession() {
	
	// load session
	$SS = new Session();
	$sess = $SS->Load();
	// refresh time
	$sess["start"] = time();
	// save
	$SS->Save($sess);
	// just a check for right response
	if($sess["auth"]) {
		echo "Ok, session refreshed.";
	} else {
		echo "Your session seems expired!";
	}
	
}


?>
