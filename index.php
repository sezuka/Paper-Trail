<?php
require $_SERVER['DOCUMENT_ROOT']."/paper/system/auth.php";

//Index.php has been setup to check every file exists so the Paper Trail system continues to work after user leaves this page
//If a file or an important detail is missing, the script will die and give debug information
//Otherwise, it will simply redirect to the form.php script

function CheckFile($file){
    if(!file_exists($file)){
	header("Location:error.php?error=index_filecheck_missing");
	return FALSE;
    }
}

// Paper Trail system files
CheckFile($_SERVER['DOCUMENT_ROOT']."/paper/system/auth.php");
CheckFile($_SERVER['DOCUMENT_ROOT']."/paper/system/config.php");
CheckFile($_SERVER['DOCUMENT_ROOT']."/paper/system/db.php");
CheckFile($_SERVER['DOCUMENT_ROOT']."/paper/system/function.php");
//CheckFile($_SERVER['DOCUMENT_ROOT']."/paper/system/HTML.php");

// Paper Trail management files
//CheckFile($_SERVER['DOCUMENT_ROOT']."/paper/management/manage.php");
//CheckFile($_SERVER['DOCUMENT_ROOT']."/paper/management/users.php");

// Root directory
CheckFile($_SERVER['DOCUMENT_ROOT']."/paper/form.php");
CheckFile($_SERVER['DOCUMENT_ROOT']."/paper/logout.php");
CheckFile($_SERVER['DOCUMENT_ROOT']."/paper/submit.php");
CheckFile($_SERVER['DOCUMENT_ROOT']."/paper/view.php");

?>
<!DOCTYPE HTML>
<html>
    <head>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
    </head>
    <body>
	<h4><a href="logout.php" style="color: white; float: right;">Logout</a></h4>
	<h1>Paper Trail</h1>
	Request Management
	<ul>
	    <li><a href="/paper/management" style="color: white;">Management system</a></li><br /></li>
	</ul>
	Submit a Request
	<ul>
	    <li><a href="/paper/form.php" style="color: white;">Submit an absence request</a><br /></li>
	</ul>
    </body>
</html>