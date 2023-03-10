<?php
session_start();
if(!isset($_SESSION['login-user'])){
    header("location: sign-up.php");
}
if(!isset($_COOKIE['login-user'])){
    header("location: log-out.php");
}
setcookie('login-user','yes',time()+10800,'/');
require_once 'db.php';


$query = "SELECT id,fname,lname,email,status,photo FROM users ORDER BY id DESC";
$result = mysqli_query($conn,$query);


if(mysqli_num_rows($result) > 0 ){
    $users = mysqli_fetch_all($result,true);

}

require_once 'inc/header.php';
?>

<section class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>All Users</h2>
                <table class="table table-hover table-striped">
                    <tr class="table-dark">
                        <th>Id</th>
                        <th>Photo</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    <?php
                    foreach($users as $user){
                    ?>
                    <tr>
                        <td><?= $user['id']; ?></td>
                        <td>
                            <img src="uploads/profile/<?= $user['photo']; ?>" alt="<?= $user['fname'];?>" width="80">
                        </td>
                        <td><?= $user['fname'];?></td>
                        <td><?= $user['lname']; ?></td>
                        <td><?= $user['email']; ?></td>
                        <!-- <td><?= $user['status']; ?></td> -->
                        <td>
                            <span class="badge <?=$user['status']==1 ? "bg-success" : "bg-warning"?>">
                                <?= $user['status']==1 ? "Active" : "Deactive"?>
                            </span>
                        </td>
                        <td>
                            <a href="view.php?id=<?= $user['id']; ?>" class="btn btn-sm btn-primary">View</a>
                            <a href="edit.php?id=<?= $user['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                            <a href="delete.php?id=<?= $user['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                            <a href="status.php?id=<?= $user['id']; ?>" class="btn btn-sm <?=$user['status']==1 ? "bg-warning" : "bg-success"?>"> <?= $user['status']==1 ? "Deactive" : "Active"?></a>
                        </td>
                    </tr>

                    <?php
                    }
                    ?>

                    
                </table>
            </div>
        </div>
    </div>

</section>

<?php
    require_once 'inc/footer.php';
?>