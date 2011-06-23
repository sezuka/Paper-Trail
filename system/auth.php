<?php
require("config.php");
require($cas_dir."CAS.php");

phpCAS::setDebug(); //Disable for production
phpCAS::client(CAS_VERSION_2_0, $cas_server, $cas_port, $cas_ext);
phpCAS::setNoCasServerValidation(); //Disable for production
phpCAS::forceAuthentication();

if(!isset($_SESSION['UserBadge']) && $_SESSION['UserBadge'] == SHA1(phpCAS::GetUser()."bgyu@34d@asd2'][;;23adsada3f3d3")){
    if(Security::hasAccount(phpCAS::GetUser()) != 1){
	echo "<script>javascript:alert('You do not have an account. Please contact your Network Administrator for an account.');</script>";
	phpCAS::Logout();
	exit(2);
    }
}
?>