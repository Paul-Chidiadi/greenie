<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=900px, initial-scale=1.0">
        <title>GREENIE DASHBOARD</title>

        <!--MAin CSS file-->
        <link rel="stylesheet" href="css/dash.css" />
        <!--BOXICONS CSS-->
        <link
        href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
        rel="stylesheet"
        />
    </head>
    <body>
        <!-- WRAPPER -->
        <div class="wrapper">
            <!-- SIDEBAR -->
            <div class="sidebar">
                <img class="logo" src="img/logo.png" alt="">
                <ul>
                    <li id="pr" class="list active">
                        <i class='bx bx-category' ></i>
                        <a href="#">Profile</a>
                    </li>
                    <li id="up" class="list">
                        <i class='bx bx-box'></i>
                        <a href="#">Uploads</a>
                    </li>
                    <li id="me" class="list">
                        <i class='bx bx-message-alt-dots'></i>
                        <a href="#">Meet</a>
                    </li>
                    <li id="tr" class="list">
                        <i class='bx bx-leaf'></i>
                        <a href="#">Trees</a>
                    </li>
                    <li id="pa" class="list">
                        <i class='bx bx-credit-card'></i>
                        <a href="#">Pay Method</a>
                    </li>
                    <li id="do" class="list">
                        <i class='bx bx-donate-heart'></i>
                        <a href="#">Donate</a>
                    </li>
                    <div id="logg" class="logg">
                        <i class='bx bx-rocket'></i>
                        <a href="#">LOG OUT</a>
                        <div id="logout" class="sale">
                            <p>Sure you want you log out?</p>
                            <br>
                            <a href="#">NOT YET</a>
                            <a href="#">LOGOUT NOW</a>
                        </div>
                    </div>
                </ul>

            </div>
            <!-- MAIN CONTENT -->
            <div class="main">
                <header>
                    <p>Plant, Earn and Celebrate with <span>GREENIE!</span> </p>
                </header>
                <!-- PROFILE -->
                <section id="profile" class="menu active"></section>
                <!-- UPLOADS -->
                <section id="upload" class="menu"></section>
                <!-- MEET -->
                <section id="meet" class="menu"></section>
                <!-- TREES -->
                <section id="trees" class="menu"></section>
                <!-- PAY METHOD -->
                <section id="paymethod" class="menu"></section>
                <!-- DONATE -->
                <section id="donate" class="menu"></section>
            </div>
        </div>
        
        <!-- javascript files and libraries -->
        <script type="text/javascript" src="js/dash.js"></script>
    </body>
</html>