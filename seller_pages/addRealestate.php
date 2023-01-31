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

if(isset($_POST["submit"])) {
    if (isset($_POST['submit'])) {
        if ($_POST['location'] != "") {
            $street = $_POST['location'];
            $city = $_POST['city'];
            $state = strtoupper($_POST['state']);
            $zip = $_POST['zipcode'];
            $price = $_POST['price'];
            $age = $_POST['age'];
            $sqr_foot = $_POST['size'];
            $bedrooms = $_POST['bed'];
            $bathrooms = $_POST['bath'];
            $closets = $_POST['closets'];
            $garden = $_POST['garden'];
            $parking = $_POST['parking'];
            $nearby_facilities = $_POST['facility'];
            $nearby_main_roads = $_POST['road'];
            $property_tax = $_POST['price'] * .07; //property tax is 7% of house price
            $email = $_SESSION['use']; //use session to store login email
            $img = $_POST['image'];

            $sql = "SELECT * FROM properties WHERE street = '$street'";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows < 1) {
                $sql = "INSERT INTO properties (street, city, state, zipcode, price, age, sqr_foot, bedrooms, bathrooms, closets, garden, 
                                    parking, nearby_facilities, nearby_main_roads, property_tax, email, img)
                        VALUES ('$street', '$city', '$state', '$zip','$price', '$age', '$sqr_foot', '$bedrooms', '$bathrooms', '$closets', '$garden', '$parking',
                                        '$nearby_facilities', '$nearby_main_roads', '$property_tax', '$email', '$img')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo "<script type='text/javasript'>window.open('sellermain.php', '_self');</script>";
                    echo "<script>alert('Realestate Information Saved Successfully.')</script>";
                    $street = "";
                    $city = "";
                    $state = "";
                    $zip = "";
                    $price = "";
                    $age = "";
                    $sqr_foot = "";
                    $bedrooms = "";
                    $bathrooms = "";
                    $closets = "";
                    $nearby_facilities = "";
                    $nearby_main_roads = "";
                    $img = "";
                } else {
                    echo "<script>alert('Woops! Something Went Wrong.')</script>";
                }
            } else {
                echo "<script>alert('Cannot Use This Address.')</script>";
            }
        } else {
            echo "<script>alert('Please enter an Address.')</script>";
        }
    }
}
?>

<!doctype html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<title>Assignment Demo</title>
    <link rel = "stylesheet" href = "seller_css.css">
</head>

<body>
    <div class="landingPageBar">
        <div class="appName">Cornerstone</div>
        <div class="logoutButton">
            <form method="POST" action="../home.html">
                <button type="submit" name="logout" id="logout" value="Logout" class="addButton">Logout</button>
            </form>
        </div>
    </div>
    <div class="mainGroup">
        <div class = "registration">
            <form method="post" action="" name="signup-form">
                <div>
                    <table>
                    <tr>
                        <td><label>Street Address:</label></td>
                        <td><input type="text" name="location" required /></td>
                    </tr>
                    <tr>
                        <td><label>City:</label></td>
                        <td><input type="text" name="city" required /></td>
                    </tr>
                    <tr>
                        <td><label>State:</label></td>
                        <td><input type="text" name="state" maxlength="2" required /></td>
                        </tr>
                    <tr>
                        <td><label>Zipcode:</label></td>
                        <td><input type="text" name="zipcode" maxlength="5" required /></td>
                    </tr>
                    <tr>
                        <td><label>Price:</label></td>
                        <td><input type="text" name="price" required /></td>
                    </tr>
                    <tr>
                        <td><label>Home's Age:</label></td>
                        <td><input type="text" name="age" maxlength="3"required /></td>
                    </tr>
                    <tr>
                        <td><label>Square Footage:</label></td>
                        <td><input type="text" name="size" required /></td>
                    </tr>
                    <tr>
                        <td><label>Num of Bedrooms:</label></td>
                        <td><input type="text" name="bed" required /></td>
                    </tr>
                    <tr>
                        <td><label>Num of Bathrooms:</label></td>
                        <td><input type="text" name="bath" required /></td>
                    </tr>
                    <tr>
                        <td><label>Num of Closets:</label></td>
                        <td><input type="text" name="closet" required /></td>
                    </tr>
                    <tr>
                        <td><label>Nearest Facility (in Miles):</label></td>
                        <td><input type="text" name="facility" required /></td>
                    </tr>
                    <tr>
                        <td><label>Nearest Main Road (in Miles):</label></td>
                        <td><input type="text" name="road" required /></td>
                    </tr>
                    <tr>
                        <td><label>Garden: </label></td>
                        <td><input name="garden" type="radio" value='Yes' >  Yes <input name="garden" type="radio" value='No'> No </td>
                    </tr>
                    <tr>
                        <td><label>Parking: </label></td>
                        <td><input name="parking" type="radio" value='Yes' > Yes <input name="parking" type="radio" value='No'> No </td>
                    </tr>
                    <tr>
                        <td><label>Upload Image Link (URL Only):</label></td>
                        <td><input type="text" name="image" id="image" required /></td>
                    </tr>
                    </table>
                </div>
                <button class="addButton" style = "text-align: center;" type="submit" name="submit" value="submit">Register</button>
            </form>
        </div>
        <br>
        <form action="sellermain.php" method="post">
        <button type="submit" name="submit" value="Add Realestate" class="addBackButton">Back</button>
        </form>
    </div>
</body>

</html>