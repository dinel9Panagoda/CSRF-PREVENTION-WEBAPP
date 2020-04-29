<?php
 
    session_start();
    require_once 'Token/token.php';

    if(isset($_POST['uname'], $_POST['csrf_token'], $_POST['psw'])){

        $username = $_POST['uname'];
        $csrf_token = $_POST['csrf_token'];
        $password = $_POST['psw'];

        if(!empty($username) && !empty($csrf_token) && !empty($password)){
            if(randomToken::check($csrf_token)){
                echo "<script>alert('Yo! You have changed me successfully. [CSRF Token is Valid]');</script>";
            }
            elseif(!randomToken::check($csrf_token)){
                echo "<script>alert('Bad News!! Cannot be Changed. [CSRF token is Not Valid]');</script>";
     
            }
        }
        
    }
    if(!isset($_SESSION['username'])){
        echo "<body style='background-image:url(images/indexCaught.png);background-size: cover;height: 100%;overflow: hidden;'><br><br><br><br><br><br><br><br><br><br><br>
        <h2 align='center' style='color:white;'>HEY YOU!!! ^_^ TRYING TO REACH THE INDEX? HUHHH<br>";
        echo "<a href='loginHome.php'>CMON COME HERE -> AND CLICK ME TO LOGIN ;)</a></h2></body>";

    }
    else{
        $current_time = time();
        if($current_time > $_SESSION['expire']){
            session_destroy();

            echo "<body style='background-image:url(images/sessionExpired.png);background-size: cover;height: 100%;overflow: hidden;'><br><br><br><br><br><br><br><br><br><br><br>
            <h2 align='center' style='color:white;'>OOPS YOUR SESSION HAS EXPIRED<br><a href='loginHome.php'>IT'S OK CLICK ME TO LOGIN BACK AGAIN</h2></p></body>";
        }
        else{

?>

<!DOCTYPE html>
<html lang="zxx">

    <head>
        <meta charset="utf-8">
        <!-- MOBILE RESPONSIVE -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- PLUGINS -->
        <!-- bootstrap -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <!-- CSS File -->
        <link rel="stylesheet" href="css/style.css">
        <title>LOGIN</title>
        
    </head>    
    <body id = "welcome">
    
        <h1>
            <?php

                echo "Welcome ". $_SESSION['username']."";

            ?>
        </h1>

        <div class = "row">

            <div class = "column" id="logoutBtn">

                <div id="logoutBackground">
                    <form action="phpActions/logout.php" method="GET">
                        <p>If you want to logout before 15 seconds. Hurry Up and click LOGOUT.</p>
                        <button type="submit" name="logout">LOGOUT</button>
                    </form>
                </div>

                <div id="InfoBackground">
                    <p>Hey! Wanna know more about CSRF TOKENS? Then try to change the username and password. [U will be able to understand the CSRF OPERATION] <br> CMON BE QUICK THE SESSION WILL LAST ONLY FOR 15 SECONDS.</p>
                </div>

            </div>

            <div class = "column">
                <div id="welcomeForm">
                    <form action="" method="POST">
                        <h1>HEY WANNA ALTER ME? GO AHEAD</h1>

                        <div class ="container">
                            <label for="uname">
                                USERNAME
                            </label>
                            
                            <input type="text" placeholder="Enter your username :) " name="uname" required>

                            <label for="psw">
                                PASSWORD
                            </label>

                            <input type="password" placeholder="Enter your password" name="psw" required>
                            
                            <button type="submit" name="login-submit">CHANGE ;)</button>

                            <input type="hidden" name="csrf_token" value="<?php echo randomToken::generate();?>">
                        </div>

                    </form>
                </div>

            </div>

        </div>

        <?php
            }
        }
        
        ?>
        <script src="js/javascript.js"></script>
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

        <script src="plugins/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    
    </body>

</html>