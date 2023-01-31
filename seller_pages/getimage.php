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
    
    $id = $_GET['id'];

    $sql = "SELECT img FROM properties WHERE email = $_SESSION[use] AND street = $id";
    $result = mysql_query("$sql");
    $row = mysql_fetch_assoc($result);
    mysql_close($conn);

  header("Content-type: image/jpeg");
  echo $row['img'];
?>