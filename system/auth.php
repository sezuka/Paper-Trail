<?php
require("config.php");
require($cas_dir."CAS.php");

phpCAS::setDebug(); //Disable for production
phpCAS::client(CAS_VERSION_2_0, $cas_server, $cas_port, $cas_ext);
phpCAS::setNoCasServerValidation(); //Disable for production
phpCAS::forceAuthentication();

?>