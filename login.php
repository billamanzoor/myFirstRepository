<?php

session_start();
if(isset($_SESSION['email'])){
	header('Location: admin/index.php');
}


$email = $password =  $error = "";

include 'config/connect.php';

if (isset($_POST['submit'])) {
$email = stripslashes($_REQUEST['email']);    // removes backslashes
$email = mysqli_real_escape_string($conn, $email);


if (empty($_POST["email"])) {
	$emailErr = "Email is required";
}else {
	$email = $_POST['email'];
}

$password = stripslashes($_REQUEST['password']);
$password = mysqli_real_escape_string($conn, $password);

if (empty($_POST["password"])) {
	$pswdErr = "password is required";
}else {
	$pswd = $_POST['password'];
}

// Check user is exist in the database
$query    = "SELECT * FROM `users` WHERE email='$email'
AND password='" . md5($password) . "'";
$result = mysqli_query($conn, $query) or die(mysql_error());
$rows = mysqli_num_rows($result);
if ($rows == 1) {
	$_SESSION['email'] = $email;

	// Redirect to user dashboard page
	header("Location: admin/index.php");
} else {

	$error = "Invalid email or password";
}
}
?>

<!DOCTYPE html>
<html>
<head>
	<style>
		.loader {
		  border: 16px solid #f3f3f3;
		  border-radius: 50%;
		  border-top: 16px solid #3498db;
		  width: 50px;
		  height: 50px;
		  -webkit-animation: spin 2s linear infinite; /* Safari */
		  animation: spin 2s linear infinite;
		}

		/* Safari */
		@-webkit-keyframes spin {
		  0% { -webkit-transform: rotate(0deg); }
		  100% { -webkit-transform: rotate(360deg); }
		}

		@keyframes spin {
		  0% { transform: rotate(0deg); }
		  100% { transform: rotate(360deg); }
		}
	</style>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login</title>

	<!-- styles -->
	<link rel= "stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel= "stylesheet" type="text/css" href="assets/css/toastr.min.css">
	<link rel= "stylesheet" type="text/css" href="assets/css/main.css">
</head>
<body>



	<!-- form -->
	<div class="container">
	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
		<div class="form-group">
			<h1 class="text-center mt-5">Login</h1>
			<label for="email">Email address</label>
			<input type="email" class="form-control" name="email" id="email" placeholder="email">
			<?php if(!empty($emailErr)){ ?>
				<span class="text-danger"><?php echo $emailErr; ?></span>
				<?php } ?>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" name="password" id="password" placeholder="enter password">
				<?php if(!empty($passwordErr)){ ?>
					<span class="text-danger"><?php echo $passwordErr; ?></span>
					<?php } ?>
				</div>
				<div class="form-group form-check">
					<input type="checkbox" class="form-check-input" id="dropdowncheck">
					<label class="form-check-label" for="dropdowncheck">Remember me</label>
				</div>
				<div class="form-group">
					<input type="submit" name="submit">
				</div>
			</form>
			<div>
				<p>New around here? <a href="register.php">Register</a></p>
			</div>
			<p><a href="#" data-toggle="modal" data-target="#reset-password-modal">Forgot password?</a></p>
		</div>

		<!-- Modal -->
  <div class="modal fade" id="reset-password-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
  		<div class="modal-content">
  			<div class="modal-header">
  				<h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
  				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  					<span aria-hidden="true">&times;</span>
  				</button>
  			</div>
  			<div class="modal-body">
  				<form action=''  id='reset-form' method='post' name='reset'>
  					<div class="form-group">
  						<label for="email">Email</label>
  						<input type='email' name='email'/>
  					</div>
  					<div class="form-group">
  						<input type='submit' name='reset-password' value='Submit'/>
							<div class="loader m-3 d-none"></div>
  					</div>
  				</form>
  			</div>
  		</div>
  	</div>
  </div>
	

		<!-- scripts -->
	<script src="assets/js/jquery-3.5.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/toastr.min.js"></script>
	<script src="assets/js/custom.js"></script>


	 <script type="text/javascript">
	 	jQuery(document).ready(function($){
	 		$('#reset-form').submit(function(e){
	 			e.preventDefault();
	 			$data = $(this).serializeArray();
	 			$reset_email = $data[0]['value'];
	 			if (!$reset_email) {
	 				$('#reset-password-modal form span.error').text('Email is required');
	 			} else {
	 				$('#reset-password-modal form span.error').text('');

	 				$.ajax({
	 					method: 'POST',
	 					url: 'app_logic.php',
	 					dataType: "JSON",
	 					data: {
	 						email: $reset_email,
	 					},
	 					beforeSend: function(){
	 						$('#reset-password-modal form .loader').removeClass('d-none');
	 					},
	 					
	 					success: function(data){
	 						data = "The email sent your gmail";
	 								toastr.success(data);
	 						$('#reset-password-modal form .loader').addClass('d-none');
	 					}
	 				});
	 			}
	 		});
	 	});
	 	</script>

	 	<?php if(!empty($error)){ ?>
	 		<script type="text/javascript">
	 			jQuery(document).ready(function($){
	 				toastr.error('<?php echo $error; ?>');
	 			});
	 			</script>
	 			<?php } ?>
	 		</body>
	 		</html>