<?php
	session_start();
	$pattern = "/(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.*[0-9])(?=.*[a-z])(?!.*[<>()?.,\/\\{}\[\\s]+\-~|;:\'\"=]).{6,}/";
	if (preg_match($pattern, $_POST["password1"])){
		if ($_POST["password1"]==$_POST["password2"]){
			$_SESSION['pass']=true;
			header("Location: SignUpFunction.php");
		} else {
			$_SESSION["same"] = false;
			header("Location: register.html");
		}
	} else {
		$_SESSION["format"] = false;
		header("Location: register.html");
	}
	
?>
