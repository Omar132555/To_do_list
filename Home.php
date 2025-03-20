<?php
require 'vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
$jwt = $_COOKIE['token']; // Important to define jwt from cookie
$key ='yZBD38+kHlsUqroZWx02vymp4E6lq3KWfyObDDSw2X8=';
$decoded = JWT::decode($jwt, new key( $key,'HS256' ));
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    setcookie("token",$jwt,time()-3600,"/","", true, true);
    header("location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <ul>
            <li><img src="image/image2.png" alt="menu"></li>
            <li><a href="home.php">Home</a></li>
            <li><a href="Login.php">Login</a></li>
            <li><a href="Register.php">Register</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <!-- Left Section -->
        <div class="left-section">
            
            <h1>Welcome <?=$decoded -> data -> username?></h1>
            <p >Your To DO List</p>
            <p style="margin-top:10px; font-weight:200; font-size:20px; display:block;">Lorem ipsum dolor sit amet consectetur adipisicing elit. A maiores cumque quibusdam rem labore itaque ducimus hic, atque facere beatae eaque id corporis neque nostrum, reiciendis, ratione harum sapiente minus?</p>
            <form action="Home.php" method ="POST">
            <button type = "submit">Logut</button>
            </form>
        </div>
        <!-- Right Section -->
        <div class="right-section">
            <img src="image/i.png" alt="">
        </div>
    </div>