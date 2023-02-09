<?php
session_start();
if (isset($_SESSION['login-user'])) {
    header("location: allusers.php");
}
require_once 'inc/header.php';


?>





<section class="mt-5">
  <div class="container ">
    <div class="row justify-content-center ">
      <div class="col-lg-8">
        <?php
                if (isset($_SESSION['success'])) {
                    printf('<div class="alert alert-success"> %s </div>', $_SESSION['success']);
                }
                ?>
        <div class="card  ">
          <div class="card-header bg-dark">
            <h3 class="text-light">Sign up</h3>
          </div>
          <div class="card-body">
            <form action="sign-up-post.php" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control" name="fname">
                <?php
                                if (isset($_SESSION['error']["fnameErr"])) {
                                    printf('<p class="text-danger"> %s </p>', $_SESSION['error']["fnameErr"]);
                                }
                                ?>
              </div>
              <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lname">
                <?php

                                if (isset($_SESSION['error']["lnameErr"])) {
                                    printf('<p class="text-danger"> %s </p>',  $_SESSION['error']["lnameErr"]);
                                }
                                ?>
              </div>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" name="email">
                <?php
                                if (isset($_SESSION['error']["emailErr"])) {
                                    printf('<p class="text-danger"> %s </p>',  $_SESSION['error']["emailErr"]);
                                }
                                ?>
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
                <?php
                                if (isset($_SESSION['error']["passwordErr"])) {
                                    printf('<p class="text-danger"> %s </p>',  $_SESSION['error']["passwordErr"]);
                                }
                                ?>
              </div>
              <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" class="form-control" name="image">
                <?php
                if (isset($_SESSION['error']["imageErr"])) {
                  printf('<p class="text-danger"> %s </p>',  $_SESSION['error']["imageErr"]);
                                }
                 if (isset($_SESSION['error']["imageTypeErr"])) {
                                    printf('<p class="text-danger"> %s </p>',  $_SESSION['error']["imageTypeErr"]);
                                }
                                if (isset($_SESSION['error']["imageSizeErr"])) {
                                    printf('<p class="text-danger"> %s </p>',  $_SESSION['error']["imageSizeErr"]);
                                }

                                ?>
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
unset($_SESSION['success']);
unset($_SESSION['error']);