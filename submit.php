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
	<title>General Request for Leave of Absence</title>
	<link href="./css/stylesheet.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
	<h4><a href="logout.php" style="color: white; float: right;">Logout</a></h4>
	

<?php
switch($_REQUEST['fid']){
    case 1:
	if($request->Absence(time(), $security->SQLPrep($request->dateConvert($request->checkVar($_REQUEST['doa']))), $security->SQLPrep($request->checkVar($_REQUEST['type'])), $security->SQLPrep($request->checkVar($_REQUEST['information']))) == 1 && $request->Lesson($request->checkVar($_REQUEST['lesson']), $security->SQLPrep($request->dateConvert($request->checkVar($_REQUEST['doa'])))) == 1){
	    echo '<p>Request submitted. You can see all your requests <a href="view.php">here</a>.</p>';
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