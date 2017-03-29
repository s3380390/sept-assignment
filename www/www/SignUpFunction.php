<?php

include("../lib/JSONHandler.php");
	
	$l = new SignupFunctions;
	if($l->signup($_POST["firstname"], $_POST["lastname"], $_POST["username"], $_POST["password1"], 
				$_POST["password2"], $_POST["contact"], $_POST["address"])==true){
		header("Location: SignUpConfirmation.html");		
	} else {
		header("Location: register.html");
	}
	
class SignupFunctions{
	public function signup($firstname, $lastname, $username, $password1, $password2, $contact, $address){
		$j = new JSONHandler;
		$customersdb = "../database/customers.json";
		if ($password1 == $password2){
			if (!empty($j->search($customersdb, "username", $username))){
				return false;
			} else {
				$data = array("username" => $username, "password" => $password1, 
						"name" => $firstname." ".$lastname, "address" => $address, "phoneno" => $contact);
				$j->addToFile($customersdb, $data);
				return true;
			}
		} else {
			return false;
		}
	}
}

?>