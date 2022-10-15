<?php
  include 'include/conn.php';
    session_start();

    # if user is not logged in take them back to login page(login.php)
    if (!isset($_SESSION['loggedIN'])) {
        header('Location: login.php');
        exit();
    }
    $email = $_SESSION['email'];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=1200px">
        <title>GREENIE DASHBOARD</title>

        <!--MAin CSS file-->
        <link rel="stylesheet" href="css/dash.css" />
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
        <!-- LOADER -->
        <div id="loader"></div>
        <!-- RESPONSE POP UP -->
        <div class="response" id="response"></div>
        <!-- WRAPPER -->
        <div class="wrapper">
            <!-- SCREEN INFO -->
            <div class="screen-info">
                <p>This page is best viewed in desktop mode. We suggest you use a PC preferrably</p>
            </div>
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
                            <a href="logout.php">LOGOUT NOW</a>
                        </div>
                    </div>
                </ul>

            </div>
            <!-- MAIN CONTENT -->
            <div class="main">
                <header>
                    <p>Plant, Earn and Celebrate with <span>GREENIE!</span> </p>
                    <small id="genEmail"><?php echo $email; ?></small>
                </header>
                <!-- PROFILE -->
                <section id="profile" class="menu active">
                    <?php
                        #select all data of current user
                        $sql1 = $conn->query("SELECT * FROM users WHERE email= '$email'");
                        $data1 = $sql1->fetch_array();
                        $name = $data1['name'];
                        $country = $data1['country']; 
                        $phone = $data1['phone']; 
                        $profileImg = $data1['profileImg'];
                    ?>
                    <div class="profile">
                        <div class="pics">
                            <div class="img" style=" background:url(<?php echo $profileImg; ?>) no-repeat center center; background-size: cover;"></div>
                            <h1><?php echo $name; ?></h1>
                            <small><?php echo $email; ?></small>
                        </div>
                        <div class="update">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="path">
                                    <?php include "include/country.php"?>
                                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                                    <Label>Phone Number *</Label>
                                    <input type="tel" id="phone" class="control phone" name="phone" placeholder="<?php echo $phone; ?>" required>
                                    <section>
                                        <Label>Password *</Label>
                                        <input type="password" class="control pass" id="password" name="password" placeholder="Password" required>
                                        <div id="toggle" class="show">
                                            <i class='bx bxs-show'></i>
                                            <i class='bx bxs-hide' ></i>
                                        </div>
                                    </section>
                                </div>
                                <div class="path">
                                    <Label>Profile Picture *</Label>
                                    <input type="file" name="file" class="control" id="picture" required>
                                    <input type="submit" class="log btn" id="updateProfile" name="updateProfile" value="UPDATE">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="infos">
                        <div class="part earn">
                            <h1>Earnings $
                                <span>
                                    <?php
                                        #CHECK UPLOADS DONE BY CURRENT USER AND GET ITS NUMBER 
                                        $dataUploads = $conn->query("SELECT * from uploads WHERE email= '$email'");
                                        $totalUploads = $dataUploads-> num_rows;
                                        $earn = 0.1 * 2 * $totalUploads;
                                        #echo $earn;
                                        #CHECK IF USER EXISTS
                                        $dataCheck = $conn->query("SELECT id from user_info WHERE email= '$email'");
                                        #if user exists in the user_info table then update the table else insert new data into the table
                                        if($dataCheck -> num_rows > 0) {
                                            $conn->query("UPDATE user_info SET earnings$ ='$earn' WHERE email='$email'");
                                        }else {
                                            #INSERT INVITES INTO DATABASE
                                            $sqlEarn = "INSERT INTO user_info (email, earnings$) VALUES ('$email', '$earn')";
                                            mysqli_query($conn, $sqlEarn);
                                        }
                                        #get number of earnings of current user
                                        $sql2 = $conn->query("SELECT * FROM user_info WHERE email= '$email'");
                                        if ($sql2->num_rows > 0) {
                                            $data2 = $sql2->fetch_array();
                                            $earnings = $data2['earnings$'];
                                            echo $earnings;
                                        }else {
                                            echo 0;
                                        }
                                    ?>
                                </span>
                            </h1>
                            <p> <span>HOW TO EARN</span><br> Make a 30 seconds video of you planting a tree in your area, showing your face
                                and you are set to earn. GREENIE sees you as an eligible earner when you have made at least five invites
                                and have sold or purchased at least a tree from our <a target="_blank" href="store/tree.php">TREE STORE</a>.
                                An upload earns you <span>2 Greenie Coins,</span> a <span>Greenie Coin</span> is equivalent to $0.1. 
                            </p>
                        </div>
                        <div class="part invite">
                            <h1>Invites 
                                <span>
                                    <?php
                                        #CHECK REFEREALS DONE BY CURRENT USER AND GET ITS NUMBER 
                                        $dataInvite = $conn->query("SELECT * from users WHERE referer= '$email'");
                                        $totalInvites = $dataInvite-> num_rows;
                                        #CHECK IF USER EXISTS
                                        $dataCheck = $conn->query("SELECT id from user_info WHERE email= '$email'");
                                        #if user exists in the user_info table then update the table else insert new data into the table
                                        if($dataCheck -> num_rows > 0) {
                                            $conn->query("UPDATE user_info SET invites='$totalInvites' WHERE email='$email'");
                                        }else {
                                            #INSERT INVITES INTO DATABASE
                                            $sqlInvite = "INSERT INTO user_info (email, invites) VALUES ('$email', '$totalInvites')";
                                            mysqli_query($conn, $sqlInvite);
                                        }
                                        #get number of invites of current user
                                        $sql2 = $conn->query("SELECT * FROM user_info WHERE email= '$email'");
                                        if ($sql2->num_rows > 0) {
                                            $data2 = $sql2->fetch_array();
                                            $invites = $data2['invites'];
                                            echo $invites;
                                        }else {
                                            echo 0;
                                        }
                                    ?>
                                </span>
                            </h1>
                            <p>Invite people to join this community with your link below<br><br>
                                <span id="link">greenie.com/signup.php?referer=<?php echo $email; ?></span>
                                <button class="log" id="copybtn">COPY</button>
                            </p>
                            <div class="reply">COPIED</div>
                        </div>
                    </div>
                </section>
                <!-- UPLOADS -->
                <section id="upload" class="menu">
                    <div class="uploads">
                        <form action="" method="post">
                            <div class="path">
                                <input type="hidden" name="email" value="<?php echo $email; ?>">
                                <Label>Post a Picture *</Label>
                                <input type="file" class="control" id="postpic" name="picture" required>
                                <input type="submit" class="log" id="uploadBtns" name="upload" value="upload">
                            </div>
                            <div class="path">
                                <Label>What's on your mind? *</Label>
                                <textarea name="posttext" id="posttext" cols="30" rows="5" placeholder="What's on your mind" required></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="prev">
                        <h1>UPLOADS</h1>
                        <div class="items">
                            <div class="rows">
                                <?php
                                    #SELECT UPLOADS OF CURRENT USER AND DISPLAY
                                    $sql3 = $conn->query("SELECT image from uploads WHERE email='$email'");
                                    if($sql3->num_rows > 0){
                                        while ($data3 = $sql3->fetch_array()) {
                                            echo "
                                                <div class='prod'>
                                                    <img src='". $data3['image']. "' >
                                                    <a target='_blank' href='". $data3['image']. "' class='click'>
                                                        <i >view</i>
                                                    </a>
                                                </div>
                                            ";
                                        }
                                    } else {
                                        echo "
                                            <p>No Uploads Yet!</p>
                                        ";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- MEET -->
                <section id="meet" class="menu">
                    <div class="events">
                        <div class="col one">
                            <h1>Events <i class='bx bxs-calendar-event'></i></h1>
                            <p>You have no events yet. Subscribe to our news letter to
                                get regular updates about our upcoming events from <b>GREENIE</b>.
                            </p>
                        </div>
                        <div class="col two">
                            <h1>Loyalties <i class='bx bxs-gift'></i></h1>
                            <p>Loyalties are treats made to members of the greenie community 
                               after their first earnings. <b>GREENIE</b> will notify you as soon as
                               you are eligible for this treat.
                            </p>
                        </div>
                    </div>
                    <section class="users">
                        <!-- USERS LIST AREA COL ONE -->
                        <div class="col one">
                            <div class="search">
                                <span class="text">Select a user to chat</span>
                                <input type="text" placeholder="Enter name to search...">
                                <button> <i class="bx bx-search"></i> </button>
                            </div>
                            <div class="users-list">
                                <a href="#">
                                    <div class="content">
                                        <img src="/img/celebrate.jpg" alt="">
                                        <div class="details">
                                            <span>John Doe</span>
                                            <p>This is a test message</p>
                                        </div>
                                    </div>
                                    <div class="status"> <i class="bx bxs-circle"></i> </div>
                                </a>
                                <a href="#">
                                    <div class="content">
                                        <img src="/img/celebrate.jpg" alt="">
                                        <div class="details">
                                            <span>John Doe</span>
                                            <p>This is a test message</p>
                                        </div>
                                    </div>
                                    <div class="status"> <i class="bx bxs-circle"></i> </div>
                                </a>
                                <a href="#">
                                    <div class="content">
                                        <img src="/img/celebrate.jpg" alt="">
                                        <div class="details">
                                            <span>John Doe</span>
                                            <p>This is a test message</p>
                                        </div>
                                    </div>
                                    <div class="status"> <i class="bx bxs-circle"></i> </div>
                                </a>
                                <a href="#">
                                    <div class="content">
                                        <img src="/img/celebrate.jpg" alt="">
                                        <div class="details">
                                            <span>John Doe</span>
                                            <p>This is a test message</p>
                                        </div>
                                    </div>
                                    <div class="status"> <i class="bx bxs-circle"></i> </div>
                                </a>
                                <a href="#">
                                    <div class="content">
                                        <img src="/img/celebrate.jpg" alt="">
                                        <div class="details">
                                            <span>John Doe</span>
                                            <p>This is a test message</p>
                                        </div>
                                    </div>
                                    <div class="status"> <i class="bx bxs-circle"></i> </div>
                                </a>
                                <a href="#">
                                    <div class="content">
                                        <img src="/img/celebrate.jpg" alt="">
                                        <div class="details">
                                            <span>John Doe</span>
                                            <p>This is a test message</p>
                                        </div>
                                    </div>
                                    <div class="status"> <i class="bx bxs-circle"></i> </div>
                                </a>
                                <a href="#">
                                    <div class="content">
                                        <img src="/img/celebrate.jpg" alt="">
                                        <div class="details">
                                            <span>John Doe</span>
                                            <p>This is a test message</p>
                                        </div>
                                    </div>
                                    <div class="status"> <i class="bx bxs-circle"></i> </div>
                                </a>
                            </div>
                        </div>
                        <!-- USERS CHAT AREA COL TWO -->
                        <div class="col two">
                            <div class="chat-area">
                                <header>
                                    <i class='bx bx-right-arrow-alt'></i>
                                    <img src="/img/celebrate.jpg" alt="">
                                    <div class="details">
                                        <span>John Doe</span>
                                        <p>Active now</p>
                                    </div>
                                </header>
                                <div class="chat-box">
                                    <div class="chat outgoing">
                                        <div class="details">
                                            <p>Lorem ipsum dolor sit amet ipsum dolor sit amet. Lorem ipsum dolor sit, amet consectetur adipisicing.</p>
                                        </div>
                                    </div>
                                    <div class="chat incoming">
                                        <img src="/img/celebrate.jpg" alt="">
                                        <div class="details">
                                            <p>Lorem ipsum dolor sit amet ipsum dolor sit amet. Lorem ipsum dolor sit, amet consectetur adipisicing.</p>
                                        </div>
                                    </div>
                                    <div class="chat outgoing">
                                        <div class="details">
                                            <p>Lorem ipsum dolor sit amet ipsum dolor sit amet. Lorem ipsum dolor sit, amet consectetur adipisicing.</p>
                                        </div>
                                    </div>
                                    <div class="chat incoming">
                                        <img src="/img/celebrate.jpg" alt="">
                                        <div class="details">
                                            <p>Lorem ipsum dolor sit amet ipsum dolor sit amet. Lorem ipsum dolor sit, amet consectetur adipisicing.</p>
                                        </div>
                                    </div>
                                    <div class="chat outgoing">
                                        <div class="details">
                                            <p>Lorem ipsum dolor sit amet ipsum dolor sit amet. Lorem ipsum dolor sit, amet consectetur adipisicing.</p>
                                        </div>
                                    </div>
                                    <div class="chat incoming">
                                        <img src="/img/celebrate.jpg" alt="">
                                        <div class="details">
                                            <p>Lorem ipsum dolor sit amet ipsum dolor sit amet. Lorem ipsum dolor sit, amet consectetur adipisicing.</p>
                                        </div>
                                    </div>
                                </div>
                                <form action="" method="post" class="typing-area">
                                    <input type="text" placeholder="Type a message here...">
                                    <button> <i class="bx bx-right-arrow-alt"></i> </button>
                                </form>
                            </div>
                        </div>
                    </section>
                </section>
                <!-- TREES -->
                <section id="trees" class="menu">
                    <div class="data">
                        <div class="col">
                            <h2>DATA <i class='bx bx-right-arrow-alt'></i></h2>
                        </div>
                        <div class="col">
                            <span>0</span>
                            <h1>TREES SOLD</h1>
                        </div>
                        <div class="col">
                            <span>0</span>
                            <h1>TREES POSTED FOR SALE</h1>
                        </div>
                        <div class="col">
                            <span>0</span>
                            <h1>TREES BOUGHT</h1>
                        </div>
                        <div class="col side">
                            <p>Hey there!, you can buy trees from greenie stores by clicking
                                <a href="store/tree.php" target="_blank">Greenie Tree Store.</a>
                            </p>
                        </div>
                    </div>
                    <!-- SELL TREE SECTION -->
                    <div class="make-sales">
                        <form action="" method="post">
                            <div class="path">
                                <Label>Tree Name *</Label>
                                <input type="text" class="control" name="treename" placeholder="Tree name" required>
                                <Label>Tree Price *</Label>
                                <input type="number" class="control" name="treeprice" min="0" placeholder="Tree price --(note that all transactions are in dollar)--" required>
                                <Label>Tree Image *</Label>
                                <input type="file" class="control" name="treeimage" required>
                            </div>
                            <div class="path">
                                <Label>Features *</Label>
                                <textarea name="treefeatures" cols="30" rows="8" placeholder="Features and Description" required></textarea>
                                <input type="submit" class="log" name="sale" value="UPLOAD TO SELL NOW">
                            </div>
                        </form>
                    </div>
                </section>
                <!-- PAY METHOD -->
                <section id="paymethod" class="menu">
                    <div class="data">
                        <div class="col">
                            <h2>DATA <i class='bx bx-right-arrow-alt'></i></h2>
                        </div>
                        <div class="col">
                            <span>0</span>
                            <h1>TOTAL EARNINGS</h1>
                        </div>
                        <div class="col">
                            <span>0</span>
                            <h1>CURRENT EARNINGS</h1>
                        </div>
                        <div class="col">
                            <span>0</span>
                            <h1>WITHDRAWALS</h1>
                        </div>
                        <div class="col">
                            <span>0</span>
                            <h1>DONATIONS</h1>
                        </div>
                        <div class="col side">
                            <p>Hey there! Please note that your withdrawal may take sometime. If you
                                don't get your funds after 24hrs, please do contact support or write
                                a mail to Greenie.
                            </p>
                        </div>
                    </div>
                    <!-- WITHDRAW SECTION -->
                    <div class="withdraw">
                        <form action="" method="post">
                            <div class="path">
                                <Label>Amount *</Label>
                                <input type="number" class="control" name="amount" min="0" placeholder="Withdraw amount --(note that all transactions are in dollar)--" required>
                            </div>
                            <input type="submit" class="log" name="withdraw" value="WITHDRAW">
                        </form>
                    </div>
                    <!-- CHOOSE SECTION -->
                    <h1 class="select" >Select your prefered payment method</h1>
                    <div class="choose">
                        <form action="" method="post">
                            <div class="path">
                                <input type="hidden" class="control" name="paymethod" value="Bitcoin" required>
                                <Label>BITCOIN *</Label>
                                <input type="text" class="control" name="walletadd"  placeholder="Wallet Address" required>
                                <input type="submit" class="log" name="choose" value="OKAY">
                            </div>
                        </form>
                        <form action="" method="post">
                            <div class="path">
                                <input type="hidden" class="control" name="paymethod" value="Bank" required>
                                <Label>Bank Name *</Label>
                                <input type="text" class="control" name="bankname" placeholder="Bank Name" required>
                                <Label>Account Name *</Label>
                                <input type="text" class="control" name="accname" placeholder="Account Name" required>
                                <Label>Account Number *</Label>
                                <input type="text" class="control" name="accnumber" placeholder="Account Number" required>
                                <input type="submit" class="log" name="choose" value="OKAY">
                            </div>
                        </form>
                        <form action="" method="post">
                            <div class="path">
                                <input type="hidden" class="control" name="paymethod" value="Etherum" required>
                                <Label>ETHERUM *</Label>
                                <input type="text" class="control" name="walletadd"  placeholder="Wallet Address" required>
                                <input type="submit" class="log" name="choose" value="OKAY">
                            </div>
                        </form>
                    </div>
                </section>
                <!-- DONATE -->
                <section id="donate" class="menu">
                    <div class="donation">
                        <form action="" method="post">
                            <div class="path">
                                <Label>Name *</Label>
                                <input type="text" class="control" name="name" placeholder="Name" required>
                                <Label>Address *</Label>
                                <input type="text" class="control" name="address" placeholder="Address" required>
                                <Label>Email *</Label>
                                <input type="email" class="control" name="email" placeholder="Email" required>
                                <Label>City *</Label>
                                <input type="text" class="control" name="city" placeholder="City" required>
                            </div>
                            <div class="path">
                                <?php include "include/country.php"?>
                                <Label>Amount *</Label>
                                <input type="number" class="control" min="0" name="amount" placeholder="Amount --(all transactions are in dollar)--" required>
                                <input type="submit" class="log" name="donate" value="Donate Now">
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
        
        <!-- javascript files and libraries -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="js/dash.js"></script>
    </body>
</html>