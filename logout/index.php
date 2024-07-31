<?php
  session_start();
  $_SESSION['logged_in'] = false;  // Set logged_in to false to log out the user.
session_destroy();
header("Location:../index.php");
die();
?>