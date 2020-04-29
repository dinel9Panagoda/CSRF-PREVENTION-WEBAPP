<?php

    session_start();
    require_once 'Token/token.php';

    setcookie("username", "99YoYo", time() + 50000);


    $defualt_uname = "99YoYo";
    $default_password = "99YoPass";


    if(isset($_POST["login-submit"])){

        if(!empty($_POST["uname"]) || !empty($_POST["psw"])){

            $username = $_POST['uname'];
            $password = $_POST['psw'];

            if($username == $defualt_uname && $password == $default_password){

                $_SESSION['username'] = $username;


                $_SESSION['start']= time();
                $_SESSION['expire']= $_SESSION['start'] + (1 * 15);

                header("location:welcome.php");


                $token = randomToken::generate(session_id());
                setcookie("id", session_id());
                setcookie("token", $token);

            }
            else{
                header("location:tryAgain.php");
            }
        }
        else{

            header("location:loginHome.php");
        }

    }
?>

<!DOCTYPE html>
<html lang="zxx">
    <head>
        <meta charset="utf-8">
        <!-- MOBILE RESPONSIVE -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- PLUGINS -->
        <!-- bootstrap -->
        <link rel="stylesheet" href="plugins/bootstrap-4.4.1-dist/css/bootstrap.min.css"> 
        

        <!-- CSS File -->
        <link rel="stylesheet" href="css/style.css">
        <title>LOGIN</title>
        
    </head>
    <body id="login">

        <div id="loginForm">

            <h1>LOGIN</h1>
            <form action="" method="POST">

                <div class="container">

                    <label for="uname">
                        USERNAME
                    </label>

                    <input type="text" placeholder="Enter your username ;)" name="uname" required>

                    <label for="psw">
                        PASSWORD
                    </label>
                    
                    <input type="password" placeholder="Enter your password " name="psw" required>
        
                    <button type="submit" name="login-submit">LOGIN</button>

                </div>
            </form>

        </div>

        <div id="loginData">

            <p>USERNAME : 99YoYo&nbsp; &nbsp; ||&nbsp; &nbsp; PASSWORD : 99YoPass </p>
            <p>IT18211092&nbsp; &nbsp; ||&nbsp; &nbsp; A. D. Panagoda </p>

        </div>

        <!-- jQuery -->
        <!-- Bootstrap JS -->
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

        <script src="plugins/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script> 
    
        <!-- Main Script -->
        <script src="js/javascript.js"></script>

        <script src="plugins/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>

    </body>
</html>
