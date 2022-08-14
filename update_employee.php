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
	<title>Update Employee | Employee Management</title>

<?php
	include_once 'header.php';// reuse header

	$active = "updt";// for the side menu css
?>

	<div class="employee-container">
		<?php 
			include_once 'side_menu.php';// reuse side menu
		?>
		
		<div class="employee-wrapper">
			<div class="employee-form">
				<ul>
					<li><h2>Update Employee</h2></li>
					<li>
						<?php
							$conn = mysqli_connect("localhost", "root", "", "employee_management");
							//check if theres a connection
							if(mysqli_connect_error()) {
								//redirect to the update_employee.php if there's an error
								header("location: update_employee.php?error=connecterror");
								exit;
							}
							else {
								$records = mysqli_query($conn, "select * from employee order by firstname");
								//header
								if(mysqli_num_rows($records) > 0) {
									echo"<table>";
									echo "	<thead>";
									echo "		<tr>";
									echo "			<th style='width: 7%;'>ID</th>";
									echo "			<th style='width: auto;'>First Name</th>";
									echo "			<th style='width: auto;'>Last Name</th>";
									echo "			<th style='width: 17%;'>Position</th>";
									echo "			<th style='width: 17%;'>Salary</th>";
									echo "			<th style='width: 14%;'>Action</th>";
									echo "		</tr>";
									echo "	</thead>";
									echo "<tbody>";
									//display all items
									while ($row=mysqli_fetch_assoc($records)) {
										if(isset($_GET["editedid"])){ 
											if($_GET["editedid"] == $row["id"]){ 
												echo "<tr style='background-color: #ddd;'>";
											} 
											else {
												echo "<tr>";
											} 
										}
										else {
											echo "<tr>";
										};
										echo "	<td>".$row["id"]."</td>";
										echo "	<td>".$row["firstname"]."</td>";
										echo "	<td>".$row["lastname"]."</td>";
										echo "	<td>".$row["position"]."</td>";
										echo "	<td>₱ ".$row["salary"]."</td>";
										echo "	<td><a href='edit.php?id=".$row["id"]."' class='edit-btn'><i class='fa-solid fa-pen'></i> Edit</a></td>";
										echo "</tr>";
									}
									echo "</tbody>";
								echo "</table>";
									echo "<p style='width: 80%'>List of all item records from employee table in [employee_management] Database.</p>";
									mysqli_free_result($records);
								}
								else {
									echo"<p class='error-msg' style='width: 80%'>No records found</p>";
								}
								//close
								mysqli_close($conn);
							}
						?>
					</li>
					<li>
						<?php 
							if (isset($_GET["error"])) {
								if($_GET["error"] == "none") {
									echo"<p style='width: 80%'>Employee (ID: ". $_GET['editedid'] . ") updated successfully!</p>";
								}
							}
						?>			
					</li>
				</ul>
			</div>		
		</div>
	</div>

<?php
	include_once 'footer.php';// reuse footer
?>