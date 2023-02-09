<?php
session_start();
require_once 'db.php';
$error = [];

if (isset($_POST['submit'])) {
    $email = trim(htmlentities($_POST['email']));
    $password = trim(htmlentities($_POST['password']));
    $encpass=md5($password);

    $query = "SELECT fname,lname,photo,email,password FROM users WHERE email = '$email' AND password='$encpass' ";
    $result = mysqli_query($conn,$query);

  
    if(mysqli_num_rows($result) > 0 ){
     header("location: allusers.php");
    $user = mysqli_fetch_assoc($result);
    unset($user['password']);
    $_SESSION['login-user']=$user; 
    setcookie('login-user','yes',time()+10800,'/');

    }else{
        header("location: sign-up.php");
    }
}
