<!DOCTYPE html>
<html>
<head>
	<title>Bootstrap Form</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
</style>
	<script>
		function checkPasswordStrength() {
			var password = $("#password").val();
			var result = zxcvbn(password);
			var strength = result.score;
			var message = "";

			if (strength == 0) {
				message = "Password strength: Very weak";
			} else if (strength == 1) {
				message = "Password strength: Weak";
			} else if (strength == 2) {
				message = "Password strength: Fair";
			} else if (strength == 3) {
				message = "Password strength: Good";
			} else if (strength == 4) {
				message = "Password strength: Strong";
			}

			$("#password-strength").html(message);
		}
        function validatePasswordMatch() {
			var password = $("#password").val();
			var confirm_password = $("#confirm-password").val();

			if (password != confirm_password) {
				$("#confirm-password").addClass("is-invalid");
				$("#password-match-error").removeClass("d-none");
			} else {
				$("#confirm-password").removeClass("is-invalid");
				$("#password-match-error").addClass("d-none");
			}
		}
	</script>
</head>
<body>

	<?php require '../resources/compnav.php' ?>
    <div class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
  <div class="w3-content">

	    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $cname = $_POST['cname'];
        $phone = $_POST['phone'];


        $servername = "localhost";
$username = "root";
$password = "";
$database = "psystem";

// Create a connection
$conn = mysqli_connect($servername, $username, $password,$database);
// Die if connection was not successful

$sql = "insert into company(cname,phone,email,pass) values('$cname','$phone','$email','$pass')";
$result = mysqli_query($conn,$sql);
if($result){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>You are Successfully Registered! Now you can login</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>';
}else{
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Registration Failed</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>';
}
        
      // Submit these to a database
    }
    ?>

		<h2>Company Registration</h2>
		<form action="/psystem/company/signup.php" method="post">
			<div class="form-group">
				<label for="cname">Company Name:</label>
				<input type="text" class="form-control" id="cname" placeholder="Enter Comp. Name" required name="cname">
			</div>
			<div class="form-group">
				<label for="phone">Contact No:</label>
				<input type="tel" id="phone" name="phone" class = "form-control" required pattern="[0-9]{10}" placeholder="Enter Contact No.">
			</div>
			<div class="form-group">
				<label for="email">Email:</label>
				<input type="email" class="form-control" id="email" placeholder="Enter Email" required name="email">
				<div class="invalid-feedback">Please enter a valid email address.</div>
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input type="password" class="form-control" id="password" placeholder="Enter Password" required onkeyup="checkPasswordStrength();" name="password">
				<div id="password-strength"></div>
			</div>
			<div class="form-group">
				<label for="confirm-password">Confirm Password:</label>
				<input type="password" class="form-control" id="confirm-password" placeholder="Confirm Password" required onkeyup="validatePasswordMatch();">
				<div class="invalid-feedback">Passwords do not match.</div>
			</div>
			<button type="submit" class="btn btn-primary">SignUp</button>
		</form>
	</div>
</div>
</body>
</html>