
<?php

    require_once 'config.php';

    if(isset($_POST["submit"])){
        $uname = $_POST["uname"];
        $pwd = $_POST["pwd"];
        $cpwd = $_POST["cpwd"];
        $duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE uname = '$uname'");

        if (!empty($duplicate) && $duplicate !== true) {
            echo
            "<script> alert('Username already taken!');</script>";
        }
        else{
            if($pwd == $cpwd){
                $query = "INSERT INTO tb_user VALUES('username','password')";
                mysqli_query($conn, $query);
                echo
                "<script> alert('Registration success!');</script>";
            }
            else{
                echo
                "<script> alert('Password does not match!');</script>";
            }
        }
    }
?>

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
        
        <!--============== FONT ===============-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Changa+One:ital@0;1&display=swap" rel="stylesheet">
    </head>

    <body>
        <!--============== HEADER ===============-->
        <header class="header">
            <a href="#" class="navlogo">
                <i class="ri-outlet-fill"></i><span>Lycee</span>
            </a>
            <ul class="navbar">
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php"><button class="reg-btn">Register</button></a></li>
            </ul>
            <div class="menu">
                <i class="ri-menu-fill"></i>
            </div>
        </header>

        <!-- ================= REGSITER ================ -->
        <div class="form-header">
            <div>
                <p id="head">Register</p><br>
                <p id="sub">Ready to see?</p>
            </div>
        </div>
        <div class="form-container" autocomplete="off">
            <form action="" method="post">
                <label for="username">Username</label><br>
                <input type="text" id= "uname" name="uname">
                <br>
                <br>
                <label for="password">Password</label><br>
                <input type="password" id= "pwd" name=" pwd">
                <label for="password">Confirm password</label><br>
                <input type="password" id= "cpwd" name="cpwd">
                <br>
                <p class="tos">By creating an account you are accepting 
                    <br> our Terms of Service and Privacy Policy.</p>
                <button class="form-btn" type="submit" name="submit">Register</button>
                <div class="no-account">
                    <p>Already have an account? <a href="login.php">Login</a> </p>
                </div>
            </form>
        </div>
    </body>
</html>