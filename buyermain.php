<?php
    session_start();
?>

<html>
    <head>
    <meta charset="UTF-8">
        <title>Application Name</title>
        <link href="style.css" type="text/css" rel="stylesheet">
    </head>

    <body leng="en">
        <?php if(!isset($_SESSION['use']))
            {
                header("Location:Login.php");  
            }
                echo $_SESSION['use'];
                echo "Login Success";
        ?>
        <div class="landingPageBar">
            <div class="appName">Application Name</div>
            <div class="logoutButton">
                <form method="POST" action="/home.html">
                    <input type="submit" name="logout" id="logout" value="Logout" />
                </form>
            </div>
        </div>
    </body>
</html>