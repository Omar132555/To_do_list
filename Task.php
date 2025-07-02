<?php
require 'vendor/autoload.php';
if(!isset($_COOKIE['token']))
{
    header("Location: Login.php");
    exit();
}
include_once("Functions.php");
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

$jwt = $_COOKIE['token']; // Important to define jwt from cookie
$key ='yZBD38+kHlsUqroZWx02vymp4E6lq3KWfyObDDSw2X8='; // - This is User Autherization -
$decoded = JWT::decode($jwt, new key( $key,'HS256' ));
$status = "";
$user=[];
$submited = false;
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $task_desc = "";
    $task_name = "";
    
    $task_name = $_POST['task_name'];
    $task_desc = $_POST['task_name'];
    if(!empty($task_name))
    {
    if(isset($_POST['checkbox']))
    {
        $checked = 1;
        Task_check($checked);
    }
    else
    {
        $checked = 0;
        Task_check($checked);
    }
    if(isset($_POST['submited']) && !$submited)
    {
        Add_task($task_name, $task_desc, $checked);
    }
    display();
    unset($_POST['submited']);
    $submited = true;
    }
    else{
        echo "<div style='width: 200px;height:auto;'>Enter Task Name</div>";
    }
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <ul>
            <li><img src="image/image2.png" alt="menu"></li>
            <li><a href="home.php">Home</a></li>
            <li><a href="Login.php">Login</a></li>
            <li><a href="Register.php">Register</a></li>
            <li><a href="Task.php">Tasks</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <!-- Left Section -->
        <div >
            <form action="Task.php" method ="POST">
                <?php
                if(empty($_POST['task_name']))
                ?>
                <table  style="background-color: transparent;">
                    <thead class="table-light">
                        <th><h3>Check</h3></th>
                        <th><h3>Task Name</h3></th>
                        <th><h3>Task Name</h3></th>
                        <th><h3>Status</h3></th>
                    </thead>
                    <tr>
                        <td>
                            <input type="checkbox" name="checkbox" class="checkbox">
                        </td>
                        <td><input type="text" name = "task_name" style="width: auto; height:20px"></td>
                        <td></td>
                        <td></td>
                        <td><div><input type="submit" name="submited" class="submitbtn" value="Add"></div></td>
                        <td>
                            <?php 
                            if(isset($user))
                            {
                                foreach($user as $row)
                            {
                                print_r($row['Task_name']."\n");
                            }
                            }
                            ?>
                        </td>
                        <td></td>
                    </tr>
                </table>
            </form>
        </div>
        <!-- Right Section -->
        <div class="right-section">
            <img src="image/i.png" alt="">
        </div>
    </div>