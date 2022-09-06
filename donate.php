<?php include_once "include/head.php"?>
  <body>
    <!-- HEADER SECTION -->
    <?php include_once "include/header.php"?>
    <!-- BODY SECTION -->
    <section class="top">
        <div class="top-body">
            <h1>GREENIE</h1>
            <p>Trees brings Light!</p>
            <p>Our World needs more trees</p>
            <p>Trees have supported and sustained life throughout our existence. </p>
        </div>
    </section>
    <!-- DONATION SECTION -->
    <section class="cover">
        <section class="don page">
            <div class="don-top">
                <img src="img/donate.jpg" alt="">
                <h1>DONATIONS</h1>
            </div>
            <p>Trees have supported and sustained life throughout our existence. They have a wide
                variety of practical and commercial uses. Did you know the bark of some trees can
                be made into cork and is a source of chemicals and medicines? Quinine and aspirin
                are both made from bark extracts. The inner bark of some trees contains latex, the
                main ingredient of rubber. How many more uses can you name?
                That’s why the more trees are out there, the better. Unfortunately, as areas of 
                forest the size of a football pitch are being lost every minute, we’re yet to get
                to the right track when it comes to forest protection and management. It is so 
                important that things go right. Support <b>GREENIE</b> by making donations today.
                Let's get it right this time!. 
            </p>
        </section>
        <!-- DONATE FORM SECTION -->
        <section class="form donate">
            <p>Your <span>SUPPORT</span> brings us closer to the goal.</p>
            <form action="" method="post">
                <input type="text" class="control" placeholder="Name" required>
                <input type="text" class="control" placeholder="Address" required>
                <input type="text" class="control" placeholder="City" required>
                <input type="text" class="control" placeholder="Country" required>
                <input type="email" class="control" placeholder="Email" required>
                <input type="number" min=0 class="control" placeholder="Donation Amount" required>
                <input type="submit" class="btn" value="Donate Now">
            </form>
        </section>
    </section>
    <!-- FOOTER SECTION -->
    <?php include_once "include/footer.php"?>

    <!-- javascript files and libraries -->
    <script type="text/javascript" src="js/index.js"></script>
  </body>
</html>