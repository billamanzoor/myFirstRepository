<?php

   session_start();
   if(!isset($_SESSION['email'])) {
    /*header('Location: index.php');*/
   }
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>

	<!-- styles -->
	<link rel= "stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel= "stylesheet" type="text/css" href="assets/css/main.css">
</head>
<body>

	<!-- header -->
	<header class="bg-dark border-bottom">
		<div class="container">
			<nav class="navbar navbar-expand-lg w-100 justify-content-between">
				<a class="navbar-brand" href="#">
					<img src="assets/images/d95e7727f38713bbcd88a7c4b23090ee.jpg" alt="logo">
				</a>
				<ul class="navbar-nav">
					<li class="nav-item active">
						<a class="nav-link text-white" href="#">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-white" href="#">Gallery</a>
					</li>
					<form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                <input type="submit" name="submit" class="text-white border-0 bg-transparent mt-2"  value="Logout">
              </form>
				</ul>
			</nav>
		</div>
	</header>

	<!-- slider -->
	<div id="banner-slider" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#banner-slider" data-slide-to="0" class="active"></li>
			<li data-target="#banner-slider" data-slide-to="1"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block w-100" src="assets/images/image1.jpg" alt="First slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="assets/images/image1.jpg" alt="Second slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="assets/images/image1.jpg" alt="Third slide">
			</div>
		</div>
		<a class="carousel-control-prev" href="#banner-slider" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#banner-slider" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>

	<!-- gallery -->
	<div class="gallery">
		<div class="container">
			<h1 class="text-center my-4"> Gallery</h1>
			<div class="row">
				<div class="col-lg-3">
					<img class="img-fluid img-thumbnail" src="assets/images/image1.jpg">
				</div>
				<div class="col-lg-3">
					<img class="img-fluid img-thumbnail" src="assets/images/image1.jpg">
				</div>
				<div class="col-lg-3">
					<img class="img-fluid img-thumbnail" src="assets/images/image1.jpg">
				</div>
				<div class="col-lg-3">
					<img class="img-fluid img-thumbnail" src="assets/images/image1.jpg">
				</div>
				<div class="col-lg-3">
					<img class="img-fluid img-thumbnail" src="assets/images/image1.jpg">
				</div>
				<div class="col-lg-3">
					<img class="img-fluid img-thumbnail" src="assets/images/image1.jpg">
				</div>
				<div class="col-lg-3">
					<img class="img-fluid img-thumbnail" src="assets/images/image1.jpg">
				</div>
				<div class="col-lg-3">
					<img class="img-fluid img-thumbnail" src="assets/images/image1.jpg" alt="">
				</div>
			</div>
		</div>
	</div>

	<!-- footer -->
	<footer class="bg-dark py-4">
		<div class="container">
			<div class="d-flex align-items-center justify-content-between">
				<p><a href="#" class="text-light bg-dark">&copy; Copyright 2020. All rights reserved</a></p>
				<ul class="m-0 list-unstyled d-flex align-items-center justify-content-center">
					<li><a href=""><i class="fab fa-facebook"></i></a></li>
					<li><a href=""><i class="fab fa-instagram"></i></a></li>
					<li><a href=""><i class="fab fa-linkedin"></i></a></li>
					<li><a href=""><i class="fab fa-twitter"></i></a></li>
				</ul>
			</div>
		</div>
	</footer>


	<!-- scripts -->
	<script src="assets/js/jquery-3.5.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/all.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>