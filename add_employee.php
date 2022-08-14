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
	<title>Add Employee | Employee Management</title>

<?php
	include_once 'header.php';// reuse header

	$active = "add";// for the side menu css
?>

	<div class="employee-container">
		<?php 
			include_once 'side_menu.php';// reuse side menu
		?>
		
		<div class="employee-wrapper">
			<?php
				if(isset($_POST["add"])) {
					$firstname = trim($_POST["firstname"]);
					$lastname = trim($_POST["lastname"]);
					$position = trim($_POST["position"]);
					$salary = $_POST["salary"];

					//mysqli connection
					$conn = mysqli_connect("localhost", "root", "", "employee_management");

					if(mysqli_connect_error()) {
						//redirect to the add_employee.php if there's an error
						header("location: add_employee.php?error=connecterror");
						exit;
					}
					else {//insert inputted data
						$query = "insert into employee(firstname, lastname, position, salary)
									values('$firstname', '$lastname', '$position', '$salary')";
						mysqli_query($conn, $query);
						//redirect to the add_employee.php if insert is successful
						header("location: add_employee.php?error=none");
						exit;
					}

					mysqli_close($conn);
				}
			?>
			<form method="POST" action="add_employee.php" class="employee-form">
				<ul>
					<li><h2>Add Employee</h2></li>
					<li>
						<input type="text" name="firstname" placeholder="First Name" required>
					</li>
					<li>
						<input type="text" name="lastname" placeholder="Last Name" required>
					</li>
					<li>
						<input type="text" name="position" placeholder="Position" required>
					</li>
					<li>
						<input type="number" step="0.01" min="0" lang="en" name="salary" placeholder="Salary" required>
					</li>
					<li>
						<?php 
							if(isset($_GET["error"])) {
								if($_GET["error"] == "none") {
									//display message
									echo "<p>Employee Added Successfully!</p>";
								}
								if($_GET["error"] == "connecterror") {
									//display message
									echo "<p class='error-msg'>MySQL Connetion Error!</p>";
								}
							}
						?>
					</li>
					<li style="margin-top: 25px;">
						<button type="submit" name="add" class="gen-btn"><i class="fa-solid fa-user"></i> &nbsp; Add Employee</button>

				</ul>	
			</form>

		</div>
	</div>
<?php
	include_once 'footer.php';// reuse footer
?>