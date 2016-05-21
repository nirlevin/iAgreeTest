<?php
	session_start();
	
	unset($_SESSION['user']);
	
	//Unset Google OAuth 2.0 access token
	unset($_SESSION['access_token']);
	
	//unset($_SESSION['saved_contract']);
	
	header("Location: login.php");
?>
