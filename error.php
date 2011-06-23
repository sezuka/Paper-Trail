<?php
require("system/config.php");

//Errors
//index_filecheck_missing - Index filecheck reports missing file
//form_submit_exists - Form submit system reports the request already exists in the database
//form_submit_timelimitreach - Forum submit system anti-resubmition system is denying the user to post a request within the same 20 seconds
//
//ticket_no_exist - View request system reports ticket does not exist
//ticket_no_perm - View request system reports user does not have permision to see the specified request


if(!isset($_REQUEST['error'])){
    header("Location:".$pt_www);
}

$error_full = $_REQUEST['error'];
$error = explode("_", $error_full);

switch($error[0]){
    case "index": //These index errors in theory should never happen, but you never know
	if($error[1] == "filecheck" && $error[2] == "missing"){
	    echo "An important file for the Paper Trail software is <b>missing</b>! Please contact your Network Administrator.";
	    exit;
	}
	header('location:index.php');
	break;
    case "form":
	if(!$error[1] == "submit"){
	    header('location:index.php');
	    break;
	}
	switch($error[2]){
	    case "timelimitreach":
		break;
	}
	break;
    case "ticket":
	//ticket viewing system
	break;
    default:
	$break = "<br />";
	echo 'Unknown Error. Please contact your Network Administrator with the information on this page.<br />';
	echo "Error: ".$error_full.$break;
	echo "Time: ".time().$break;
	echo "User: ".$_SERVER['HTTP_USER_AGENT']." @ ".$_SERVER['REMOTE_ADDR'].$break;
	if(isset($_REQUEST['ngin'])){ echo "Script Path: ".$_REQUEST['ngin']; }
	break;
}

unset($error);
unset($break);
?>