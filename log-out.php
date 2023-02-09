<?php
session_start();

unset($_SESSION['login-user']);

header("location: log-in.php");