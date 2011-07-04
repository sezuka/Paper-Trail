<?php
require $_SERVER['DOCUMENT_ROOT']."/paper/system/function.php";

// Timed anti-resubmition script
if(!isset($_SESSION['lastReq'])){
    $_SESSION['lastReq'] = time();
}elseif(time() < $_SESSION['lastReq']+10){
    header("location:error.php?error=form_submit_timelimitreach");
    exit;
}else{
    unset($_SESSION['lastReq']);
}
?>
<!DOCTYPE HTML>
<html>
    <head>
	<title>Paper Trail</title>
	<link href="./css/stylesheet.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="main">
	<h4 style="color: white; float: right;"><a href="index.php">Home</a><br /><a href="logout.php">Logout</a></h4>
	<?php echo "<p>Logged in as: ".phpCAS::GetUser()."</p>"; ?>
<?php
switch($_REQUEST['fid']){
    case 1:
	if($request->Absence(time(), $request->dateConvert($_REQUEST['doa']), $_REQUEST['type'], $_REQUEST['information']) == 1 && $request->Lesson($_REQUEST['lesson'], $request->dateConvert($_REQUEST['doa'])) == 1){
	    echo '<h1>Request submitted.</h1><p>You can see all your requests <a href="view.php">here</a>.</p>';
	    exit(2);
	}else{
	    unset($_SESSION['lastReq']);
	    header("location:error.php?error=form_submit_fail");
	    exit;
	}
	break;
    default:
	header("Location:error.php?error=form_submit_unselected");
	exit(2);
}

?>
    </body>
</html>