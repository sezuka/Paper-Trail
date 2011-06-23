<?php
require("config.php");

$db = new mysqli($db_server, $db_user, $db_password, $db_dbname, $db_port);

if(mysqli_connect_error()){
    die('MySQL Connection Error: ('.mysqli_connect_errno().') '.mysqli_connect_error());
}



?>