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
	<title>Search Employee | Employee Management</title>

<?php
	include_once 'header.php';//reuse header

	$active = "srch";//for the side menu css
?>

	<div class="employee-container">
		<?php 
			include_once 'side_menu.php'; //reuse side menu
		?>
		
		<div class="employee-wrapper">
			<form method="POST" action="search_employee.php" class="employee-form">
				<ul>
					<li><h2>Search Employee</h2></li>
					<li>
						Search by:
						<select name="criteria">
							<option value="firstname">First Name</option>
							<option value="lastname">Last Name</option>
						</select>
						:
						<input type="text" name="keyword" required>
						<button type="submit" name="generate" class="gen-btn"><i class="fa-solid fa-gear"></i>&nbsp; Generate</button>		
					</li>
				</ul>
			</form>

			<form method="POST" action="search_employee.php" class="employee-form">
				<ul>
					<li>
					<?php
						$criteria = "";
						$keyword = "";

						if (isset($_POST["generate"])) {
							//connect to database
							$conn = mysqli_connect("localhost", "root", "", "employee_management");

							//check if theres a connection
							if(mysqli_connect_error()) {
								//redirect to the search_employee.php if there's an error
								header("location: search_employee.php?error=connecterror");
								exit;
							}
							else {
								$criteria = trim($_POST["criteria"]);
								$keyword = trim($_POST["keyword"]);

								$records = mysqli_query($conn, "select * from employee where $criteria like '%$keyword%' order by firstname");
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
									echo "			<th style='width: 14%;'><button type='submit' name='delete_selected' value='delete' class='del-btn'><i class='fa-solid fa-user-xmark'></i> &nbsp;Delete</button></th>";
									echo "		</tr>";
									echo "	</thead>";
									echo "<tbody>";
									//display all items
									while ($row=mysqli_fetch_assoc($records)) {
											echo "<tr>";
										echo "	<td>".$row["id"]."</td>";
										echo "	<td>".$row["firstname"]."</td>";
										echo "	<td>".$row["lastname"]."</td>";
										echo "	<td>".$row["position"]."</td>";
										echo "	<td>₱ ".$row["salary"]."</td>";
										echo "	<td align='center'><input type='checkbox' name='id[]' value='".$row["id"]."'></td>";
										echo "</tr>";
									}
									echo "</tbody>";
									echo "</table>";
									echo "<p style='width: 80%'>List of results <i>(where $criteria have '$keyword')</i> from employee table in [employee_management] Database.</p>";
									mysqli_free_result($records);
								}
								else {
									echo"<p class='error-msg' style='width: 80%'>No records found</p>";
								}
								//close
								mysqli_close($conn);
							}
						}
					?>
					</li>
					<li>
						<?php
							if (isset($_POST["delete_selected"])) {
								$id = array();

								if(isset($_POST["id"])) {
									$id = $_POST["id"];
									$conn = mysqli_connect("localhost", "root", "", "employee_management");
									for ($i=0; $i < count($id) ; $i++) { 
										mysqli_query($conn, "delete from employee where id = ".$id[$i]." ");
									}
									mysqli_close($conn);
									echo '<script>alert("Item(s) deleted successfully!")</script>';//success message
									
								}
								else { //error message
									echo "<p class='error-msg' style='width: 80%'>Please select at least one (1) record to be deleted.</p>";
								}
							}			
						?>
					</li>
				</ul>
			</form>
		</div>
	</div>

<?php
	include_once 'footer.php';//reuse footer
?>