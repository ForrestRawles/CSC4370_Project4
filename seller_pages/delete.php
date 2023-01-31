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

if (isset($_POST['delete'])) {
    $email = $_SESSION['use'];
    $sql = "SELECT * FROM properties WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    foreach($result as $row) {
            if($row['street'] == $_POST['delete']) {
                $delete =  $row['street'];
                $sql = "DELETE FROM properties WHERE street = '$delete'";
        }
    }
} else {
    echo "error";
}
?>
<html>
<form action="sellermain.php" method="post">
    <button type="submit" name="submit" value="Add Realestate">Back</button>
    </form>
</html>