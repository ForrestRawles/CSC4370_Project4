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

$titlename = "buyer";

if (isset($_SESSION['use'])){
    $titlename = $_SESSION['use'];
}
?>

<!doctype html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<title>Cornerstone</title>
    <link href="buyer.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div class="landingPageBar">
        <div class="appName">Cornerstone</div>
        <form method="POST" action="../home.html">
            <button type="submit" name="logout" id="logout" value="Logout" class="logoutButton">Logout</button>
        </form>
    </div>
    <div class="mainGroup">
        <h1>Welcome <?=$titlename?>!</h1>
        <form action = "" type = "get">
            <div>
            <select name = "filter">
                <option>None</option>
                <option>Street name</option>
                <option>Email</option>
            </select>
            <input name="input" type="text">
            <button type= "submit" class="addButton">Search</button>
            </div>
        </form>
        <div>
        <?php
            //$email = $_SESSION['email'];
            
            
            $sql = "CREATE TABLE IF NOT EXISTS user_".$titlename." (
                ID int(11) AUTO_INCREMENT,
                EMAIL varchar(255) NOT NULL,
                STREET varchar(255) NOT NULL,
                PRIMARY KEY  (ID)
                )";

            if ($conn->query($sql) === TRUE) {
                //echo "User data exists<br>";
            }
            else{
                $sql = "SELECT * from user";
                $result = mysqli_query($conn, $sql);
                foreach($result as $usecase){
                    if ($usecase['email'] == $titlename){
                        $titlename = $usecase['username'];
                        break;
                    }
                }
                $sql = "CREATE TABLE IF NOT EXISTS user_".$titlename." (
                    ID int(11) AUTO_INCREMENT,
                    EMAIL varchar(255) NOT NULL,
                    STREET varchar(255) NOT NULL,
                    PRIMARY KEY  (ID)
                    )";
        
                if ($conn->query($sql) === TRUE) {
                    //echo "User data exists<br>";
                }
                else{
                    //echo "Something messed up";
                    die();
                }
                
            }
            $wishlist = [];
            $sql2 = "SELECT * FROM user_".$titlename;
            $result = mysqli_query($conn, $sql2);
            foreach ($result as $entry){
                array_push($wishlist, $entry['STREET']);
            }

            echo "Welcome! Try adding something to your wishlist."; 

            if (isset($_GET["STREET"],$_GET["EMAIL"])){
                echo "should add to wishlist now";
                $mail = $_GET["EMAIL"];
                $street = $_GET["STREET"];
                $checks = FALSE;
                foreach ($wishlist as $wish){
                    if ($wish == $street){
                        $checks = TRUE;
                    }
                }
                if ($checks == FALSE){
                    $sql2 = "INSERT INTO user_".$titlename." (EMAIL,STREET) VALUES ('$mail','$street') ";
                    $result = mysqli_query($conn, $sql2);
                    array_push($wishlist, $street);
                }
                
            }
            else{
                //echo "try addding something to your wishlist";
            }
            echo "<br>";
            echo "Homes Inside Your Wishlist: <br/>";
            foreach($wishlist as $item){
                echo $item."<br/>";
            }

            echo "<br>";
            echo "All Listings: <br/>";            

            $sql = "SELECT * FROM properties";
            $result = mysqli_query($conn, $sql);
            $checks = FALSE;

            function filter($line){
                if (isset($_GET['filter'],$_GET['input'])){
                    $thing = $_GET['filter'];
                    if($thing == "None"){
                        return TRUE;
                    }
                    if ($thing == "Street Name" && $line['street'] == $_GET['input']){
                        return TRUE;

                    }
                    else if($thing == "Email" && $line['email'] == $_GET['input']){
                        return TRUE;
                    }
                    else{
                        
                        return FALSE;
                    }
                }
                else{
                    return TRUE;
                }
            }

            if ($result->num_rows > 0) {
                foreach($result as $row) {
                    if (filter($row) == TRUE){
                        echo "<div class='listings'>";
                        echo "<div class='listing'>";
                        echo "<table>";
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
                            echo "</table>";
                            echo '<form action = "buyermain.php" method = \"get\">
                            <input type = "hidden" name="EMAIL" value = "'.$row['email'].'">
                            <input type = "hidden" name="STREET" value = "'.$row['street'].'">
                            <button type="submit" name="submit" value="submit" class="addButton">Add to Wishlist</button>
                            </form>';
                        echo "</div>";
                        echo "</div>";
                    }
                }
                
            }
        ?>
        </div>
    </div>
</body>
</html>