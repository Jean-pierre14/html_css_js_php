<?php
session_start();
include("./db.php");

$error = array();
$username = '';
$password = '';

if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    if(empty($username)){array_push($error, "The username is empty");}
    if(empty($password)){array_push($error, "The password is empty");}

    if(count($error) == 0){
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $run = mysqli_query($con, $sql);
        
        if(mysqli_num_rows($run)){
            $_SESSION['username'] = $username;
            header("location: home.php");
        }else{
            array_push($error, "wrong username or password");
            $username = '';
            $password = '';
        }
    }

}