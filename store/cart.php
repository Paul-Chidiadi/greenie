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
                                        <p class="cartNum">0</p>
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
                <!-- CART SECTION -->
                <div class="carts">
                    <table>
                        <thead>
                            <tr>
                                <th>TREE</th>
                                <th>Quantity</th>
                                <th>AMOUNT</th>
                                <th>R/A</th>
                            </tr> 
                        </thead>
                        <tbody id="body">
                            <!-- javaScript generated elements with data from IndexDB local storage database goes in here -->
                        </tbody>
                    </table>  
                </div>
                <div class="total">
                    <table>
                        <tr>
                            <td>Subtotal</td>
                            <td id="sub">$0</td>
                        </tr>
                        <tr>
                            <td>Tax</td>
                            <td id="tax">$0</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td id="total">$0</td>
                        </tr>
                    </table>
                </div>
                <!-- checkout button -->
                <form action="" method="post">
                    <!-- <input type="hidden" id="email" name="order_email" value=""> -->
                    <input type="hidden" id="products_info" name="order_productInfo">
                    <input type="hidden" id="totalPrice" name="order_total"> 
                    <input type="submit" id="check" name="submit" class="botn" value="Proceed to checkout">
                </form>

                <!-- MORE PRODUCTS -->
                <h5><i class='bx bxs-heart'></i> MORE TREES <i class='bx bxs-heart'></i></h5>
                <div class="rows">
                    <?php
                        $sql = $conn->query("SELECT * FROM treestore LIMIT 6 OFFSET 3");
                        if($sql->num_rows > 0) {
                            while($data = $sql->fetch_array()) {
                            echo "
                                <div class='prod'>
                                    <img src='". $data['treeImage']. "'>
                                    <p>". $data['treeName']. "</p>
                                    <small>". $data['treePrice']. "</small>
                                    <a href='cart.php?id=". $data['id']. "' class='click'>
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
                        $sql = $conn->query("SELECT * FROM treestore LIMIT 6 OFFSET 9");
                        if($sql->num_rows > 0) {
                            while($data = $sql->fetch_array()) {
                            echo "
                                <div class='prod'>
                                    <img src='". $data['treeImage']. "'>
                                    <p>". $data['treeName']. "</p>
                                    <small>". $data['treePrice']. "</small>
                                    <a href='cart.php?id=". $data['id']. "' class='click'>
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
                        <a target="_blank" href="../signup.php">-SIGN UP</a>
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
                                <img id='image' src='". $data['treeImage']. "'>
                                <div class='details'>
                                    <h1 id='name'>". $data['treeName']. "</h1>
                                    <h3>". $data['treeFeatures']. "</h3>
                                    <p id='price'>". $data['treePrice']. "</p>
                                    <input type='number' id='qty' min='1' value='1'>
                                    <input type='hidden' id='ided' value='". $data['id']. "'>
                                    <a href='#' id='addbtn'>ADD TO CART</a>
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
            } else {# if there is no $_GET['id'] still render the pop but remove the active class
                #(this is so that our elements won't be null in javascript)
                echo "
                    <div id='pop' class='pop'>
                        <div class='pop-body'>
                            <img id='image' src=''>
                            <div class='details'>
                                <h1 id='name'></h1>
                                <h3></h3>
                                <p id='price'></p>
                                <input type='number' id='qty' min='1' value='1'>
                                <input type='hidden' id='ided' value=''>
                                <a href='#' id='addbtn'>ADD TO CART</a>
                            </div>
                        </div>
                        <div class='cancelbtn' id='cancelbtn'>
                            <i class='bx bx-x'></i>
                        </div>
                    </div>
                    <!-- Overlays on the background when pop up is active -->
                    <div id='overlay' class='' ></div>
                ";
            }
        ?>

        <!-- Javascript files and libraries -->
        <script src="cart.js"></script>
    </body>
</html>