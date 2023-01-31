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

if (isset($_POST['email'], $_POST['password'])) {
    echo '<script type="text/javascript"> console.log("no values");</script>';
	$email = $_POST['email'];
	$password = substr(md5($_POST['password']),0,20);
    if ($email != "" && $password != "") {
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    echo $result->num_rows;
    if ($result->num_rows > 0) {
        echo '<script type="text/javascript"> console.log("stopping point?");</script>';
        foreach ($result as $line){
            if ($password == $line['password']) {
                echo '<script type="text/javascript"> console.log("here?");</script>';
                if($line['seller'] != null) {
                    $_SESSION['use']=$email;
                    header("Location: seller_pages/sellermain.php");
                    exit();
                }
                else if($line['buyer'] != null){
                    $_SESSION['use']=$email;
                    header("Location: buyer_pages/buyermain.php");
                    exit();
                }
                else{
                    $_SESSION['use']=$email;
                    header("Location: admin_pages/admin.php");
                    exit();
                }
        } 
        }
    }
    }
}
else{
    echo '<script type="text/javascript"> console.log("failed login");</script>';
}
?>

<DOCTYPE! html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link href="login_style.css" type="text/css" rel="stylesheet">
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
    <div class="login">
    <div class="login_form">
		<form method="post" name="login-form">
            <div class="brand-logo"></div>
            <div class="brand-title">Application Name</div>
			<div class="inputs">
				<label>Email:</label>
				<input type="text" name="email" required placeholder="Email"/>
				<br>
				<label>Password:</label>
				<input type="password" name="password" required placeholder="Password"/>
				<br>
			</div>
			<button type="submit" name="submit" value="submit" class="login_button">Login</button>
		</form>
	</div>
    </div>
    </body>
</html>