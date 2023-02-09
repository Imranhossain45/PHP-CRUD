<?php
session_start();
if(!isset($_SESSION['login-user'])){
    header("location: sign-up.php");
}

require_once 'db.php';

$id = $_GET['id'];

//Delete users

if((int)$id && !empty($id)){
    

    $query = "DELETE FROM users WHERE id = $id";
    $result = mysqli_query($conn,$query);
    header("location: allusers.php");

}