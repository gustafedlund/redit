<?php

session_start();

require '../init/config.php';

  $target_dir = "../uploads/upload_avatar/";
  $target_file = $target_dir . basename($_FILES["avatar_upload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  $allowed = array('jpg', 'jpeg', 'png', 'gif');

  // is file too large?

  if ($_FILES["avatar_upload"]["size"] > 1000000) {
    header("Location: ./userpage.php?error=toolarge");
    $uploadOk = 0;
    exit();
  }

  // is file the right format?

  if(!in_array($imageFileType, $allowed)) {
    header("Location: ./userpage.php?error=wrongformat");
    $uploadOk = 0;
    exit();
  }

  // is file uploaded?

  if ($uploadOk == 0) {
    header("Location: ./userpage.php?error=notuploadednotok");
    exit();
  }
  else {

    if (move_uploaded_file($_FILES["avatar_upload"]["tmp_name"], $target_file)) {

      $avatar_uploaded = $_FILES["avatar_upload"]["name"];

      $user = $_SESSION['username'];
      $sql = "UPDATE users SET avatar='$avatar_uploaded' WHERE username='$user'";

      $result = mysqli_query($conn, $sql);

      if($result) {
        header("Location: ./userpage.php?success=imageuploaded");
        exit();
      } else {
        header("Location: ./userpage.php?error=notuploadedmove");
        exit();
      }

      exit();
    }
    else {
      header("Location: ./userpage.php?error=notuploaded");
      exit();
    }
  }

 ?>
