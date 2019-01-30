<?php

if(isset($_SESSION['user_ip']) === false) {
  $_SESSION['last_ip'] = $_SERVER['REMOTE_ADDR'];
}
if($_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR']) {
  session_unset();
  session_destroy();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="../styles/posts.css" type="text/css">
  <link rel="stylesheet" href="../styles/main.css" type="text/css">
  <link rel="stylesheet" href="../styles/start.css" type="text/css">
  <link rel="stylesheet" href="../styles/userpage.css" type="text/css">


  <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">

  <title>Redit</title>

</head>
