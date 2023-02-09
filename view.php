<?php
session_start();
if(!isset($_SESSION['login-user'])){
    header("location: sign-up.php");
}
     require_once 'db.php';
    require_once 'inc/header.php';
    $id = $_GET['id'];

    //select users

if((int)$id && !empty($id)){
    

    $query = "SELECT id,fname,lname,email,photo FROM users WHERE id = $id";
    $result = mysqli_query($conn,$query);


    if(mysqli_num_rows($result) > 0 ){
    $user = mysqli_fetch_assoc($result);

    }
}

?>





    <section class="mt-5 ">
        <div class="container ">
            <div class="row justify-content-center ">
                <div class="col-lg-8">
                    <div class="card  ">
                        <div class="card-header bg-dark">
                            <h3 class="text-light">User</h3>
                        </div>
                        <div class="card-body"> 
                            <table class="table">
                                <tr>
                                    <td>Id</td>
                                    <td>:</td>
                                    <td><?= $user['id'] ?></td>
                                </tr>
                                <tr>
                                    <td>First Name</td>
                                    <td>:</td>
                                    <td><?= $user['fname'] ?></td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td>:</td>
                                    <td><?= $user['lname'] ?></td>
                                </tr>
                                <tr>
                                    <td>Photo</td>
                                    <td>:</td>
                                    <td><?= $user['photo'] ?></td>
                                </tr>
                            </table>               
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    require_once 'inc/footer.php';