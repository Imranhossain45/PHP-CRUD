<?php
session_start();
require_once 'db.php';



$error = [];

if (isset($_POST['submit'])) {
    $fname = trim(htmlentities($_POST['fname']));
    $lname = trim(htmlentities($_POST['lname']));
    $email = trim(htmlentities($_POST['email']));
    $password = trim(htmlentities($_POST['password']));
    $md5 = md5($password);
    $image = $_FILES['image']; //change

    //image processing code

    $imageType = ['jpeg', 'png', 'jpg', 'gif'];

    $imageExt = explode('.', $image['name']);
    
    $typeCheck = in_array(strtolower(end($imageExt)), $imageType);
    


    if (empty($fname)) {
        $error["fnameErr"] = "*Requird";
    }
    if (empty($lname)) {
        $error["lnameErr"] = "*Requird";
    }
    if (empty($email)) {
        $error["emailErr"] = "*Requird";
    }
    if (empty($password)) {
        $error["passwordErr"] = "*Requird";
    }
    if (empty($image)) {
        $error["imageErr"] = "*Requird";
    }

    //image processing code
    if (empty($image['name'])) {
        $error['imageErr'] = 'Select your Image';
    } else if ($typeCheck === false) {
        $error['imageTypeErr'] = 'Select Valid Image';
    } else if ($image['size'] >= 2000000) {
        $error['imageSizeErr'] = 'Upload max image size 2 mb';
    }

    if (empty($error)) {
        $imageName = $fname . '-' . uniqid() . '.' . end($imageExt);

        $uploadImage = move_uploaded_file($image['tmp_name'], 'uploads/profile/' . $imageName);
    

    if ($uploadImage) {
        $query = "INSERT INTO users (fname, lname, email, password, photo) VALUES ('$fname','$lname','$email','$md5','$imageName')";

        $result = mysqli_query($conn, $query);


        if ($result) {
            $_SESSION['success']="Insert Succesfully!";
           
        }

        
    }
    
    }
    
    else{
        $_SESSION['error'] = $error;
    }
}
header("location: sign-up.php");
