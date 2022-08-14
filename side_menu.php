<div class="side-menu-wrapper">
			<div id="side-menu">
				<h3>Main Menu</h3>
				<a href="add_employee.php">
					<div class='side-box <?php echo ($active == "add") ? "active" : "" ; ?>'>
						<i class="fa-solid fa-user-plus"></i>
						<p>Add</p>
					</div>
				</a>
				<a href="search_employee.php">
					<div class='side-box <?php echo ($active == "srch") ? "active" : "" ; ?>'>
						<i class="fa-solid fa-magnifying-glass"></i>
						<p>Search</p>
					</div>
				</a>
				<a href="list_employee.php">
					<div class='side-box <?php echo ($active == "list") ? "active" : "" ; ?>'>
						<i class="fa-solid fa-list"></i>
						<p>List</p>
					</div>
				</a>
				<a href="update_employee.php">
					<div class='side-box <?php echo ($active == "updt") ? "active" : "" ; ?>'>
						<i class="fa-solid fa-user-pen"></i>
						<p>Update</p>
					</div>
			</a>
			</div>
			<script src="js/javascript.js"></script>
		</div>