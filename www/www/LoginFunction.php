<?php
session_start();
include_once("../lib/JSONHandler.php");
	
	$l = new LoginFunctions;
	if($l->login($_POST["username"], $_POST["password"])){
		header("Location: CustomerHome.html");
	} else {
		header("Location: login.html");
	}
class LoginFunctions{
	public function login($username, $password){
		$j = new JSONHandler;
		$customersdb = "../database/customers.json";
		if (!empty($user = $j->search($customersdb, "username", $username))){
			if ($user["password"] == $password){
				$_SESSION["UserName"] = $user["username"];
				$_SESSION["Password"] = $user["password"];
				$_SESSION["Name"] = $user["name"];
				$_SESSION["Address"] = $user["address"];
				$_SESSION["Phone"] = $user["phoneno"];
				return true;
			}
		}
		return false;
	}
}

?>
