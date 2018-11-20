<?php

require "../init/config.php";

  $user_bio = $_POST['tagline_input'];

  if (empty($user_bio)) {
    header("Location: userpage.php?error=notext");
    exit();
  } elseif (!preg_match("/^[A-Za-zåäöÅÄÖ 0-9]*$/", $user_bio)) {
    header("Location: userpage.php?error=forbiddenchars");
    exit();
  }

  if(!empty($_POST['tagline_input'])) {

    $user = $_SESSION['username'];
    $sql = "UPDATE users SET bio='$user_bio' WHERE username='$user'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      header("Location: userpage.php?success=biochanged");
      exit();
    } else {
      header("Location: userpage.php?error=notchanged");

    }
    exit();
  }


 ?>
