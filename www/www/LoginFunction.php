<?php
session_start();
include_once("../lib/JSONHandler.php");
	
	$l = new LoginFunctions;
	if($l->login($_POST["username"], $_POST["password"], "customer")){
		header("Location: CustomerHome.html");
	} else {
		if ($l->login($_POST["username"], $_POST["password"], "owner")){
			header("Location: OwnerHome.html");
		}else{
			header("Location: login.html");
		}
	}
class LoginFunctions{
	public function login($username, $password, $type){
		$j = new JSONHandler;
		$db = array("customer"=>"../database/customers.json", "owner"=>"../database/owners.json");
		if (!empty($user = $j->search($db[$type], "username", $username))){
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
