<?php
require("auth.php");
require("db.php");

class Request{
    
    public function dateConvert($date){
	list($day, $month, $year) = explode('/', $date);
	$timestamp = mktime(0, 0, 0, $month, $day, $year);
	
	return $timestamp;
    }
    
    public function pullUser($username){ //Pulls user information from a Database - returns object array
	global $db;
	$result = $db->query("SELECT * FROM s_user WHERE username='".$username."';");
	while($user = $result->fetch_object()){
	    return $user;
	}
	unset($result);
    }
        
    public function Lesson($lessonArray,$doa){ // Inserts into req_lesson table - returns int 0 for failure, 1 for success
	global $db;
	$result = $db->query("SELECT reqid FROM request WHERE username='".phpCAS::GetUser()."' AND doa='".$doa."' LIMIT 1");
	while($req = $result->fetch_object()){
	    foreach($lessonArray as $i => $l){
		if(!$db->query("INSERT INTO `req_lesson` (`reqid`, `lesson`) VALUES ('".$req->reqid."', '".$l."');")){
		    
		    return 0;
		}
	    }
	}
	unset($result);
	unset($req);
	
	return 1;
    }
    
    public function Absence($dor,$doa,$type,$information){
	global $db;
	// Check against already made requests
	$result = $db->query("SELECT * FROM request WHERE doa='".$doa."' AND username='".phpCAS::GetUser()."';");
	if($result->num_rows > 0){ //Check if request was already made
	    header("Location:error.php?error=form_submit_exists");
	    exit;
	}
	if(!$db->query("INSERT INTO request (forename, surname, username, dor, doa, leavetype, information) VALUES ('".$this->pullUser(phpCAS::GetUser())->forename."', '".$this->pullUser(phpCAS::GetUser())->surname."', '".phpCAS::GetUser()."', '".$dor."', '".$doa."', '".$type."', '".$information."');")){

	    return 0;
	}
	
	return 1;
    }
}

class Manager{
    
    public function checkTicketExists($reqid){ //Checks if there exists a request by searching the requested ID - returns int 0 for non-existant, int 1 for existant
	global $db;
	$result = $db->query("SELECT * FROM request WHERE reqid='{$reqid}';");
	if($result->num_rows == 1){

	    return 1;
	}
	
	unset($result);
	
	return 0;
    }
    
    public function Data($reqid){
	global $db;
	
	if(!isset($reqid)){
	    die("Request ID needed. Error in ".$_SERVER['PHP_SELF']);
	}
	
	$result = $db->query("SELECT * FROM request WHERE reqid='{$reqid}' LIMIT 1;");
	$req = $result->fetch_object();
	unset($result);
	
	$result = $db->query("SELECT * FROM s_user WHERE username='{$req->username}';");
	$personnel = $result->fetch_object();
	unset($result);
	
	$result = $db->query("SELECT name FROM s_office WHERE id='{$personnel->office}' LIMIT 1;");
	$office = $result->fetch_object();
	unset($result);
	
	$result = $db->query("SELECT * FROM s_leave WHERE id='{$req->leavetype}' LIMIT 1;");
	$type = $result->fetch_object();
	unset($result);
	
	$result = $db->query("SELECT lesson FROM req_lesson WHERE reqid='{$reqid}';");
	$req_lesson = $result->fetch_object();
	unset($result);
		
	$result = $db->query("SELECT * FROM s_lesson WHERE id='{$req->lesson}';");
	//$lesson = $result->fetch_object();
	unset($result);
	
	//$result = $db->query("SELECT * FROM approval WHERE reqid='{$reqid}';");
	//$approval = $result->fetch_object();
	//unset($result);

	//Object construct
	$name = "{$personnel->surname}, {$personnel->forename}";
	$ticket_array = array("initials" => $personnel->initials, "name" => $name, "office" => $office->name, "dor" => $req->dor, "doa" => $req->doa, "type" => $type->name, "lesson" => "No Lessons Yet", "approval" => 0, "information" => $req->information);
	foreach($ticket_array as $akey => $aval){
            $ticket->{$akey} = $aval;
        }
	
	unset($name);
	unset($ticket_array);
	unset($req);
	unset($personnel);
	
	return $ticket;
	
    }
    
}

class Security{
    
    public function getError(){
	if(isset($error)){
	    return $error;
	}
	
	return 1;
    }
    
    public function hasAccount($username){ //Unused
	global $db;
	$result = $db->query("SELECT * FROM s_user WHERE username='".$username."';");
	if($result->num_rows > 0){
	    $_SESSION['UserBadge'] = SHA1($username."bgyu@34d@asd2'][;;23adsada3f3d3");

	    return 1;
	}
	
	return 0;
    }
    
    public function hasPerm($username, $reqid){
	global $db;
	$reqid = $this->SQLPrep($reqid);
	$result = $db->query("SELECT * FROM s_user WHERE username='{$username}';");
	$group = $result->fetch_object()->group;
	
	if($result->num_rows > 0 && !isset($reqid)){
	    return $group;
	}elseif($result->num_rows > 0 && isset($reqid)){
	    if($group > 1){
		return $group;
	    }else{
		$result = $db->query("SELECT username FROM request WHERE reqid='{$reqid}' LIMIT 1;");
		$req = $result->fetch_object();
		if($req->username == $username){
		
		    return 1;
		}
	    }
	}else{ //Before this final else, there should be an elseif for line managers and managers
	    $result = $db->query("SELECT username FROM request WHERE reqid='{$reqid}' LIMIT 1;");
	    $req = $result->fetch_object();
	    if($req->username == $username){
		
		return 1;
	    }
	}
	
	unset($result);
	unset($data);
	unset($req);
	
	return 0; //False flag
    }
    
    public function SQLPrep($str){
	$search=array("\\","\0","\n","\r","\x1a","'",'"');
	$replace=array("\\\\","\\0","\\n","\\r","\Z","\'",'\"');
	
	return str_replace($search,$replace,$str);
    }
}

$request = new Request();
$mgr = new Manager();
$security = new Security();

// Var definer for ease of use
$user = $request->pullUser(phpCAS::GetUser());

?>