<?php
    include '../include/conn.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GREENIE STORE</title>

        <!--MAin CSS file-->
        <link rel="stylesheet" href="tree.css" />
        <!--BOXICONS CSS-->
        <link
        href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
        rel="stylesheet"
        />
    </head>
    <body>
        <!-- HEADER SECTTION -->
        <header class="header" id="header">
            <nav class="navbar" id="navbar">
                <a href="../index.php">
                    <img class="logo" src="../img/logo.png" alt="">
                </a>
                <div class="menu" id="menu">
                    <ul class="list">
                        <li>
                            <a href="../index.php">HOME</a>
                        </li>
                        <li class="sell">
                            <a href="#">SELL</a>
                            <div id="sale" class="sale">
                                <p>Upload a tree you would want to sell at our store by joining our
                                community.</p>
                                <br><a href="#">NOT YET</a><br><br>
                                <a target="_blank" href="../signup.php">SIGN UP NOW</a>
                            </div>
                        </li>
                        <li>
                            <a href="cart.php">
                                <div class="cart" id="cart">
                                    <i class='bx bxs-cart-alt'></i>
                                    <div class="top">
                                        <p>0</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- BODY SECTION -->
        <section class="body">
            <!-- goods section -->
            <div class="goods">
                <div class="rows">
                    <?php
                        $sql = $conn->query("SELECT * FROM treestore LIMIT 6");
                        if($sql->num_rows > 0) {
                            while($data = $sql->fetch_array()) {
                            echo "
                                <div class='prod'>
                                    <img src='". $data['treeImage']. "'>
                                    <p>". $data['treeName']. "</p>
                                    <small>". $data['treePrice']. "</small>
                                    <a href='tree.php?id=". $data['id']. "' class='click'>
                                        <i class='bx bxs-heart'></i>
                                    </a>
                                </div>
                            ";
                            }
                        }
                    ?>
                </div>
                <div class="rows">
                    <?php
                        $sql = $conn->query("SELECT * FROM treestore LIMIT 6 OFFSET 6");
                        if($sql->num_rows > 0) {
                            while($data = $sql->fetch_array()) {
                            echo "
                                <div class='prod'>
                                    <img src='". $data['treeImage']. "'>
                                    <p>". $data['treeName']. "</p>
                                    <small>". $data['treePrice']. "</small>
                                    <a href='tree.php?id=". $data['id']. "' class='click'>
                                        <i class='bx bxs-heart'></i>
                                    </a>
                                </div>
                            ";
                            }
                        }
                    ?>
                </div>
                <div class="rows">
                    <?php
                        $sql = $conn->query("SELECT * FROM treestore LIMIT 6 OFFSET 12");
                        if($sql->num_rows > 0) {
                            while($data = $sql->fetch_array()) {
                            echo "
                                <div class='prod'>
                                    <img src='". $data['treeImage']. "'>
                                    <p>". $data['treeName']. "</p>
                                    <small>". $data['treePrice']. "</small>
                                    <a href='tree.php?id=". $data['id']. "' class='click'>
                                        <i class='bx bxs-heart'></i>
                                    </a>
                                </div>
                            ";
                            }
                        }
                    ?>
                </div>
            </div>
            <!-- learn section -->
            <div class="learn">
                <div class="learn-top">
                    <h1>Learn</h1>
                    <i class='bx bx-bulb'></i>
                </div>
                <p>Learn more about trees and get enlightened with the 
                    knowlegde of trees, where they grow and most importantly,
                    which tree best fits your region. <span><b>GREENIE</b></span>
                    equips you with the knowledge of trees, its importance to our
                    environment and ecosystem. How trees help reduces carbon in the
                    atmosphere and provides us with oxygen, thereby reduces the chances
                    of <span><b>GLOBAL WARMING.</b></span> <span><b>GREENIE</b></span> also
                    informs you with details concerning which tree you should plant in your area
                    based on it's benefits, adaptability and economic importance to your region.
                    Subscribe to our <span><b>NEWSLETTER</b></span> to get more updates and learn
                    more!
                </p>
                <form action="" method="post">
                    <input type="email" class="control" name="email" placeholder="Email" required>
                    <input type="submit" class="btn" name="submit" value="SUBSCRIBE" >
                </form>
            </div>
        </section>
        <!-- FOOTER SECTION -->
        <footer class="footer">
            <div class="divide">
                <img height="50px" width="120px" style="object-fit: cover" src="../img/logo.png" alt="">
                <img height="50px" width="120px" style="object-fit: cover" src="../img/logo2.png" alt="">
            </div>
            <h4>COPYRIGHT © Greenie <script>document.write(new Date().getFullYear());</script>. ALL RIGHTS RESERVED. </h4>
            <hr><br>
            <div class="foot">
                <div class="container">
                    <h3>ACTION</h3><br>
                    <div> 
                        <a href="../index.php#don">-DONATE NOW</a>
                        <a href="tree.php">-TREE STORE</a>
                        <a href="../signup.php">-SIGN UP</a>
                    </div>
                </div>
                <div class="container">
                    <h3>QUICK LINKS</h3><br>
                    <div>
                        <a href="../about.php">-ABOUT</a>
                        <a href="../comm.php">-COMMUNITY</a>
                        <a href="../donate.php">-DONATIONS</a>
                        <a href="tree.php">-TREES</a>
                    </div>
                </div>
                <div class="container">
                    <h3>CONNECT</h3><br>
                    <div>
                        <a href="../index.php#contact">-CONTACT US</a>
                        <p>-<i class="bx bx-phone-call"></i> +234 9091910918</p>
                        <p>-<i class="bx bxs-envelope"></i> greenienature@gmail.com</p>
                    </div>
                </div>
            </div>
        </footer>
        
        <!-- POPUP SECTION -->
        <?php
            if (isset($_GET['id'])) {
                $treeId = $_GET['id'];
                $sql = $conn->query("SELECT * FROM treestore WHERE id='$treeId'");
                if($sql->num_rows > 0) {
                    while($data = $sql->fetch_array()) {
                    echo "
                        <div id='pop' class='pop active'>
                            <div class='pop-body'>
                                <img src='". $data['treeImage']. "'>
                                <div class='details'>
                                    <h1>". $data['treeName']. "</h1>
                                    <h3>". $data['treeFeatures']. "</h3>
                                    <p>". $data['treePrice']. "</p>
                                    <a href='". $data['id']. "' id='add'>ADD TO CART</a>
                                </div>
                            </div>
                            <div class='cancelbtn' id='cancelbtn'>
                                <i class='bx bx-x'></i>
                            </div>
                        </div>
                        <!-- Overlays on the background when pop up is active -->
                        <div id='overlay' class='active' ></div>
                    ";
                    }
                } else {}
            }
        ?>

        <!-- Javascript files and libraries -->
        <script>
            const sell = document.querySelector(".sell");
            const sale = document.querySelector(".sale");
            const cancelbtn = document.querySelector("#cancelbtn");
            const pop = document.querySelector("#pop");
            const overlay = document.querySelector("#overlay");

            sell.onclick = () => {
                sale.classList.toggle("active");
            };
            //CANCEL FOR POP UP
            cancelbtn.onclick = () => {
                pop.classList.remove('active');
                overlay.classList.remove("active");
            }
        </script>
    </body>
</html>