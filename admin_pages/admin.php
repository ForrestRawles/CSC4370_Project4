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

    if (isset($_SESSION['use'])){
        $titlename = $_SESSION['use'];
    }
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <title>Cornerstone Admin</title>
        <link href="admin_styling.css" type="text/css" rel="stylesheet">
    </head>

    <body leng="en">
        <?php if(!isset($_SESSION['use']))
            {
                header("Location:Login.php");  
            }
                //$_SESSION['use'];
                //"Login Success";
        ?>
        <div class="landingPageBar">
            <div class="appName">Cornerstone</div>
            <div class="logoutButton">
                <form method="POST" action="../home.html">
                    <input type="submit" name="logout" id="logout" value="Logout" />
                </form>
            </div>
        </div>
        <div class="display">
            <div class="quickFacts">
                <div class="listing">
                    <h2>Number of Listings: 
                        <?php 
                            $host = "localhost";
                            $user = "frawles2";
                            $pass = "frawles2";
                            $dbname = "frawles2";
                            $conn = new mysqli($host, $user, $pass, $dbname);
                            $sql = "SELECT * FROM properties";
                            $result = mysqli_query($conn, $sql);
                            $listings = 0;
                            if ($result->num_rows > 0) {
                                foreach($result as $row) {
                                    if($row){
                                        $listings += 1;
                                    }
                                }
                            }
                            echo($listings);
                        ?>
                    </h2>
                </div>
                <div class="numUsers">
                    <h2>Number of Users: 
                        <?php 
                            $host = "localhost";
                            $user = "frawles2";
                            $pass = "frawles2";
                            $dbname = "frawles2";
                            $conn = new mysqli($host, $user, $pass, $dbname);
                            $sql = "SELECT * FROM user";
                            $result = mysqli_query($conn, $sql);
                            $users = 0;
                            if ($result->num_rows > 0) {
                                foreach($result as $row) {
                                    if($row){
                                        $users += 1;
                                    }
                                }
                            }
                            echo($users);
                        ?>
                    </h2>
                </div>
                <div class="numBuyers">
                    <h2>Number of Buyers on the Site: 
                        <?php 
                            $host = "localhost";
                            $user = "frawles2";
                            $pass = "frawles2";
                            $dbname = "frawles2";
                            $conn = new mysqli($host, $user, $pass, $dbname);
                            $sql = "SELECT * FROM user";
                            $result = mysqli_query($conn, $sql);
                            $users = 0;
                            if ($result->num_rows > 0) {
                                foreach($result as $row) {
                                    if($row['buyer'] != null){
                                        $users += 1;
                                    }
                                }
                            }
                            echo($users);
                        ?>
                    </h2>
                </div>
                <div class="numSellers">
                    <h2>Number of Sellers on the Site: 
                        <?php 
                            $host = "localhost";
                            $user = "frawles2";
                            $pass = "frawles2";
                            $dbname = "frawles2";
                            $conn = new mysqli($host, $user, $pass, $dbname);
                            $sql = "SELECT * FROM user";
                            $result = mysqli_query($conn, $sql);
                            $users = 0;
                            if ($result->num_rows > 0) {
                                foreach($result as $row) {
                                    if($row['seller'] != null){
                                        $users += 1;
                                    }
                                }
                            }
                            echo($users);
                        ?> 
                    </h2>
                </div>
                <div class="averagePrice">
                    <h2>Average Price of All Listings: $
                        <?php
                            $host = "localhost";
                            $user = "frawles2";
                            $pass = "frawles2";
                            $dbname = "frawles2";
                            $conn = new mysqli($host, $user, $pass, $dbname); 
                            $sql = "SELECT * FROM properties ORDER BY price";
                            $result = mysqli_query($conn, $sql);
                            $avgprice = 0;
                            $listings = 0;
                            if ($result->num_rows > 0) {
                                foreach($result as $row) {
                                    $pricehouse = $row['price'];
                                    $avgprice = $avgprice + $pricehouse;
                                    $listings = $listings + 1;
                                }
                            }
                            $avgprice = $avgprice / $listings;
                            echo(number_format($avgprice,2));
                        ?>
                    </h2>
                </div>
            </div>
            <div class="lists">
                <div class="lowestListings">
                    <h2>Top 5 Lowest Listing Prices: <br/>
                        <?php
                            $host = "localhost";
                            $user = "frawles2";
                            $pass = "frawles2";
                            $dbname = "frawles2";
                            $conn = new mysqli($host, $user, $pass, $dbname); 
                            $sql = "SELECT * FROM properties ORDER BY price";
                            $result = mysqli_query($conn, $sql);
                            $avgprice = 0;
                            $listings = 1;
                            if ($result->num_rows > 0) {
                                foreach($result as $row) {
                                    if ($listings <= 5){
                                        $pricehouse = $row['price'];
                                        echo ($listings.". ".$pricehouse."<br/>");
                                        $listings = $listings + 1;
                                    }
                                }
                            }
                        ?>
                    </h2>
                </div>
                <div class="highestListings">
                    <h2>Top 5 Highest Listing Prices: <br/>
                        <?php
                            $host = "localhost";
                            $user = "frawles2";
                            $pass = "frawles2";
                            $dbname = "frawles2";
                            $conn = new mysqli($host, $user, $pass, $dbname); 
                            $sql = "SELECT * FROM properties ORDER BY price DESC";
                            $result = mysqli_query($conn, $sql);
                            $avgprice = 0;
                            $listings = 1;
                            if ($result->num_rows > 0) {
                                foreach($result as $row) {
                                    if ($listings <= 5){
                                        $pricehouse = $row['price'];
                                        echo ($listings.". ".$pricehouse."<br/>");
                                        $listings = $listings + 1;
                                    }
                                }
                            }
                        ?>
                    </h2>
                </div>
                <div class="zipCodes">
                    <h2>Zip Codes With the Most Homes Listed: <br/>
                        <?php
                            $host = "localhost";
                            $user = "frawles2";
                            $pass = "frawles2";
                            $dbname = "frawles2";
                            $conn = new mysqli($host, $user, $pass, $dbname); 
                            $sql = "SELECT * FROM properties ORDER BY zipcode";
                            $result = mysqli_query($conn, $sql);
                            $listings = 1;
                            $prev_zipcode = 0;
                            if ($result->num_rows > 0) {
                                foreach($result as $row) {
                                    if ($listings <= 5){
                                        $zip = $row['zipcode'];
                                        if($prev_zipcode != $zip){
                                            $prev_zipcode = $zip;
                                            echo ($listings.". ".$zip."<br/>");
                                            $listings = $listings + 1;
                                        }
                                    }
                                }
                            }
                        ?>
                    </h2>
                </div>
            </div>
        </div>
    </body>
</html>