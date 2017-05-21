<?php
	session_start();
	include("config.php");
	
	$pattern = "/(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.*[0-9])(?=.*[a-z])(?!.*[<>()?.,\/\\{}\[\\s]+\-~|;:\'\"=]).{6,}/";
	if (preg_match($pattern, $_POST["password1"])){
		if ($_POST["password1"]==$_POST["password2"]){
			$l = new SignupFunctions;
			if($l->signup($database["owners"], $_POST["firstname"], $_POST["lastname"], $_POST["businessname"], $_POST["username"], 
			$_POST["password1"], $_POST["password2"], $_POST["contact"], $_POST["address"])==true){
				header("Location: SignUpConfirmation.html");		
			} else {
				$_SESSION["sameUserName"] = true;
				header("Location: ownerRegister.html");
			}		
		} else {
			$_SESSION["samePwd"] = false;
			header("Location: ownerRegister.html");
		}
	} else {
		$log->addInfo("Sign up failed, passwords does not match format restrictions");
		$_SESSION["format"] = false;
		header("Location: ownerRegister.html");
	}

class SignupFunctions{
	
	public function signup($customersdb, $firstname, $lastname, $businessname, $username, $password1, $password2, $contact, $address){
		$j = new JSONHandler;
		if ($password1 == $password2){
			if (!empty($j->search($customersdb, "username", $username))){
				return false;
			} else {
				$data = array("username" => $username, "password" => $password1, "businessname" => $businessname, 
						"ownername" => $firstname." ".$lastname, "address" => $address, "phoneno" => $contact);
				$j->addToFile($customersdb, $data);
				return true;
			}
		} else {
			return false;
		}
	}
}

?>