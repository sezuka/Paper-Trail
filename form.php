<?php
require $_SERVER['DOCUMENT_ROOT']."/paper/system/function.php";
?>
<!DOCTYPE HTML>
<html>
    <head>
	<title>General Request for Leave of Absence</title>
	<script type="text/javascript" src="./js/form.js"></script>
	<script type="text/javascript" src="./js/jquery.min.js"></script>
	<script type="text/javascript" src="./js/datepicker.js">;{"describedby":"fd-dp-aria-describedby"}</script>
	<link href="./css/datepicker.css" rel="stylesheet" type="text/css" />
	<link href="./css/stylesheet.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
	<h4><a href="logout.php" style="color: white; float: right;">Logout</a></h4>
	<h1>Request for Leave of Absence</h1>
	<form method="POST" action="submit.php" name="absence" onSubmit="return validate();">
	    <input type="hidden" name="fid" value="1" />
	    <p><?php echo $request->pullUser(phpCAS::GetUser()) ? "Name: ".$user->forename." ".$user->surname : "Username: ".phpCAS::GetUser()." (Unknown User)"; ?></p>
	    <p>Today's Date: <?php echo date("d/m/Y"); ?></p>
	    <p>Date of Absence: <input type="text" class="w16em" id="cal"  name="doa" value="<?php echo date("d/m/Y"); ?>" /></p>
	    <script type="text/javascript">
		// <![CDATA[
		var opts = {
		    formElements:{"cal":"d-sl-m-sl-Y"}
		};
		datePickerController.createDatePicker(opts);
		// ]]>
	    </script>
	    <p>Reason for leaving:<br />
		<input type="radio" name="type" value="1" onClick="return showOpt('cb');" />Work<br />
		<input type="radio" name="type" value="2" />Personal<br />
		<input type="radio" name="type" value="3" />Medical<br />
		<input type="radio" name="type" value="4" />Annual Leave<br />
		<input type="radio" name="type" value="5" />Time off in Lieu<br />
	    </p>
	    <p>Please state the reason of your absence and any additional information:<br />
		<textarea name="information" cols="40" rows="5"></textarea>
	    </p>
	    <span id="cb" style="display: none;">
		<p>Please <b>tick</b> the times for which you will be out of school:<br />
		    <input type="checkbox" name="lesson[]" value="1" />Registration<br />
		    <input type="checkbox" name="lesson[]" value="2" />Lesson 1<br />
		    <input type="checkbox" name="lesson[]" value="3" />Lesson 2<br />
		    <input type="checkbox" name="lesson[]" value="4" />Lesson 3<br />
		    <input type="checkbox" name="lesson[]" value="5" />Lesson 4<br />
		    <input type="checkbox" name="lesson[]" value="6" />Lesson 5<br />
		    <input type="checkbox" name="lesson[]" value="7" />Lesson 6<br />
		    <input type="checkbox" name="lesson[]" value="0" />No cover needed
		</p>
	    </span><br />
	    <input type="submit" name="submit" value="Submit Request" />
	</form>
    </body>
</html>