<?php

include("../lib/JSONHandler.php");
	
	$l = new LoginFunctions;
	$l->login($_POST["username"], $_POST["password"]);
class LoginFunctions{
	public function login($username, $password){
		$j = new JSONHandler;
		$customersdb = "../database/customers.json";
		if (!empty($user = $j->search($customersdb, "username", $username))){
			if ($user["password"] == $password){
				echo "Welcome!";
				return true;
			}
		}
		echo "Invalid Username or Password!";
		return false;
	}
}

?>
