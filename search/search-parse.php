<?php
session_start();
if ($_SESSION['loggedin'] !== TRUE) {
  header('Location: ../landingpage/login.php');
}
require "../init/config.php";
require "../init/header.php";
require "../init/sidebar.php";








 ?>
