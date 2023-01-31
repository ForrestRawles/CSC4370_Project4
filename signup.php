<?php 

$host = "localhost";
$user = "frawles2";
$pass = "frawles2";
$dbname = "frawles2";

$conn = new mysqli($host, $user, $pass, $dbname);

if($conn->connect_error){
	echo "Could not connect ot server\n";
	die("Connection failed: ".$conn->conneect_error);
}

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$firstName = $_POST['first'];
	$lastName = $_POST['last'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$passwordCheck = md5($_POST['passwordCheck']);
	$userType = $_POST['role'];

	if ($password == $passwordCheck) {
		$sql = "SELECT * FROM user WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			if ($userType == "buyer") {
				$sql = "INSERT INTO user (user_first, user_last, username, email, password, buyer)
						VALUES ('$firstName', '$lastName', '$username', '$email', '$password', '$userType')";
			} else {
				$sql = "INSERT INTO user (user_first, user_last, username, email, password, seller)
						VALUES ('$username', '$firstName', '$lastName', '$email', '$password', '$userType')";
			}
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('User Registration Completed.')</script>";
				$username = "";
				$email = "";
				$firstName = "";
				$firstName = "";
				$_POST['password'] = "";
				$_POST['passwordCheck'] = "";
				header("Location: login.php");
			} else {
				echo "<script>alert('Woops! Something Went Wrong.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Email Already Exists.')</script>";
		}	
	} else {
		echo "<script>alert('Password Not Matched.')</script>";
	}
}
?>

<!doctype html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<title>Assignment Demo</title>
	<link href="signup_style.css" type="text/css" rel="stylesheet">
</head>

<body>
<div class="landingPageBar">
        <div class="appName">Cornerstone</div>
		<div>
            <form method="POST" action="home.html">
                <button type="submit" name="home" id="home" value="Return Home" class="returnHomeButton">Home</button>
            </form>
        </div>
    </div>
	<div class="signup">
	<div class="signup_form">
	<form method="post" action="" name="signup-form">
			<div class="brand-logo"></div>
            <div class="brand-title">Application Name</div>
			<div>
				<label>Username:</label>
				<input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
				<br>
				<label>First Name:</label>
				<input type="text" name="first" required />
				<br>
				<label>Last Name:</label>
				<input type="text" name="last" required />
				<br>
				<label>Email:</label>
				<input type="email" name="email" required />
				<br>
				<label>Password:</label>
				<input type="password" name="password" required />
				<br>
				<label>Confirm Password:</label>
				<input type="text" name="passwordCheck" required />
				<br>
				<input name="role" type="radio" value="buyer" > Buyer 
				<input name="role" type="radio" value="seller"> Seller 
			</div>
			<button type="submit" name="submit" value="submit" class="signup_button">Register</button>
		</form>
	</div>
	</div>
</body>

</html>