<?php
    include 'include/conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GREENIE PASSWORD RESET</title>

    <!--MAin CSS file-->
    <link rel="stylesheet" href="store/tree.css" />
    <!--BOXICONS CSS-->
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
</head>
    <body>
        <!-- RESPONSE POP UP -->
        <div class="response" id="response"></div>
        <!-- HEADER SECTTION -->
        <header class="head" id="head">
                <a href="index.php">
                    <img class="logo" src="img/logo.png" alt="">
                </a>
                <a  class="log" href="login.php">LOGIN</a>
        </header>
        <!-- BODY SECTION -->
        <section class="log-body">
            <form class="login" action="" method="post">
                <div class="path">
                    <?php
                        if (isset($_GET['email']) && isset($_GET['token'])) {

                            $email = $_GET['email'];
                            $token = $_GET['token'];
                    
                            $sql = $conn->query("SELECT id FROM users WHERE email='$email' AND token='$token' AND
                                token<>'' AND tokenExpire > NOW()");
                            if ($sql->num_rows > 0) {
                                
                                # GENERATING NEW PASSWORD
                                $code = "1234567890ABCDEFGHIJ";
                                $code = str_shuffle($code);
                                $newpassword = substr($code, 0, 10);
                                # encrypt new password
                                $encrypt_password = md5($newpassword);
                                $conn->query("UPDATE users SET token='nil', password='$encrypt_password' WHERE email='$email'");
                    
                                echo "Your new password is <b>$newpassword<b> <br> 
                                <a href='login.php'>Click here to LOGIN</a>";
                            }else {
                                header('Location: login.php');
                            }
                        } else {
                            header('Location: login.php');
                            exit();
                        }
                    ?>
                </div>
            </form>
        </section>
        <h6>COPYRIGHT © Greenie <script>document.write(new Date().getFullYear());</script>.</h6>

    </body>
</html>