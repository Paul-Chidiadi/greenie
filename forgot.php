<?php
    use PHPMailer\PHPMailer\PHPMailer;

    include 'include/conn.php';

    if (isset($_POST['send'])) {
        $email = $conn->real_escape_string($_POST['emailPHP']);

        if (!empty($email)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $sql = $conn->query("SELECT id FROM users WHERE email= '$email'");
                if ($sql->num_rows > 0) {
                    # GENERATING TOKEN CODE
                    $code = "12345678901234567890";
                    $code = str_shuffle($code);
                    $token = substr($code, 0, 10);
                    $conn->query("UPDATE users SET token='$token', tokenExpire=DATE_ADD(NOW(),
                    INTERVAL 5 MINUTE) WHERE email='$email'");
                    
                    require_once 'PHPMailer/Exception.php';
                    require_once 'PHPMailer/PHPMailer.php';
            
                    $mail = new PHPMailer();
                    $mail->addAddress($email);
                    $mail->setFrom("", "Greenie"); #INSERT YOUR EMAIL
                    $mail->Subject = "RESET PASSWORD";
                    $mail->isHTML(true);
                    $mail->Body = "
                        Hi, <br><br>
                        
                        In order to reset your password, please click the link below<br>
                        <a href='greenie.com/resetpassword.php?email=$email&token=$token'>
                        greenie/resetpassword.php?email=$email&token=$token
                        </a> <br><br> 

                        Kind Regards,<br>
                        GREENIE.
                    ";
                    $mail->send();
                    if($mail->send()){
                        exit('<font>Check your Mail Inbox!</font>');
                    }else{
                        exit('<font>Error sending messge, try again!</font>');
                    }
                }else {
                    exit('<font>Email does not Exist!</font>');
                }
            }else {
                exit('<font>Invalid Email!</font>');
            }
        }else {
            exit('<font>Empty Input!</font>');
        }
            
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GREENIE FORGOT PASSWORD</title>

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
                    <Label>Email *</Label>
                    <input type="email" class="control" id="email" placeholder="Email" required>
                    <input type="submit" class="log" id="forgot" value="SEND" >
                </div>
            </form>
        </section>
        <h6>COPYRIGHT © Greenie <script>document.write(new Date().getFullYear());</script>.</h6>

        <!-- JAVASCRIPT CODE AND LINKS  -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
                $(".login").on("submit", function (e) {
                    e.preventDefault();
                });
                $("#forgot").on("click", function () {
                    let email = $('#email').val();

                    $.ajax({
                        url: "forgot.php",
                        method: "POST",
                        data: {
                            send: 1,
                            emailPHP: email
                        },
                        success: function (response) {
                            if(response) {
                                $("#response").html(response);
                                $("#response").css("display", "block");
                                setTimeout(() => {
                                    $("#response").css("display", "none");
                                }, 7000);
                            }
                        },
                        dataType: "text",
                    })
                })
            })

        </script>
    </body>
</html>