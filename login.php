<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
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
                    <input type="email" class="control" name="email" placeholder="Email" required>
                    <section>
                        <Label>Password *</Label>
                        <input type="password" class="control" name="password" placeholder="Password" required>
                        <div id="toggle" class="show">
                            <i class='bx bxs-show'></i>
                            <i class='bx bxs-hide' ></i>
                        </div>
    	            </section>
                    <a class="forgot" href="">Forgot Password</a>
                    <input type="submit" class="log" name="submit" value="LOGIN" >
                </div>
            </form>
        </section>
        <h6>COPYRIGHT © Greenie <script>document.write(new Date().getFullYear());</script>.</h6>

        <!-- JAVASCRIPT CODE AND LINKS  -->
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

        </script>
    </body>
</html>