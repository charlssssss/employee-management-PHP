<?php
	session_start(); //start the session first
	error_reporting(E_ALL);
	
	//check if the user is already logged in
	if(isset($_SESSION["username"])) {
		//if logged in already, redirect to home.php
		header("location: home.php");
		exit;	
	}
	
	//if the user clicks the login button	
	if(isset($_POST["login"])) {
		$username = $_POST["username"];
		$password = $_POST["password"];

		//establish a connection
		$con = mysqli_connect("localhost", "root", "", "employee_management");
		if($con) {//if connection is ok
			//create the login sql statement
			$sql = "select * from user where username = '".$username."' and password = '".md5($password)."' ";
			$user = mysqli_query($con, $sql);
			
			//check if there is a record retrieved
			if(mysqli_num_rows($user)) {
				//credentials matched
				$user = mysqli_fetch_assoc($user); //convert recordset to php array variable (associative)
				
				//form the session variables
				$_SESSION["username"] = $user["username"];
				//redirect to the home.php
				header("location: home.php");
				exit; //force exit in order to force the script to stop execution
			}
			else {
				//redirect to login with error variable
				header("location: login.php?error=wronglogin");
				exit;	
			}
			mysqli_close($con);
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login | Employee Management</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/05f5e3eb98.js" crossorigin="anonymous"></script>
</head>
<body>
	<div class="content-container">
		<form method="POST" action="login.php" class="login-form">
			<ul>
				<li><h2>User Login</h2></li>
				<li>
					<input type="text" name="username" placeholder="Username" required>
				</li>
				<li>
					<input type="password" name="password" placeholder="Password" required>
				</li>
				<?php 
					if(isset($_GET["error"])) {
						if($_GET["error"] == "wronglogin") {
							//display error message
							echo "<li><p>Wrong username or password.</p></li>";
						}
					}
				?>
				<li>
					<button type="submit" name="login" class="gen-btn"><i class="fa-solid fa-right-to-bracket"></i>&nbsp; Login</button>
				</li>
			</ul>
		</form>
	</div>

<?php
	include_once 'footer.php';
?>