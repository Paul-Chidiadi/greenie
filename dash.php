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
                <section id="profile" class="menu active">
                    <div class="profile">
                        <div class="pics">
                            <div class="img" style=" background:url(img/celebrate.jpg) no-repeat center center; background-size: cover;"></div>
                            <h1>JOHN DOE</h1>
                            <small>johndoe@gmail.com</small>
                        </div>
                        <div class="update">
                            <form action="" method="post">
                                <div class="path">
                                    <?php include "include/country.php"?>
                                    <Label>Phone Number *</Label>
                                    <input type="tel" id="phone" class="control phone" name="phone" placeholder="Phone Number" required>
                                    <section>
                                        <Label>Password *</Label>
                                        <input type="password" class="control pass" name="password" placeholder="Password" required>
                                        <div id="toggle" class="show">
                                            <i class='bx bxs-show'></i>
                                            <i class='bx bxs-hide' ></i>
                                        </div>
                                    </section>
                                </div>
                                <div class="path">
                                    <Label>Profile Picture *</Label>
                                    <input type="file" class="control" name="picture" required>
                                    <input type="submit" class="log btn" name="submit" value="UPDATE">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="infos">
                        <div class="part earn">
                            <h1>Earnings <span> 0</span></h1>
                            <p> <span>HOW TO EARN</span><br> Make a 30 seconds video of you planting a tree in your area, showing your face
                                and you are set to earn. GREENIE sees you as an eligible earner when you have made at least five invites
                                and have sold or purchased at least a tree from our <a target="_blank" href="store/tree.php">TREE STORE</a>.
                                An upload earns you <span>4 Greenie Coins,</span> a <span>Greenie Coin</span> is equivalent to a dollar. 
                            </p>
                        </div>
                        <div class="part invite">
                            <h1>Invites <span> 0</span></h1>
                            <p>Invite people to join this community with your link below<br><br>
                                <span id="link">greenie.com/signup.php?johndoe@gmail.com</span>
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
                                <Label>Post a Picture *</Label>
                                <input type="file" class="control" name="picture" required>
                                <input type="submit" class="log" name="upload" value="upload">
                            </div>
                            <div class="path">
                                <Label>What's on your mind? *</Label>
                                <textarea name="posttext" cols="30" rows="5" placeholder="What's on your mind" required></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="prev">
                        <h1>UPLOADS</h1>
                        <div class="items">
                            <div class="rows">
                                <div class="prod">
                                    <img src="img/earn.jpg" alt="">
                                    <a target="_blank" href="img/earn.jpg" class="click">
                                        <i >view</i>
                                    </a>
                                </div>
                                <div class="prod">
                                    <img src="img/earn.jpg" alt="">
                                    <a target="_blank" href="img/earn.jpg" class="click">
                                        <i >view</i>
                                    </a>
                                </div>
                                <div class="prod">
                                    <img src="img/earn.jpg" alt="">
                                    <a target="_blank" href="img/earn.jpg" class="click">
                                        <i >view</i>
                                    </a>
                                </div>
                                <div class="prod">
                                    <img src="img/earn.jpg" alt="">
                                    <a target="_blank" href="img/earn.jpg" class="click">
                                        <i >view</i>
                                    </a>
                                </div>
                                <div class="prod">
                                    <img src="img/earn.jpg" alt="">
                                    <a target="_blank" href="img/earn.jpg" class="click">
                                        <i >view</i>
                                    </a>
                                </div>
                                <div class="prod">
                                    <img src="img/earn.jpg" alt="">
                                    <a target="_blank" href="img/earn.jpg" class="click">
                                        <i >view</i>
                                    </a>
                                </div>
                                <div class="prod">
                                    <img src="img/earn.jpg" alt="">
                                    <a target="_blank" href="img/earn.jpg" class="click">
                                        <i >view</i>
                                    </a>
                                </div>
                                <div class="prod">
                                    <img src="img/earn.jpg" alt="">
                                    <a target="_blank" href="img/earn.jpg" class="click">
                                        <i >view</i>
                                    </a>
                                </div>
                                <div class="prod">
                                    <img src="img/earn.jpg" alt="">
                                    <a target="_blank" href="img/earn.jpg" class="click">
                                        <i >view</i>
                                    </a>
                                </div>
                                <div class="prod">
                                    <img src="img/earn.jpg" alt="">
                                    <a target="_blank" href="img/earn.jpg" class="click">
                                        <i >view</i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- MEET -->
                <section id="meet" class="menu">
                    <div class="events">
                        <div class="col one">
                            <h1>Events <i class='bx bxs-calendar-event'></i></h1><hr>
                            <p>You have no events yet. Subscribe to our news letter to
                                get regular updates about our upcoming events from <b>GREENIE</b>.
                            </p>
                        </div>
                        <div class="col two">
                            <h1>Loyalties <i class='bx bxs-gift'></i></h1><hr>
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
                <section id="trees" class="menu">trees</section>
                <!-- PAY METHOD -->
                <section id="paymethod" class="menu">paymethod</section>
                <!-- DONATE -->
                <section id="donate" class="menu">donate</section>
            </div>
        </div>
        
        <!-- javascript files and libraries -->
        <script type="text/javascript" src="js/dash.js"></script>
    </body>
</html>