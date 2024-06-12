<!DOCTYPE html>
<html>
    <head>
        <title>Lycee</title>
        <!--============== META ===============-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--============== CSS ===============-->
        <link rel="stylesheet" href="styles.css">

        <!--============== REMIX ICON ===============-->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"rel="stylesheet"/>

        <!--============== FONTAWESOME ===============-->
        <script src="https://kit.fontawesome.com/40b126a0f6.js" crossorigin="anonymous"></script>
        
        <!--============== FONT ===============-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Changa+One:ital@0;1&display=swap" rel="stylesheet">
    </head>

    <body>
        <!--============== HEADER ===============-->

        <header class="header">
            <a href="home.php" class="navlogo">
                <i class="ri-outlet-fill"></i><span>Lycee</span>
            </a>
            <ul class="navbar">
                <li><a href="events.php">Home</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="events.php">Clubs</a></li>
                <li><a href="events.php">Departments</a></li>
                <li><a href="events.php">Profile</a></li>
            </ul>
            <div class="menu">
                <i class="ri-menu-fill"></i>
            </div>
        </header>

        <?php 
        @include 'config.php';

        $sql = "SELECT * FROM events";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
            $name = $row["name"];
            $desc = $row["description"];
            $date = $row["date"];
            $img = $row["img"]; 
            ?>

        <div class="cards-container">
            <img src="uploads/<?php echo $img; ?>.jpg">
            <div class="left">
                <p><?php echo $name; ?></p>
                <p><?php echo $desc; ?></p>
            </div>
            <div class="right">
                <p><?php echo $date; ?></p>
            </div>
        </div>
    <?php } ?>
        <div class="footer-main">
            <div class="footer-container">
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms and Condition</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
                <hr>
                <p>© 2024 Lycee All Rights Reserved.  </p>
            </div>
        </div>
        
    </body>
</html>