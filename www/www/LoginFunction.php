<?php
session_start();
include_once("config.php");
	
	$l = new LoginFunctions;
	
         //Checking if user login in details are in the customer database
	if($l->login($_POST["username"], $_POST["password"], $database['customers'], "customer")){
		$log->addInfo("Customer: " . $_POST["username"] . " logged in successfully");
		header("Location: CustomerHome.html");
	} else {
		//Checking if user login in details are in the owner database
		if ($l->login($_POST["username"], $_POST["password"], $database['owners'], "owner")){
			$log->addInfo("Owner: " . $_POST["username"] . " logged in successfully");
			header("Location: OwnerHome.html");
		}else{
			$log->addInfo("Failed login attempt");
			header("Location: login.html");
		}
	}
	
class LoginFunctions{
	public function login($username, $password, $db, $type){
		$j = new JSONHandler;
		//search for username in database
		if (!empty($user = $j->search($db, "username", $username))){
			//if username is found, checking if password matches
			if ($user["password"] == $password){
				$_SESSION["UserName"] = $user["username"];
				$_SESSION["Password"] = $user["password"];
				//distinguishing between customer or owner
				if ($type == "customer"){
					$_SESSION["Name"] = $user["name"];
					$_SESSION["UserType"] = "Customer";
				} else {
					$_SESSION["BusinessName"] = $user["businessname"];
					$_SESSION["OwnerName"] = $user["ownername"];
					$_SESSION["UserType"] = "Owner";
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
