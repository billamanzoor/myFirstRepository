<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Register</title>

	<!-- styles -->
	<link rel= "stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel= "stylesheet" type="text/css" href="assets/css/toastr.min.css">
	<link rel= "stylesheet" type="text/css" href="assets/css/main.css">

	<script src="assets/js/jquery-3.5.1.min.js"></script>
	<script src="assets/js/toastr.min.js"></script>
</head>
<body>

	<?php
	$response = "";
	$name = $email = $pswd = $conformpswd = $gender = "";
	$nameErr = $emailErr = $pswdErr =$conformpswdErr = $genderErr = "";

	if(isset($_POST['submit'])){
		if (empty($_POST["name"])) {
			$nameErr = "Name is required";
		}else {
			$name = $_POST['name'];
		}

		if (empty($_POST["email"])) {
			$emailErr = "Email is required";
		}else {
			$email = $_POST['email'];
		}

		if (empty($_POST["password"])) {
			$pswdErr = "password is required";
		}else {
			$pswd = $_POST['password'];
		}
			$conformpswdErr = "conformPassword is required";
		

		if (empty($_POST["conformpassword"])) {
		}else {
			$conformpswd = $_POST['conformpassword'];
		}

		if (empty($_POST["gender"])) {
			$genderErr = "gender is required";
		}else {
			$gender = $_POST['gender'];
		}

		if ($pswd  != $conformpswd){
			echo "<script>toastr.error('Password do not match! Try again.');</script>";
		} else {
			$pswd = md5($pswd);
			if(!empty($name) && !empty($email) && !empty($pswd) && !empty($gender)){

			include 'config/connect.php';

			$slquery = "SELECT * FROM users WHERE email = '$email'";
			$selectresult = mysqli_query($conn, $slquery);

			if(mysqli_num_rows($selectresult)>0)
				{
					$msg = 'email already exists';
				}

				$query = "INSERT INTO users (name, email, password, gender) VALUES ('".$name."', '".$email."', '".$pswd."', '".$gender."');";

				if ($conn->query($query) === TRUE ){
					$response = "User Registered Successfully!";
				} else{
					$response = "Error: " . $query . "<br>" .$conn->error;
				}
			}
		}
	}
	?>

	<!-- form -->
	<div class="container">
		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
			<div class="form-group">
				<h1 class="text-center mt-5">Register</h1>
				<label for="name">Name</label>
				<input type="text" class="form-control" name="name" id="name" placeholder="Enter the name">
				<?php if(!empty($nameErr)){ ?>
					<span class="text-danger"><?php echo $nameErr; ?></span>
				<?php } ?>
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" name="email" id="email" placeholder="Enter the email">
				<?php if(!empty($emailErr)){ ?>
					<span class="text-danger"><?php echo $emailErr; ?></span>
				<?php } ?>
			</div>
			<div class="form-group">
				<label for="gender">Gender</label><br>
				<input type="radio" id="male" name="gender" value="0">
				<label for="male">Male</label><br>
				<input type="radio" id="female" name="gender" value="1">
				<label for="female">Female</label><br>
				<input type="radio" id="other" name="gender" value="2">
				<label for="other">Other</label>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" name="password" id="password" placeholder="password">
				<?php if(!empty($pswdErr)){ ?>
					<span class="text-danger"><?php echo $pswdErr; ?></span>
				<?php } ?>
			</div>
			<div class="form-group">
				<label for="confirmpassword">Conform Password</label>
				<input type="password" class="form-control" name="conformpassword" id="conformpassword" placeholder="conformpassword">
				<?php if(!empty($pswdErr)){ ?>
					<span class="text-danger"><?php echo $pswdErr; ?></span>
				<?php } ?>
			</div>
			<div class="form-group">
				<input type="submit" name="submit" value="sign in">
			</div>
		</form>
		<p>Already a member? <a href="login.php">Sign in</a></p>
	</div>


	<!-- scripts -->
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	
	<script src="assets/js/custom.js"></script>

	<?php if(!empty($response)){ ?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				toastr.success('<?php echo $response; ?>');
			});
		</script>
	<?php } ?>
</body>
</html>