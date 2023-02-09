<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<!-- Navbar star here -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#app">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="app">
      <ul class="navbar-nav ms-auto">
        
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Home</a>
        </li>
        <?php
        if(isset($_SESSION['login-user'])){
        ?>
        <li class="nav-item">
          <a class="nav-link active" href="allusers.php">All users</a>
        </li>
        <?php
        }
        if(!isset($_SESSION['login-user'])){
        ?>
        <li class="nav-item">
          <a class="nav-link active" href="sign-up.php">Sign up</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="log-in.php">Log In</a>
        </li>
        <?php }
        if(isset($_SESSION['login-user'])){
          ?>
        <li class="nav-item">
          <a class="nav-link active" href="log-out.php">Log Out</a>
        </li>
        <?php }?>
      </ul>
    </div>
  </div>
</nav>