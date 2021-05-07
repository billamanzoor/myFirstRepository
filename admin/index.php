<?php

   session_start();
   if(!isset($_SESSION['email'])) {
    header('Location: ../login.php');
   }

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_unset();
    session_destroy();
    header('Location: ../index.php');
   }    
?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,700;1,500&display=swap" rel="stylesheet">

	<title>Gallery - Dashboard</title>

	<!-- styles -->
	<link rel= "stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
  <link rel= "stylesheet" type="text/css" href="../assets/css/all.min.css">
	<link rel= "stylesheet" type="text/css" href="../assets/css/main.css">
</head>
<body>

	<!-- header -->
  <header class="bg-dark border-bottom">
    <div class="container">
      <nav class="navbar navbar-expand-lg w-100 justify-content-between">
        <a class="navbar-brand" href="#">
          <img src="../assets/images/d95e7727f38713bbcd88a7c4b23090ee.jpg" alt="logo">
        </a>
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link text-white" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">Faq</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">DropDown</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Profile</a>
              <a class="dropdown-item" href="#">Setting</a>
              <div class="dropdown-divider"></div>
              <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                <input type="submit" name="submit" class="ml-3" value="Logout">
              </form>
            </div>
          </li>  
        </ul>
      </nav>
    </div>
  </header>

  <div class="container-fluid h-100">
    <div class="row vh-100">
      <div class="col-md-3 px-0 vh-100">
        <div class="py-5 bg-dark h-100">
          <ul class="list-unstyled d-flex flex-column ml-5">
            <li class="mb-3">
              <a href="/admin/" class="text-white">
                <strong>Dashboard</strong>
              </a>
            </li>
            <li class="mb-3">
              <a href="/admin/album/" class="text-white">
                <strong>View Albums</strong>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-9 px-0">
        <div class="images-wrapper py-5">
          <div class=" d-flex justify-content-between align-items-center px-5">
                        <h1>ALL ALBUMS</h1>
                        <a href="http://gallery-app.localhost/admin/album/create.php"><i class="fas fa-plus"></i>CREATE ALBUM</a>
                    </div>
          <h2 class="mb-3 text-center">Private Images</h2>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-4 mb-4">
                <img src="../assets/images/image1.jpg" alt="image1" class="img-thumbnail">
              </div>
              <div class="col-md-4 mb-4">
                <img src="../assets/images/image1.jpg" alt="image1" class="img-thumbnail">
              </div>
              <div class="col-md-4 mb-4">
                <img src="../assets/images/image1.jpg" alt="image1" class="img-thumbnail">
              </div>
              <div class="col-md-4 mb-4">
                <img src="../assets/images/image1.jpg" alt="image1" class="img-thumbnail">
              </div>
              <div class="col-md-4 mb-4">
                <img src="../assets/images/image1.jpg" alt="image1" class="img-thumbnail">
              </div>
              <div class="col-md-4 mb-4">
                <img src="../assets/images/image1.jpg" alt="image1" class="img-thumbnail">
              </div>
            </div>
          </div>
        </div>
        <div class="images-wrapper pb-5">
          <h2 class="mb-3 text-center">Public Images</h2>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-4 mb-4">
                <img src="../assets/images/image2.jpeg" alt="image2" class="img-thumbnail">
              </div>
              <div class="col-md-4 mb-4">
                <img src="../assets/images/image2.jpeg" alt="image2" class="img-thumbnail">
              </div>
              <div class="col-md-4 mb-4">
                <img src="../assets/images/image2.jpeg" alt="image2" class="img-thumbnail">
              </div>
              <div class="col-md-4 mb-4">
                <img src="../assets/images/image2.jpeg" alt="image2" class="img-thumbnail">
              </div>
              <div class="col-md-4 mb-4">
                <img src="../assets/images/image2.jpeg" alt="image2" class="img-thumbnail">
              </div>
              <div class="col-md-4 mb-4">
                <img src="../assets/images/image2.jpeg" alt="image2" class="img-thumbnail">
              </div>
            </div>
          </div>
        </div>

        <!-- Footer -->
                <footer class="bg-dark py-4">
                    <div class="container-fluid">
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
              </div>
            </div>
          </div>

  <!-- scripts -->
	<script src="../assets/js/jquery-3.5.1.min.js"></script>
	<script src="../assets/js/popper.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/all.min.js"></script>
	<script src="../assets/js/custom.js"></script>
</body>
</html>