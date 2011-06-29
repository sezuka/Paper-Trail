<?php
require $_SERVER['DOCUMENT_ROOT']."/paper/system/function.php";

//Errors
//index_filecheck_missing - Index filecheck reports missing file
//form_submit_exists - Form submit system reports the request already exists in the database
//form_submit_timelimitreach - Form submit system anti-resubmition system is denying the user to post a request within the same 20 seconds
//form_submit_fail - Form submit system (func Absence or Lesson) returned failure
//form_submit_unselected - A required field is unselected (null/empty) and system cannot continue
//ticket_no_exist - View request system reports ticket does not exist
//ticket_no_perm - View request system reports user does not have permision to see the specified request


if(!isset($_REQUEST['error'])){
    header("Location:index.php");
}

$error_full = $_REQUEST['error'];
$error = explode("_", $error_full);

$error_dump = "
Error: {$error_full}
Time: ".time()."
User: ".phpCAS::GetUser()."
Machine: {$_SERVER['HTTP_USER_AGENT']}
IP: {$_SERVER['REMOTE_ADDR']}\n\n";
$file = fopen("logs/".date("d-m-y").".log", "a+");
fwrite($file, $error_dump);
fclose($file);

?>
<!DOCTYPE HTML>
<html>
    <head>
	<title>General Request for Leave of Absence</title>
	<link href="./css/stylesheet.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="main">
	<h4 style="color: white; float: right;"><a href="index.php">Home</a><br /><a href="logout.php">Logout</a></h4>
	<p id="error">
<?php
switch($error[0]){
    case "index": //These index errors in theory should never happen, but you never know
	if($error[1] == "filecheck" && $error[2] == "missing"){
	    echo 'An important file for the Paper Trail software is <b>missing</b>! Please contact your Network Administrator.';
	}
	//header('location:index.php');
	break;
    case "form":
	if(!$error[1] == "submit"){
	    header('location:index.php');
	    break;
	}
	switch($error[2]){
	    case "timelimitreach":
		echo 'You attempted to submit more than one request, please wait a moment before trying again.';
		break;
	    case "unselected":
		echo 'One or more Form items were not selected!';
		break;
	    case "fail":
		echo 'Your request failed to register. Please try again in a few minutes.';
		break;
	    case "exists":
		echo 'Your request already exists!';
		break;
	}
	break;
    
    //case "ticket":
	//ticket viewing system
	//break;
    
    default:
	echo '<h3 id="error">Unknown Error. Please contact your Network Administrator with the information on this page.</h3><br />';
	echo "Error: ".$error_full."<br />\n";
	echo "Time: ".time()."<br />\n";
	echo "User: ".phpCAS::GetUser()."<br />\n";
	echo "Machine: ".$_SERVER['HTTP_USER_AGENT']."<br />\n";
	echo "IP: ".$_SERVER['REMOTE_ADDR']."\n";
	break;
}

unset($error);
unset($break);
?>
	</p>
    </body>
</html>