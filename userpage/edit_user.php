<?php
session_start();
require "../init/config.php";



if($_GET['delete']) {
  $username = $_GET['delete'];
  $query = "DELETE FROM users WHERE username = '$username'";
  $result = mysqli_query($conn, $query);
  if ($result) {
    header("Location: admin_page.php?userdeleted=" . $username . "");
  }
} elseif ($_GET['mod']) {
  $username = $_GET['mod'];
  $query = "SELECT admin FROM users WHERE username='$username'";
  $result = mysqli_query($conn, $query);
  $data = $result->fetch_assoc();
  if (in_array(1, $data)) {
    $query_mod = "UPDATE users SET admin=0 WHERE username='$username'";
  } else {
    $query_mod = "UPDATE users SET admin=1 WHERE username='$username'";
  }

  $result_mod = mysqli_query($conn, $query_mod);
  if ($result_mod) {
    header("Location: admin_page.php?modcreated=" . $username . "");
  }
}
?>
