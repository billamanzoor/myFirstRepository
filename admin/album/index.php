<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,700;1,500&display=swap" rel="stylesheet">

	<title>Gallery - Album</title>

	<!-- styles -->
	<link rel= "stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css">
  <link rel= "stylesheet" type="text/css" href="../../assets/css/all.min.css">
	<link rel= "stylesheet" type="text/css" href="../../assets/css/main.css">
</head>
<body>

	<!-- header -->
  <header class="bg-dark border-bottom">
    <div class="container">
      <nav class="navbar navbar-expand-lg w-100 justify-content-between">
        <a class="navbar-brand" href="#">
          <img src="../../assets/images/d95e7727f38713bbcd88a7c4b23090ee.jpg" alt="logo">
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
        <?php
        require('../../script.php');
        ?>

        <div class="container">
          <div class="row">
            <?php 
            if(!empty($fetchImage))
            {
              $sn=1;
              foreach ($fetchImage as $img) {
            ?>

            <div class="column">
              <img src="../../uploads/<?php echo $img['image_name']; ?>" style="width:100%" onclick="openModal(); currentSlide(<?php echo $sn; ?>)" class="hover-shadow cursor">
            </div>
           <?php
           $sn++;}
            }else{
              echo "No Image is saved in database";
            }
            ?>
          </div>
        </div>

        <div id="galleryModal" class="modal">
          <span class="close cursor" onclick="closeModal()">&times;</span>

            <!--======image gallery modal========-->
          <div class="modal-content">
              <?php 
          if(!empty($fetchImage))
          {
            $sn=1;
            foreach ($fetchImage as $img) {
          ?>

          <div class="gallerySlides">
              <div class="numbertext"><?php echo $sn; ?> / 4</div>
              <img src="../../uploads/<?php echo $img['image_name']; ?>" style="width:100%">
            </div>
            <?php
         $sn++;}
          }else{
            echo "No Image is saved in database";
          }
          ?>

             <!--======image gallery model========-->
            
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
            <div class="caption-container">
              <p id="caption"></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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

  <!-- scripts -->
	<script src="../../assets/js/jquery-3.5.1.min.js"></script>
	<script src="../../assets/js/popper.min.js"></script>
	<script src="../../assets/js/bootstrap.min.js"></script>
	<script src="../../assets/js/all.min.js"></script>
	<script src="../../assets/js/custom.js"></script>
</body>
</html>