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
	<title>Edit Employee | Employee Management</title>

<?php
	include_once 'header.php';// reuse header

	$active = "updt";// for the side menu css
?>

	<div class="employee-container">
		<?php 
			include_once 'side_menu.php';// reuse side menu
		?>
		
		<div class="employee-wrapper">
			<?php
				$id = "";
				$firstname = "";
				$lastname = "";
				$position = "";
				$salary = "";

				if(isset($_GET["id"])) {
					$id = $_GET["id"];

					$conn = mysqli_connect("localhost", "root", "", "employee_management");

					if(mysqli_connect_error()) {
						echo"<p>Error in connecting database...</p>";
					}
					else {
						$query = "select * from employee where id = $id";

						$record = mysqli_query($conn, $query);

						if (mysqli_num_rows($record) > 0) {
							while ($row=mysqli_fetch_assoc($record)) {
								$firstname = $row["firstname"];
								$lastname = $row["lastname"];
								$position = $row["position"];
								$salary = $row["salary"];
							}
						}
						else {
							//redirect to the update_employee.php if there's an error
							header("location: update_employee.php?error=recordnotexist");
							exit;
						}
					}
				}	

				if(isset($_POST["save_changes"])) {
					$firstname = $_POST["firstname"];
					$lastname = $_POST["lastname"];
					$position = $_POST["position"];
					$salary = $_POST["salary"];

					//mysqli connection
					$conn = mysqli_connect("localhost", "root", "", "employee_management");

					//check if establish connection to database
					if(mysqli_connect_error()) {
						//redirect to the add_employee.php if there's an error
						header("location: add_employee.php?error=connecterror");
						exit;
					}
					else {
						$query = " update
										employee
								   set
										firstname = '".$firstname."',
										lastname = '".$lastname."',
										position = '".$position."',
										salary = ".$salary."
								   where
										id = ".$id."
								   ";
								   
						mysqli_query($conn, $query);
						//redirect to the update_employee.php if insert is successful
						header("location: update_employee.php?error=none&editedid=$id");
						exit;
					}
					//close connection
					mysqli_close($conn);
				}
			?>
			<form method="POST" acton="edit.php" class="employee-form">
				<ul>
					<li><h2>Update Employee</h2></li>
					<li>
						<input type="text" value="ID: <?php echo $id; ?>" disabled>
					</li>
					<li>
						<input type="text" name="firstname" placeholder="First Name" value="<?php echo $firstname; ?>" required>
					</li>
					<li>
						<input type="text" name="lastname" placeholder="Last Name" value="<?php echo $lastname; ?>" required>
					</li>
					<li>
						<input type="text" name="position" placeholder="Position" value="<?php echo $position; ?>" required>
					</li>
					<li>
						<input type="number" step="0.01" min="0" lang="en" name="salary" placeholder="Salary" value="<?php echo $salary; ?>" required>
					</li>
					<li>
						<?php 
							if(isset($_GET["error"])) {
								if($_GET["error"] == "none") {
									//display message
									echo "<p>Employee Updated Successfully!</p>";
								}
								if($_GET["error"] == "connecterror") {
									//display message
									echo "<p class='error-msg'>MySQL Connetion Error!</p>";
								}
							}
						?>
					</li>
					<li style="margin-top: 25px;">
						<button type="submit" name="save_changes" <?php echo ($id == "") ? "disabled" : ""; ?> class='gen-btn'><i class="fa-solid fa-floppy-disk"></i>&nbsp; Save Changes</button>
					</li>
				</ul>	
			</form>
		</div>
	</div>

<?php
	include_once 'footer.php'; // reuse footer
?>