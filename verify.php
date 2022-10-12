<?php
    include 'include/conn.php';

    if (isset($_POST['send'])) {
        $email = $conn->real_escape_string($_POST['emailPHP']);
        $verify = $conn->real_escape_string($_POST['verifyPHP']);

        if (!empty($email) && !empty($verify)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                # code...
                $data = $conn->query("SELECT id from users WHERE email = '$email' and verify_code = '$verify'");
                if($data->num_rows > 0) {
                    $sql = $conn->query("UPDATE users SET verified_at = NOW() WHERE email = '$email' and verify_code = '$verify'"); 
                    if ($sql) {
                        exit('<font>Verification Successful!</font>');
                    }else {
                        exit('<font>Verification Failed!</font>');
                    }
                }else {
                    exit('<font>Incorrect Email or Code!</font>'); 
                }  
            } else{
                exit('<font>Invalid Email!</font>');
            }
        } else {
            exit('<font>Inputs Empty!</font>');
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GREENIE VERIFY</title>

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
                    <section>
                        <Label>Verification Code *</Label>
                        <input type="password" class="control" id="verifycode" placeholder="Enter verification code" required>
                        <div id="toggle" class="show">
                            <i class='bx bxs-show'></i>
                            <i class='bx bxs-hide' ></i>
                        </div>
    	            </section>
                    <input type="submit" class="log" id="verify" value="VERIFY EMAIL" >
                </div>
            </form>
        </section>
        <h6>COPYRIGHT © Greenie <script>document.write(new Date().getFullYear());</script>.</h6>

        <!-- JAVASCRIPT CODE AND LINKS  -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>
            //TOGGLE PASSWORD VIEW
            const pwdField = document.querySelector("form .path input[type='password']");
            const show = document.querySelector(".bxs-show");
            const hide = document.querySelector(".bxs-hide");
            const toggle = document.querySelector("#toggle");

            toggle.onclick = () => {
                if (pwdField.type == "password") {
                    pwdField.type = "text";
                    show.style.display = "block";
                    hide.style.display = "none";
                } else {
                    pwdField.type = "password"
                    show.style.display = "none";
                    hide.style.display = "block";
                }
            };

            $(document).ready(function() {
                $(".login").on("submit", function (e) {
                    e.preventDefault();
                });
                $("#verify").on("click", function () {
                    let email = $('#email').val();
                    let verifyCode = $('#verifycode').val();

                    $.ajax({
                        url: "verify.php",
                        method: "POST",
                        data: {
                            send: 1,
                            emailPHP: email,
                            verifyPHP: verifyCode
                        },
                        success: function (response) {
                            if(response) {
                                $("#response").html(response);
                                $("#response").css("display", "block");
                                setTimeout(() => {
                                    $("#response").css("display", "none");
                                }, 7000);
                                if (response.indexOf('Success') > 0) {
                                    window.location = "login.php";
                                }
                            }
                        },
                        dataType: "text",
                    })
                })
            })

        </script>
    </body>
</html>