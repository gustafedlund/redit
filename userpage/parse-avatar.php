<?php

session_start();

$user = $_SESSION['username'];

require '../init/config.php';

if (isset($_POST['submit'])) {
  $file = $_FILES['file'];

  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg', 'jpeg', 'png', 'gif');

  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
      if ($fileSize < 100000) {
        $fileNameNew = "avatar_". $_SESSION['username'] . "." . $fileActualExt;
        $fileDestination = '../uploads/upload_avatar/' . $fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);

        $sql = "UPDATE users SET avatar='$fileNameNew' WHERE username='$user'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
          header('Location: ./userpage.php?success');
        }
      } else {
        header('Location: ./userpage.php?error=filesize');
        exit();
      }
    } else {
      header('Location: ./userpage.php?error=uploaderr');
      exit();
    }
  } else {
    header('Location: ./userpage.php?error=filetype');
    exit();
  }
}

 ?>
