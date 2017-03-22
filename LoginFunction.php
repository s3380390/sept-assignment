<?php
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	json_encode($user);
	
	if ($username == $user['username'] && $password == $user['password']){
		echo "Welcome!"
	} else {
		echo "Invalid Username or Password!"
	}
?>