<?php
	session_start();
	error_reporting(E_ALL);
	
	//check if the user is not yet logged in
	if(! isset($_SESSION["username"])) {
		//if user is not yet logged in, force him or her to go back to login.php
		header("location: login.php");
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home | Employee Management</title>

<?php
	include_once 'header.php';
?>

	<div class="content-container">
		<p>Main Menu</p>
		<div class="menu-container">
			<a href="add_employee.php">
				<div class="menu-box">
					<i class="fa-solid fa-user-plus"></i>
					<p>Add Employee</p>
				</div>
			</a>
			<a href="search_employee.php">
				<div class="menu-box">
					<i class="fa-solid fa-magnifying-glass"></i>
					<p>Search Employee</p>
				</div>
			</a>
			<a href="list_employee.php">
				<div class="menu-box">
					<i class="fa-solid fa-list"></i>
					<p>Employee List</p>
				</div>
			</a>
			<a href="update_employee.php">
				<div class="menu-box">
					<i class="fa-solid fa-user-pen"></i>
					<p>Update Employee</p>
				</div>
			</a>
		</div>		
	</div>

<?php
	include_once 'footer.php';
?>