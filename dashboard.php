<?php

   session_start();
   if(!isset($_SESSION['email'])) {
   	header('Location: login.php');
   }

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   	session_unset();
   	session_destroy();
   	header('Location: login.php');
   }    
?>


<!DOCTYPE html>
<html>
<head>
	<title>dashboard</title>

	<!-- styles -->
	<link rel= "stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel= "stylesheet" type="text/css" href="assets/css/main.css">
</head>
<body>

	<!-- header -->
	<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light w-100" >
			<a class="navbar-brand" href="#">
				<img src="assets/images/logo.png" alt="logo">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent justify-content-between" >
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link"  href="#">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Gallery</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="create.php">Create Albums</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="login.php">Logout</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="register.php">Register</a>
					</li>
				</ul>
			</div>
		</nav>
	</header>

	<form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
		<input type="submit" name="submit" value="Logout">
	</form>

	<!-- scripts -->
	<script src="assets/js/jquery-3.5.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>

</body>
</html>