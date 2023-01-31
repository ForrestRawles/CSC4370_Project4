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
                $delete = $_POST['delete'];
                $sql = "DELETE FROM properties WHERE street = '$delete'";
        }
    }
}

?>

<!doctype html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<title>Assignment Demo</title>
    <link rel = "stylesheet" href = "seller.css">
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
    <br>
    <br>
    <?php
        $email = $_SESSION['use'];
        $sql = "SELECT * FROM properties WHERE email = '$email' ORDER BY price";
        $result = mysqli_query($conn, $sql);
        echo "<div class = 'mainPage'>";
        echo '<h1>Your Real Estate</h1>';
        if($result->num_rows > 0){
            foreach($result as $row) { ?>
                <?php 
                    $a = $row['street'];
                ?>
                <div class = 'homeInfo'>
                    <div class = 'polaroid'>   
                        <img src = "<?php echo $row['img']?>" width='250' height='250' />
                        <div class='container'>
                            <?php
                            echo $row['street']."<br>".
                            $row['city'].", ".$row['state']." ".$row['zipcode'];
                            ?>
                        </div>
                    </div>
                    <table class = 'a'>
                        <tr>
                        <td><b>Pricing: </b>$<?php echo $row['price'] ?></td>
                        <td><b># of Bedrooms: </b><?php echo $row['bedrooms'] ?></td>
                        </tr> 
                        <tr>
                        <td><b>Property Tax: </b><?php echo $row['property_tax'] ?></td>
                        <td><b># of Bathrooms: </b><?php echo $row['bathrooms'] ?> </td>
                        </tr>
                        <tr>
                        <td><b>House Age: </b><?php echo $row['age'] ?></td>
                        <td><b># of Closets: </b><?php echo $row['closets'] ?></td>
                        </tr>
                        <tr>
                        <td><b>Square Footage: </b><?php echo $row['sqr_foot'] ?></td>
                        <td><b>Garden? </b><?php echo $row['garden'] ?></td>
                        </tr>
                        <tr>
                        <td><b>Nearby Facilities (in Mi): </b><?php echo $row['nearby_facilities'] ?></td>
                        <td><b>Parking? </b><?php echo $row['parking'] ?></td>
                        </tr>
                        <tr>
                        <td><b>Nearby Main Roads (in Mi): </b><?php echo $row['nearby_main_roads'] ?></td>
                        <td></td>
                        </tr>
                        </table>
                        <form method='post' action='delete.php'>
                        <button type='submit' name='delete' value="<?php echo $row['street']?>" id = 'radio'>Delete</button><br>
                        </form>
                </div>
                <br><br><br><br><br><br>
            <?php }
        } else {
            echo 'Press the Add Button to Create a Listing<br>';
        }
    ?>
    <!-- <img src='getimage.php?id=201 Edgewood Ave.' width='250' height='250' />; -->
    <!-- also I have pretty standard button css across the CSS styling pages if you would like to use it -just add the class to the buttons and it should work -->
    <?php 
    if (isset($_POST['delete'])) {
        $email = $_SESSION['email'];
        //$email = 'frawles2@student.gsu.edu';
        $sql = "SELECT * FROM properties WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        foreach($result as $row) {
                if($row['street'] == $_POST['delete']) {
                    $delete = $_POST['delete'];
                    $sql = "DELETE FROM properties WHERE street = '$delete'";
                }
            }
        }
    ?>
    <br>
    <form action="addRealestate.php" method="post">
    <button type="submit" name="submit" value="Add" id = "plus">+</button>
    </form>
    </div>
        
</body>
</html>