<?php
require("system/auth.php");

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
CheckFile("system/auth.php");
CheckFile("system/config.php");
CheckFile("system/db.php");
CheckFile("system/function.php");
CheckFile("system/HTML.php");

// Paper Trail management files
CheckFile("management/manage.php");
CheckFile("management/view.php");
CheckFile("management/users.php");

// Root directory
CheckFile("form.php");
CheckFile("logout.php");
CheckFile("submit.php");

echo '<center><a href="/paper/management">Management system</a><br /><a href="/paper/form.php">Submit an absence request</a><br /><a href="logout.php">Logout</a>';
?>
