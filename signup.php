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
        <!-- HEADER SECTTION -->
        <header class="head" id="head">
                <a href="index.php">
                    <img class="logo" src="img/logo.png" alt="">
                </a>
                <a  class="log" href="login.php">LOGIN</a>
        </header>
        <!-- BODY SECTION -->
        <section class="log-body">
            <form action="" method="post">
                <div class="path">
                    <Label>Firstname *</Label>
                    <input type="text" class="control" name="fname" placeholder="First Name" required>
                    <Label>Lastname *</Label>
                    <input type="text" class="control" name="lname" placeholder="Last Name" required>
                    <Label>Email *</Label>
                    <input type="email" class="control" name="email" placeholder="Email" required>
                </div>
                <div class="path">
                    <section>
                        <Label>Password *</Label>
                        <input type="password" class="control pass" name="password" placeholder="Password" required>
                        <div id="toggle" class="show">
                            <i class='bx bxs-show'></i>
                            <i class='bx bxs-hide' ></i>
                        </div>
    	            </section>
                    <?php include "include/country.php"?>
                    <Label>Phone Number *</Label>
                    <input type="tel" id="phone" class="control phone" name="phone" placeholder="Phone Number" required>
                    <input type="submit" class="log btn" name="submit" value="SIGN UP">
                </div>
                <div class="path">
                </div>
            </form>
        </section>
        <h6>COPYRIGHT © Greenie <script>document.write(new Date().getFullYear());</script>.</h6>

        <!-- JAVASCRIPT CODE AND LINKS  -->
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

        </script>
    </body>
</html>