<?php
	session_start();
	include("config.php");
	
	$pattern = "/(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.*[0-9])(?=.*[a-z])(?!.*[<>()?.,\/\\{}\[\\s]+\-~|;:\'\"=]).{6,}/";
	if (preg_match($pattern, $_POST["password1"])){
		$log->addDebug("Password matches format restrictions");
		if ($_POST["password1"]==$_POST["password2"]){
			$l = new SignupFunctions;
			if($l->signup($database["customers"], $_POST["firstname"], $_POST["lastname"], $_POST["username"], 
			$_POST["password1"], $_POST["password2"], $_POST["contact"], $_POST["address"])==true){
				$log->addInfo("Sign up success for " . $_POST["username"]);
				header("Location: SignUpConfirmation.html");		
			} else {
				$log->addInfo("Sign up failed for " . $_POST["username"] . ", user already exists");
				$_SESSION["sameUserName"] = true;
				header("Location: register.html");
			}		
		} else {
			$log->addInfo("Sign up failed, passwords do not match");
			$_SESSION["samePwd"] = false;
			header("Location: register.html");
		}
	} else {
		$log->addInfo("Sign up failed, passwords does not match format restrictions");
		$_SESSION["format"] = false;
		header("Location: register.html");
	}

class SignupFunctions{
	
	public function signup($customersdb, $firstname, $lastname, $username, $password1, $password2, $contact, $address){
		$j = new JSONHandler;
		//$customersdb = "../database/customers.json";
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