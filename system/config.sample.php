<?php

// CAS Settings
$cas_dir = "/var/www/cas/";
$cas_server = "cas.domain.com";
$cas_port = 443;
$cas_ext = "/cas";

// Database Settings
$db_server = "localhost";
$db_port = 3306;
$db_user = "root";
$db_password = "passwd";
$db_dbname = "paper";

// Paper Trail Settings
$pt_dir = "/var/www/paper/";
$pt_www = "/paper/";
$pt_approval_req = array(1, 2, 3, 4); // Defines which Manager IDs (s_manager table) need to approve a request before it is deemed approved

?>
