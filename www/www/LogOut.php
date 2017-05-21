<?php
	session_start();
	session_destroy();
        //User redirected to login page when loging out 
	header("Location: login.html");
?>
