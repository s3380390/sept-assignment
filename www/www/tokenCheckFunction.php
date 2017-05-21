<?php
session_start();
include_once("config.php");
	
	$t = new TCheck;
	
	if($t->tokenCheck($_POST["tokenInput"])){
		header("Location: ownerRegister.html");
	} else {
		header("Location: token.html");
	}
	
class TCheck{
	public function tokenCheck($token){
		$j = new JSONHandler;
		$db = "../database/tokens.json";
		if (!empty($j->search($db, "token", $token))){
			return true;
		} else {
			return false;
		}
	}
}

?>
