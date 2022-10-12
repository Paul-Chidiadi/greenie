<?php
    include 'include/conn.php';

    session_start();
    # if user is already logged in take them to dashboard already(dash.php)
    if(isset($_SESSION['loggedIN'])) {
        header('Location: dash.php');
        exit();
    }

    #LET USER LOGIN
    if (isset($_POST['send'])) {
        $email = $conn->real_escape_string($_POST['emailPHP']);
        $password = $conn->real_escape_string($_POST['passPHP']);
        # ENCRYPT PASSWORD
        $encrypt_password = md5($password);

        if (!empty($email) && !empty($password)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data = $conn->query("SELECT id from users WHERE email='$email' AND password='$encrypt_password'");
                if($data->num_rows > 0) {
                    $sql = $conn->query("SELECT * FROM users WHERE email= '$email'");
                    $data = $sql->fetch_array();
                    $check = $data['verified_at'];
                    if ($check == null) {
                        exit('<font>Please Verify your Email!</font>');
                    }else {
                        $_SESSION['loggedIN'] = '1';
                        $_SESSION['email'] = $email; 
                        exit('<font>Login Success!</font>');
                    }
                }else {
                    exit('<font>Incorrect Details!</font>');
                }
            }else {
                exit('<font>Email not Valid!</font>');
            }
        }else{
            exit('<font>Empty Inputs!</font>');
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GREENIE LOGIN</title>

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
                <a  class="log" href="signup.php">SIGNUP</a>
        </header>
        <!-- BODY SECTION -->
        <section class="log-body">
            <form class="login" action="" method="post">
                <div class="path">
                    <Label>Email *</Label>
                    <input type="email" class="control" id="email" placeholder="Email" required>
                    <section>
                        <Label>Password *</Label>
                        <input type="password" class="control" id="password" placeholder="Password" required>
                        <div id="toggle" class="show">
                            <i class='bx bxs-show'></i>
                            <i class='bx bxs-hide' ></i>
                        </div>
    	            </section>
                    <a class="forgot" href="forgot.php">Forgot Password</a>
                    <a class="forgot" href="verify.php">Verify Email</a>
                    <input type="submit" class="log" id="submit" value="LOGIN" >
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
                $("#submit").on("click", function () {
                    let email = $('#email').val();
                    let password = $('#password').val();

                    $.ajax({
                        url: "login.php",
                        method: "POST",
                        data: {
                            send: 1,
                            emailPHP: email,
                            passPHP: password
                        },
                        success: function (response) {
                            if(response) {
                                $("#response").html(response);
                                $("#response").css("display", "block");
                                setTimeout(() => {
                                    $("#response").css("display", "none");
                                }, 7000);
                                if (response.indexOf('Success') > 0) {
                                    window.location = "dash.php";
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