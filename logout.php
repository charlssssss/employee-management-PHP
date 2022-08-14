<?php
	session_start();
	error_reporting(E_ALL);
	
	//check if the user is not yet logged in
	if(! isset($_SESSION["username"])) {
		//if user is not yet logged in, force him or her to go back to login.php
		header("location: login.php");
		exit;
	}	
	
	//destroy the session
	$_SESSION = array(); //empty the session array variable
	session_destroy();
	unset($_SESSION);	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Logout | Employee Management</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/05f5e3eb98.js" crossorigin="anonymous"></script>
</head>
<body>
	<div class="content-container">
		<div class="logout-wrapper">
			<h5 class="logout-msg"><i class="fa-regular fa-circle-check"></i>&nbsp; You have successfully logged out from the website. Thank you for logging in!</h5>
			<h5 class="logout-msg">Click <a href="login.php">here</a> to login again.</h5>
		</div>
	</div>

<?php
	include_once 'footer.php';
?>