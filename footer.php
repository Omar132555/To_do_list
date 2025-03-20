<?php
require 'vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
a{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
  text-decoration: none;
  padding: 10px 20px;
  font-family: 'Poppins',sans-serif;
  transition: 0.4s;
}
a:hover{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255, 255, 255, 0.788);
  color: #eaf0fb;
  text-align: center;
  text-decoration: none;
  padding: 10px 20px;
  font-family: 'Poppins',sans-serif;
  transition: 0.4s;
}
    </style>
</head>
<body>
    <div style="position: absolute; top:100%; left:42%;">
    <a href="Register.php">Register</a>
    <a href="Login.php">Login</a>
    <?php
    $key ='yZBD38+kHlsUqroZWx02vymp4E6lq3KWfyObDDSw2X8=';
    if(isset($_COOKIE['token']))
      {
        $jwt = $_COOKIE['token'];
        $decoded = JWT::decode($jwt, new key( $key,'HS256' ));
        if($decoded)
        {
          ?><a href="Home.php">Home</a><?php
        }
      }
      else{
        ?><a href="Home.php" disabled style="pointer-events: none; color: gray;">Home</a>
      <?php }?>
    </div>
</body>
</html>