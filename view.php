<?php
require $_SERVER['DOCUMENT_ROOT']."/paper/system/function.php";
?>
<!DOCTYPE HTML>
<html>
    <head>
	<title>General Request for Leave of Absence</title>
	<link href="./css/stylesheet.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
	<h4><a href="logout.php" style="color: white; float: right;">Logout</a></h4>
<?php

// Access groups/view permissions for this system
// Group 0 - no access
// Group 1 - access to own content
// Group 2 - managers (all access)
// Group 3 - administrators (all access)

if(!isset($_GET['request'])){
    global $db;
    echo "<p>Logged in as: ".phpCAS::GetUser()."</p>";
    if($security->hasPerm(phpCAS::GetUser()) > 1){
	echo '<p>Logged in as an <b>Administrator</b></p>';
	$result = $db->query("SELECT * FROM request ORDER BY reqid DESC;");
    }else{
	$result = $db->query("SELECT * FROM request WHERE username='".phpCAS::GetUser()."' ORDER BY reqid DESC;");
    }
    if($result->num_rows > 0){
	echo '<p>Requests:<br />';
	while($v = $result->fetch_object()){
	    echo "<a href=\"{$_SERVER['PHP_SELF']}?request={$v->reqid}\">Request #{$v->reqid}</a> by {$v->username}<br />";
	}
	echo '</p>';
    }else{
	echo '<p>You have made no requests.</p>';
	exit;
    }
    echo $buffer;
    unset($result);
    unset($v);
    //
}else{
    //
    $reqid = $_GET['request'];
    if($mgr->checkTicketExists($reqid) != 1){
	header("Location:../error.php?error=ticket_no_exist");
	exit(2);
    }
    if($security->hasPerm(phpCAS::GetUser(),$reqid) < 1){
        header("Location:../error.php?error=ticket_no_perm");
        exit(2);
    }
    $ticket = $mgr->Data($reqid);

    $block = <<<EOT

<table border="1">
		<tr>
		    <th>Initials</th>
		    <th>Name</th>
		    <th>Department</th>
		    <th>Date of Request</th>
		    <th>Date of Absence</th>
		    <th>Type</th>
		    <th>Lesson(s)</th>
		    <th>Approved</th>
		    <th>Reason/Information</th>
		</tr>

	<tr>
		    <td>$ticket->initials</td>
		    <td>$ticket->name</td>
		    <td>$ticket->office</td>
		    <td>date("D d/m/Y", $ticket->dor)</td>
		    <td>date("D d/m/Y", $ticket->doa)</td>
		    <td>$ticket->type</td>
		    <td>$ticket->lesson</td>
		    <td>Approved</td>
		    <td>$ticket->information</td>

</tr>
	    </table><br /><br /><a href="\$_SERVER['PHP_SELF']">Back</a>
EOT;
}
?>