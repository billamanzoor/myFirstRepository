<?php

   session_start();
   if(!isset($_SESSION['email'])) {
    header('Location: ../../login.php');
   }

  // Turn off all error reporting
  error_reporting(0);

  $msg = "";
  $email = "";
  $id = "";
  $albumname = $accesstype = $imagename = $file = "";
  $albumnameErr = $accesstypeErr = $imagenameErr = $fileErr = $fileToUpload = "";

  if(isset($_POST['submit'])){

    include '../../config/connect.php';

    if (empty($_POST["albumname"])) {
      $albumnameErr = "Album name is required";
    } else {
      $albumname = $_POST['albumname'];
    }

    if (empty($_POST["accesstype"])) {
      $accesstypeErr = "Access type is required";
    } else {
      $accesstype = $_POST['accesstype'];
    }

    $email = $_SESSION['email'];

    $fileToUpload = $_FILES["fileToUpload"];

    $imagename = $fileToUpload['name'];

    define ('SITE_ROOT', 'C:\xampp\htdocs\gallery-app\uploads\\');

    $target_dir = SITE_ROOT;

    $uniquesavename=time().uniqid(rand());

    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    $uploadOk = 1;

    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(!empty($albumname) && !empty($accesstype) && !empty($imagename)){
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo $target_file;
        echo "The file has been uploaded.";

        $slquery = "SELECT id FROM users WHERE email = '$email'";

        $selectresult = mysqli_query($conn, $slquery);

          if(mysqli_num_rows($selectresult)>0) {
            $row = mysqli_fetch_assoc($selectresult);
            $id = $row['id'];
          

            $albumInsertQuery = "INSERT INTO `albums` (`u_id`, `name`, `access_type`, `image_name`) VALUES ('$id', '$albumname', '$accesstype', '$imagename');";
    

            $albumInsertQueryResponse = mysqli_query($conn, $albumInsertQuery);

            if ($albumInsertQueryResponse){
              $msg = "Album created successfully!";
            } else {
              $msg = "Error: " . $albumInsertQueryResponse . "<br>" . $conn->error;
            }
          }
      } else {
        echo "Sorry, there was an error uploading your file.";
      }

      // Check if file already exists
      if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
      }
      // Check file size
      if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
      }

      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        } else {
          echo "Sorry, there was an error uploading your file.";
        }
          }

  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,700;1,500&display=swap" rel="stylesheet">

  <title>Create - Album</title>

  <!-- styles -->
  <link rel= "stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css">
  <link rel= "stylesheet" type="text/css" href="../../assets/css/toastr.min.css">
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
        <div class="outline-content pt-5">
          <div class=" d-flex justify-content-between align-items-center px-2 mb-5">
            <h1>CREATE ALBUM</h1>
          </div>
          <div class="container">
            <form class="form-group"  action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="albumname">ALBUM NAME</label>
                <input type="album" name="albumname" class="form-control">
                <span class="text-danger"><?php echo $albumnameErr; ?></span>
              </div>
              <div class="form-group">
                <label for="accesstype">ACCESS TYPE</label>
                <select class="form-control" id="accesstype" name="accesstype">
                  <option value="">Select access type</option>
                  <option value="1">Public</option>
                  <option value="2">Private</option>
                </select>
                <span class="text-danger"><?php echo $accesstypeErr; ?></span>
              </div>
              <div class="form-group">
                <label for="file">File Upload</label>
                <input type="file" name="fileToUpload" class="form-control"  id="file">
                <span class="text-danger"><?php echo $fileErr; ?></span>
              </div>
              <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Submit" name="submit">
              </div>
            </form>
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
  <script src="../../assets/js/jquery-3.5.1.min.js"></script>
  <script src="../../assets/js/popper.min.js"></script>
  <script src="../../assets/js/bootstrap.min.js"></script>
  <script src="../../assets/js/toastr.min.js"></script>
  <script src="../../assets/js/all.min.js"></script>
  <script src="../../assets/js/custom.js"></script>
  <script type="text/javascript">
    $(function(){
      var msg = '<?php echo $msg; ?>';
      if (msg) {
        toastr.success(msg);
      }
    })
  </script>
</body>
</html>
