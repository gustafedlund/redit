<?php

$db_host = '127.0.0.1';
$db_username = 'root';
$db_password = 'root';
$db_name = 'redit';

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

if(!$conn) {
  die("connection failed: " . mysqli_connect_error());
}

date_default_timezone_set("Europe/Stockholm");

if(isset($_SESSION['user_ip']) === false) {
  $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
}
if($_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR']) {
  session_unset();
  session_destroy();
}

?>
