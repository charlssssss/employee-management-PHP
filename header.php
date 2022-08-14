	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/employee.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/05f5e3eb98.js" crossorigin="anonymous"></script>
</head>
<body>
	<div class="top-bar-container">
		<div class="top-bar">
			<?php
				echo "<a href='home.php' class='home-btn'><i class='fa-solid fa-house'></i></a><p>Welcome ".$_SESSION["username"]."!</p>";
				echo "<a href='logout.php' class='logout-btn'>Log out &nbsp; <i class='fas fa-sign-out-alt'></i></a>";
			?>	
		</div>
	</div>