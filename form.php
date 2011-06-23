<?php
require("system/function.php");

// Error handler
if(isset($_GET['error'])){
    switch($_GET['error']){
	case 1:
	    echo '<script>javascript:alert("There was an error with your submission, please try again in a couple of minutes.");</script>'; //Submit.php
	    break;
	case 2:
	    echo 'Please select a form!'; //Submit.php
	    break;
	case 3:
	    echo "Your request already exists!"; //Function - Request::Absence()
	    exit;
    }
}

$choice = '<p>Please choose a form</p>
<a href="'.$_SERVER['PHP_SELF'].'?fid=1">General Request for Leave of Absence</a>';

/*
$request = $_REQUEST['fid'];
switch($request){
    case 1:
	echo $form1;
	break;
    case 2:
	echo $form2;
	break;
    case 3:
	echo $form3;
	break;
    default:
	echo $choice;
	break;
}
*/
?>

<!DOCTYPE HTML>
<html>
    <head>
	<title>General Request for Leave of Absence</title>
	<script type="text/javascript" src="./js/form.js"></script>
	<script type="text/javascript" src="./js/jquery.min.js"></script>
	<script type="text/javascript" src="./js/datepicker.js">;{"describedby":"fd-dp-aria-describedby"}</script>
	<link href="./css/datepicker.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
	<form method="POST" action="submit.php" name="absence" onSubmit="return validate();">
	<input type="hidden" name="fid" value="1" />
	    <p>Name: <?php echo $user->forename." ".$user->surname; ?></p>
	    <p>Today's Date: <?php echo date("d/m/Y"); ?></p>
	    <p>Date of Absence: <input type="text" class="w16em" id="dp-1"  name="doa" value="<?php echo date("d/m/Y"); ?>" /></p>
	    <script type="text/javascript">
		// <![CDATA[
		var opts = {
		    formElements:{"dp-1":"d-sl-m-sl-Y"}
		};
		datePickerController.createDatePicker(opts);
		// ]]>
	    </script>

	    <p>Reason for leaving:</p>
	    <input type="radio" name="type" value="1" onClick="return showOpt('cb');" />Work<br />
	    <input type="radio" name="type" value="2" />Personal<br />
	    <input type="radio" name="type" value="3" />Medical<br />
	    <input type="radio" name="type" value="4" />Annual Leave<br />
	    <input type="radio" name="type" value="5" />Time off in Lieu<br />
	    <p>Please state the reason of your absence and any additional information:
	    <br /><textarea name="information" cols="40" rows="5"></textarea></p><br />
	    <span id="cb" style="display: none;">
	    <p>Please <b>tick</b> the times for which you will be out of school:</p>
	    <input type="checkbox" name="lesson[]" value="1" />Registration<br />
	    <input type="checkbox" name="lesson[]" value="2" />Lesson 1<br />
	    <input type="checkbox" name="lesson[]" value="3" />Lesson 2<br />
	    <input type="checkbox" name="lesson[]" value="4" />Lesson 3<br />
	    <input type="checkbox" name="lesson[]" value="5" />Lesson 4<br />
	    <input type="checkbox" name="lesson[]" value="6" />Lesson 5<br />
	    <input type="checkbox" name="lesson[]" value="7" />Lesson 6<br />
	    <input type="checkbox" name="lesson[]" value="0" />No cover needed<br /><br />
	    </span>
	    <br /><input type="submit" name="submit" value="Submit Request" />
	</form>
    </body>
</html>
