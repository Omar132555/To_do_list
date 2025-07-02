<?php
include_once("Task.php");
require 'vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

$host="localhost:3307";
$user = "root";
$pass = '';
$db_name = "mydatabase";

$jwt = $_COOKIE['token']; // Important to define jwt from cookie
$key ='yZBD38+kHlsUqroZWx02vymp4E6lq3KWfyObDDSw2X8='; // - This is User Autherization -
$decoded = JWT::decode($jwt, new key( $key,'HS256' ));

$connection = new mysqli($host,$user, $pass, $db_name );

function Add_task($task_name, $task_desc, $task_status){
global $connection;
global $task_name;
global $task_desc;
global $task_status;
global $decoded;
global $ID;
$task_status =0;
$ID = $decoded -> data -> ID;

$stmt = $connection->prepare("INSERT INTO to_DO_list (ID ,Task_name, Task_description, Task_status) VALUES (?, ?, ?, ?) ");
$stmt->bind_param('isss',$ID,$task_name, $task_desc, $task_status);
$stmt->execute();
}

function display(){
    global $connection;
    global $status;
    global $user;
    global $task_N;
    global $ID;
    
    $stmt = $connection -> prepare("SELECT * FROM to_do_list Where ID = $ID;");
    $stmt -> execute();
    $result = $stmt -> get_result();
    $user = $result -> fetch_all(MYSQLI_ASSOC);
    // if($user['Task_status'])
    // {
    //     $status = "Checked!";
    // }
    // else
    // {
    //     $status = "UnChecked!";
    // }
    // $task_N = $user['Task_name'];
}
function Task_check($checked)
{
    global $connection;
    global $checked;
    $stmt = $connection -> prepare("UPDATE to_Do_list SET Task_status = ?");
    $stmt ->  bind_param('i', $checked);
    $stmt -> execute();
}

function Update_task($edited_task_name)
{
    global $authenticated;
    $authenticated = isset($ID);
    global $update_type;
    if($authenticated)
    {
        switch($update_type)
        {
            case $task_name:
                $stmt = $connection -> prepare("UPDATE to_Do_list SET task_name = ?");
                $stmt -> bind_param('s', $edited_task_name);
                if($stmt -> execute())
                {
                    echo "Success"; //Alert
                }
                else
                {
                    echo "Fail"; //Alert
                }
                break;
                case $task_desc:
                    $stmt = $connection -> prepare("UPDATE to_Do_list SET task_description = ?");
                    $stmt -> bind_param('s', $edited_task_desc);
                    if($stmt -> execute())
                    {
                        echo "Success"; //Alert
                    }
                    else
                    {
                        echo "Fail"; //Alert
                    }
                    
                    break;
                    case $task_status:
                        $stmt = $connection -> prepare("UPDATE to_Do_list SET task_status = ?");
                        $stmt -> bind_param('s', $edited_task_status);
                        if($stmt -> execute())
                        {
                            echo "Success"; //Alert
                        }
                        else
                        {
                            echo "Fail"; //Alert
                        }

                break;
        }
    }
}

function Delete_task($task_ID)
{
    $stmt = $connection -> prepare("UPDATE to_Do_list SET task_description = ?");
    $stmt -> bind_param('s', $edited_task_desc);
    if($stmt -> execute())
    {
        echo "Success"; //Alert
    }
    else
    {
        echo "Failed";
    }
}
?>