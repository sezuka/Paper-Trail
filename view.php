<?php
require $_SERVER['DOCUMENT_ROOT']."/paper/system/function.php";
?>
<!DOCTYPE HTML>
<html>
    <head>
	<title>Paper Trail - Request Viewer<?php if(isset($_GET['request'])){ echo " - Request #".$_GET['request']; } ?></title>
	<link href="./css/stylesheet.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="./js/form.js"></script>
    </head>
    <body class="main">
	<h4 style="color: white; float: right;"><a href="index.php">Home</a><br /><a href="logout.php">Logout</a></h4>
	<?php echo "<p>Logged in as: ".phpCAS::GetUser()."</p>"; ?>
	<h1>Request Viewer<?php if(isset($_GET['request'])){ echo " - Request #".$_GET['request']; } ?></h1>
<?php

// Access groups/view permissions for this system
// Group 0 - no access
// Group 1 - access to own content
// Group 2 - managers (view/approve to users below access)
// Group 3 - administrators (all access)

if(!isset($_GET['request'])){
    global $db;
    if($security->hasPerm(phpCAS::GetUser()) > 1){
	echo '<p>Logged in as an <b>Administrator</b></p>';
	$result = $db->query("SELECT * FROM request ORDER BY reqid DESC;");
    }else{
	$result = $db->query("SELECT * FROM request WHERE username='".phpCAS::GetUser()."' ORDER BY reqid DESC;");
    }
    if($result->num_rows > 0){
	while($v = $result->fetch_object()){
	    echo "<a href=\"{$_SERVER['PHP_SELF']}?request={$v->reqid}\">Request #{$v->reqid}</a> by {$v->username}<br />";
	}
	echo '</p>';
    }else{
	echo '<p>You have made no requests.</p>';
	exit;
    }
    unset($result);
    unset($v);
    //
}else{
    //
    $reqid = $security->SQLPrep($_GET['request']);
    if($mgr->checkTicketExists($reqid) != 1){
	header("Location:error.php?error=ticket_no_exist");
	exit(2);
    }
    if($security->hasPerm(phpCAS::GetUser(),$reqid) < 1){
        header("Location:error.php?error=ticket_no_perm");
        exit(2);
    }
    
    
    
    $ticket = $mgr->Data($reqid);

?>

	<table border="1">
	    <tr>
		<th>Initials</th>
		<th>Name</th>
		<th>Department</th>
		<th>Date of Request</th>
		<th>Date of Absence</th>
		<th>Type</th>
		<th>Lesson(s)</th>
		<th>Status</th>
		<th>Reason/Information</th>
	    </tr>
	    <tr>
		<td><?php echo $ticket->initials; ?></td>
		<td><?php echo $ticket->name; ?></td>
		<td><?php echo $ticket->office; ?></td>
		<td><?php echo date("D d/m/Y", $ticket->dor); ?></td>
		<td><?php echo date("D d/m/Y", $ticket->doa); ?></td>
		<td><?php echo $ticket->type; ?></td>
		<td><?php
			$result = $db->query("SELECT lesson FROM req_lesson WHERE reqid='{$reqid}';");
			while($l_row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			    $result_n = $db->query("SELECT name FROM s_lesson WHERE id='{$l_row['lesson']}';");
			    while($l_row_n = mysqli_fetch_array($result_n, MYSQLI_ASSOC)){
				foreach($l_row_n as $key_n => $dat_n){
				    echo $dat_n.", ";
				}
			    }
			}
			?></td>
		<td>Pending Approval</td>
		<td><?php echo $ticket->information; ?></td>
	    </tr>
	</table>
	<br /><br />
	<a href="<?php echo $_SERVER['PHP_SELF']; ?>">Back</a>
<?php
    if($security->hasPerm(phpCAS::GetUser(),$reqid) > 0){
?>
	<span style="float: right;">Options
	    <form action="edit.php" method="GET">
		<input type="hidden" name="request" value="<?php echo $security->SQLPrep($reqid); ?>" />
		<select name="do">
		    <option value="edit">Modify Request</option>
		   <?php if($security->hasPerm(phpCAS::GetUser(), $reqid) > 2){ ?><option value="close">Close Request</option><?php } ?>
		   <?php if($security->hasPerm(phpCAS::GetUser(), $reqid) > 1){ ?><option value="approve">Approve Request</option><?php } ?>
		   <?php if($security->hasPerm(phpCAS::GetUser(), $reqid) > 1){ ?><option value="deny">Deny Request</option><?php } ?>
		</select>
		<input type="submit" name="submit" value="Go" id="submit" />
	    </form>
	</span>
<?php
    }
}
?>