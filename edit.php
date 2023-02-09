<?php
session_start();
if(!isset($_SESSION['login-user'])){
    header("location: sign-up.php");
}

require_once 'db.php';

$id = $_GET['id'];

//select users

if((int)$id && !empty($id)){
    

    $query = "SELECT id,fname,lname,email,photo FROM users WHERE id = $id";
    $result = mysqli_query($conn,$query);


    if(mysqli_num_rows($result) > 0 ){
    $user = mysqli_fetch_assoc($result);

    }
}


//update user

$error = [];

if (isset($_POST['submit'])) {
    $fname = trim(htmlentities($_POST['fname']));
    $lname = trim(htmlentities($_POST['lname']));
    $email = trim(htmlentities($_POST['email']));
    
    $image = $_FILES['image']; //change

    //image processing code

    // $imageType = ['jpeg', 'png', 'jpg', 'gif'];

    // $imageExt = explode('.', $image['name']);
    //print_r(end($imageExt));
    // $typeCheck = in_array(strtolower(end($imageExt)), $imageType);
    //image processing code


    if (empty($fname)) {
        $error["fnameErr"] = "*Requird";
    }
    if (empty($lname)) {
        $error["lnameErr"] = "*Requird";
    }
    if (empty($email)) {
        $error["emailErr"] = "*Requird";
    }

    //insert image and remove old image

    if($image['name']){
        $imageExt = explode('.', $image['name']);
        $imageName = $fname.'-'. uniqid().'.'.end($imageExt);

        $imagePath = "uploads/profile/". $user['photo'];
        if(file_exists($imagePath)){
            unlink($imagePath);
        }

        $uploadImage = move_uploaded_file($image['tmp_name'],'uploads/profile/'.$imageName);

        $updateImageQuery = "UPDATE users SET photo = '$imageName' WHERE id = $id";

        $updateImageResult = mysqli_query($conn, $updateImageQuery);

        
    }
    // if (empty($password)) {
    //     $error["passwordErr"] = "*Requird";
    // }
    // if (empty($image)) {
    //     $error["imageErr"] = "*Requird";
    // }

    //image processing code
    // if (empty($image['name'])) {
    //     $error['imageErr'] = 'Select your Image';
    // }else if($typeCheck === false){
    //     $error['imageTypeErr'] = 'Select Valid Image';
    // }else if($image['size']>=200000){
    //     $error['imageSizeErr'] = 'Upload max image size 2 mb';
    // }

    // if(empty($error)){
    //     $imageName = $fname.'-'. uniqid().'.'.end($imageExt);

    //     $uploadImage = move_uploaded_file($image['tmp_name'],'uploads/profile/'.$imageName);
    // }

    //insert all data
    if(empty($error)){

        $updateQuery = "UPDATE users SET fname ='$fname',lname ='$lname',email='$email' WHERE id= $id";

        $updateResult = mysqli_query($conn, $updateQuery);

        if($updateResult){
            echo "
            <script> alert('Data Inserted Successfully!');</script>
        ";
            header('location: allusers.php');
        
        }


    }

};








    require_once 'inc/header.php';

?>





    <section class="mt-5 ">
        <div class="container ">
            <div class="row justify-content-center ">
                <div class="col-lg-8">
                    <!-- <?php
                    if(isset($success)){
                        printf('<div class="alert alert-success"> %s </div>', $success);
                    }
                    ?> -->
                    <div class="card  ">
                        <div class="card-header bg-dark">
                            <h3 class="text-light">Edit User</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="fname" value="<?=$user['fname']?>">
                                    <?php
                                    if (isset($error["fnameErr"])) {
                                        printf('<p class="text-danger"> %s </p>', $error["fnameErr"]);
                                    }
                                    ?>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="lname" value="<?=$user['lname']?>">
                                    <?php

                                    if (isset($error["lnameErr"])) {
                                        printf('<p class="text-danger"> %s </p>', $error["lnameErr"]);
                                    }
                                    ?>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" value="<?=$user['email']?>">
                                    <?php
                                    if (isset($error["emailErr"])) {
                                        printf('<p class="text-danger"> %s </p>', $error["emailErr"]);
                                    }
                                    ?>
                                </div>
                                <!-- <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password">
                                    <?php
                                    if (isset($error["passwordErr"])) {
                                        printf('<p class="text-danger"> %s </p>', $error["passwordErr"]);
                                    }
                                    ?>
                                </div> -->
                                <div class="mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" class="form-control" name="image">
                                    <?php
                                    if (isset($error["imageErr"])) {
                                        printf('<p class="text-danger"> %s </p>', $error["imageErr"]);
                                    }
                                    if (isset($error["imageTypeErr"])) {
                                        printf('<p class="text-danger"> %s </p>', $error["imageTypeErr"]);
                                    }
                                    if (isset($error["imageSizeErr"])) {
                                        printf('<p class="text-danger"> %s </p>', $error["imageSizeErr"]);
                                    }

                                    

                                    // if (empty($image['name'])) {
                                    //     $error['imageErr'] = 'Select your Image';
                                    // }else if($typeCheck === false){
                                    //     $error['imageTypeErr'] = 'Select Valid Image';
                                    // }else if($image['size']>=200000){
                                    //     $error['imageSizeErr'] = 'Upload max image size 2 mb';
                                    // }
                                    // if (isset($error["imageErr"])) {
                                    //     printf('<p class="text-danger"> %s </p>', $error["imageErr"]);
                                    // }
                                    ?>
                                    <img class="mt-3" src="uploads/profile/<?= $user['photo']; ?>" alt="<?= $user['fname'];?>" width="80">
                                </div>
                                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    require_once 'inc/footer.php';