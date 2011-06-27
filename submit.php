<?php
require("system/function.php");

// Timed anti-resubmition script
if(!isset($_SESSION['lastReq'])){
    $_SESSION['lastReq'] = time();
}elseif(time() < $_SESSION['lastReq']+10){
    header("location:error.php?error=form_submit_timelimitreach");
    exit;
}else{
    unset($_SESSION['lastReq']);
}

switch($_REQUEST['fid']){
    case 1:
	$dateabs = $_REQUEST['doa'];
	$type = $_REQUEST['type'];
	$lesson = $_REQUEST['lesson'];
	$information = $_REQUEST['information'];
	if($request->Absence(time(), $security->SQLPrep($request->dateConvert($dateabs)), $security->SQLPrep($type), $security->SQLPrep($information)) == 1 && $request->Lesson($lesson, $request->dateConvert($dateabs)) == 1){
	    echo 'Request submitted. You can see all your requests <a href="management/view.php">here</a>.';
	    exit(2);
	}else{
	    echo 'Something went wrong! Please contact ICT Support.';
	    unset($_SESSION['lastReq']);
	    exit;
	}
	break;
    default:
	header("Location:error.php?error=form_submit_unselected");
	exit(2);
}

?>