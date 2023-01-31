<!DOCTYPE html>
<html lang = en>
<head>
    <title>Check Listings </title>

</head>
<body>

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

$sql = "SELECT * FROM properties";
$result = mysqli_query($conn, $sql);
echo "<table>";

		if ($result->num_rows > 0) {
            foreach($result as $row) {
                echo "<tr>".
                     "<td><b>Seller: </b>".$row['email']."</td>".
                     "</tr>".
                     "<tr>".
                     "<td colspan = 2><b>".$row['street'].", ".$row['city'].", ".$row['state']." ".$row['zipcode']."</b></td>".
                     "</tr>".
                     "<tr>".
                     "<td><b>Pricing: </b>$".$row['price']."</td>".
                     "<td><b># of Bedrooms: </b>".$row['bedrooms']."</td>".
                     "</tr>". 
                     "<tr>".
                     "<td><b>Property Tax: </b>".$row['property_tax']."</td>".
                     "<td><b># of Bathrooms: </b>".$row['bathrooms']."</td>".
                     "</tr>".
                     "<tr>".
                     "<td><b>House Age: </b>".$row['age']."</td>".
                     "<td><b># of Closets: </b>".$row['closets']."</td>".
                     "</tr>".
                     "<tr>".
                     "<td><b>Square Footage: </b>".$row['sqr_foot']."</td>".
                     "<td><b>Garden? </b>".$row['garden']."</td>".
                     "</tr>".
                     "<tr>".
                     "<td><b>Nearby Facilities (in Mi): </b>".$row['nearby_facilities']."</td>".
                     "<td><b>Parking? </b>".$row['parking']."</td>".
                     "</tr>".
                     "<tr>".
                     "<td><b>Nearby Main Roads (in Mi): </b>".$row['nearby_main_roads']."</td>".
                     "<td></td>".
                     "</tr>".
                     "<tr colpan = 3 height = '20px'></tr>";
            }
            echo "</table>";
        }

?>
That's all
</body>