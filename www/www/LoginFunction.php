<?php
session_start();
include_once("config.php");
	
	$l = new LoginFunctions;
	
	if($l->login($_POST["username"], $_POST["password"], $database['customers'])){
		$log->addInfo("Customer: " . $_POST["username"] . " logged in successfully");
		header("Location: CustomerHome.html");
	} else {
		if ($l->login($_POST["username"], $_POST["password"], $database['owners'])){
			$log->addInfo("Owner: " . $_POST["username"] . " logged in successfully");
			header("Location: OwnerHome.html");
		}else{
			$log->addInfo("Failed login attempt");
			header("Location: login.html");
		}
	}
	
class LoginFunctions{
	public function login($username, $password, $db){
		$j = new JSONHandler;
		if (!empty($user = $j->search($db, "username", $username))){
			if ($user["password"] == $password){
				$_SESSION["UserName"] = $user["username"];
				$_SESSION["Password"] = $user["password"];
				if ($type == "customer"){
					$_SESSION["Name"] = $user["name"];
				} else {
					$_SESSION["BusinessName"] = $user["businessname"];
					$_SESSION["OwnerName"] = $user["ownername"];
				}
				$_SESSION["Address"] = $user["address"];
				$_SESSION["Phone"] = $user["phoneno"];
				return true;
			}
		}
		return false;
	}
}

?>
