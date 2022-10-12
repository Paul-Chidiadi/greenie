<?php
    use PHPMailer\PHPMailer\PHPMailer;
    include 'include/conn.php';

    # LET USER REGISTER
    if (isset($_POST['send'])) {
        $name = $conn->real_escape_string($_POST['namePHP']);
        $email = $conn->real_escape_string($_POST['emailPHP']);
        $password = $conn->real_escape_string($_POST['passPHP']);
        $phone = $conn->real_escape_string($_POST['phonePHP']);
        $refer = $conn->real_escape_string($_POST['refererPHP']);
        $country = $conn->real_escape_string($_POST['countryPHP']);

        # GENERATING VERIFICATION CODE
        $code = "1234567890ABCDEFGHIJ";
        $code = str_shuffle($code);
        $verify_code = substr($code, 0, 6);
        # ENCRYPT PASSWORD
        $encrypt_password = md5($password);
 
        if (!empty($name) && !empty($email) && !empty($password) && !empty($phone) && !empty($country)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data = $conn->query("SELECT id from users WHERE email= '$email'");
                if($data->num_rows > 0) { 
                    exit('<font>User Already Exists</font>');
                }else {
                    #INSERT INTO DATABASE
                    $sql = "INSERT INTO users (email, name, country, phone, password, referer, verify_code, verified_at)
                    VALUES ('$email', '$name', '$country', '$phone', '$encrypt_password', '$refer', '$verify_code', NULL )";
                    if (mysqli_query($conn, $sql)) {
                        $_SESSION['signedUP'] = '1';

                        require_once 'PHPMailer/Exception.php';
                        require_once 'PHPMailer/PHPMailer.php';
                
                        $mail = new PHPMailer();
                        $mail->addAddress($email, $name);
                        $mail->setFrom("", "Greenie"); #INSERT YOUR EMAIL
                        $mail->Subject = "EMAIL VERIFICATION";
                        $mail->isHTML(true);
                        $mail->Body = "
                            Hi, <br><br>
                            
                            <p> Your email verification code is <b>'. $verify_code .'</b> </p>
                            <br> 
                    
                            Kind Regards,<br>
                            CHIZZYB.
                        ";
                        $mail->send();
                        if($mail->send()){
                            exit('<font>Success, Check your Email and Verify!</font>');
                        } else{
                            exit('<font>Verification Mail not sent</font>');
                        }
                    } else {
                        exit('<font>Signup Failed, Try Again</font>');
                    }
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
    <title>GREENIE SIGNUP</title>

    <!--MAin CSS file-->
    <link rel="stylesheet" href="store/tree.css" />
    <!--BOXICONS CSS-->
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
    <!-- COUNTRY CODE PLUGIN -->
    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
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
            <form id='signForm' action="" method="post">
                <div class="path">
                    <Label>Firstname *</Label>
                    <input type="text" class="control" id="fname" placeholder="First Name" required>
                    <Label>Lastname *</Label>
                    <input type="text" class="control" id="lname" placeholder="Last Name" required>
                    <Label>Email *</Label>
                    <input type="email" class="control" id="email" placeholder="Email" required>
                    <Label>Referer *</Label>
                    <input type="email" class="control" id="referer" placeholder="Referer  -optional-">
                </div>
                <div class="path">
                    <section>
                        <Label>Password *</Label>
                        <input type="password" class="control pass" id="password" placeholder="Password" required>
                        <div id="toggle" class="show">
                            <i class='bx bxs-show'></i>
                            <i class='bx bxs-hide' ></i>
                        </div>
    	            </section>
                    <?php include "include/country.php"?>
                    <Label>Phone Number *</Label>
                    <input type="tel" id="phone" class="control phone" name="phone" placeholder="Phone Number" required>
                    <input type="submit" class="log btn" id="submit" value="SIGN UP">
                </div>
                <div class="path">
                </div>
            </form>
        </section>
        <h6>COPYRIGHT © Greenie <script>document.write(new Date().getFullYear());</script>.</h6>

        <!-- JAVASCRIPT CODE AND LINKS  -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>
            //COUNTRY CODE PICKER
            const phoneInputField = document.querySelector("#phone");
            const phoneInput = window.intlTelInput(phoneInputField, {
                utilsScript:
                "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            });
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

            //signup javascript code using jquery and ajax
            $(document).ready(function ()  {
                $("#signForm").on("submit", function (e) {
                    e.preventDefault();
                });
                $("#submit").on("click", function () {
                    let fname = $("#fname").val();
                    let lname = $('#lname').val();
                    let email = $('#email').val();
                    let referer = $('#referer').val();
                    let password = $('#password').val();
                    let phone = $('#phone').val();
                    let country = $('#country').val();
                    let name = `${fname + lname}`;

                    $.ajax({
                        url: "signup.php",
                        method: "POST",
                        data: {
                            send: 1,
                            namePHP: name,
                            emailPHP: email,
                            passPHP: password,
                            refererPHP: referer,
                            phonePHP: phone,
                            countryPHP: country
                        },
                        success: function (response) {
                            if(response) {
                                $("#response").html(response);
                                $("#response").css("display", "block");
                                setTimeout(() => {
                                    $("#response").css("display", "none");
                                }, 7000);
                                if (response.indexOf('Success') > 0) {
                                    window.location = "verify.php";
                                }
                            }
                        },
                        dataType: "text",
                    });
                });
            });
        </script>
    </body>
</html>