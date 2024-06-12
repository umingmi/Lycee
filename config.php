<?php
    session_start();
    $conn = mysqli_connect("localhost","root","","lyceedb");

    if (!$conn){
        die("connection failed: " . mysqli_connect_error());
    }
?>

