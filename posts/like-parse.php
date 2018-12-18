<?php
session_start();
include "../init/config.php";

//
if ($_GET['pid']) {
  $id = $_GET['pid'];
  $tableCol = post_id;
} elseif ($_GET['rid']) {
  $id = $_GET['rid'];
  $tableCol = reply_id;
} else {
  echo "Something went wrong.";
}


//First check if the user has already liked or disliked
$uid = $_SESSION['username'];
$sqlCheck = "SELECT * FROM likes WHERE username='$uid' AND $tableCol='$id' ";
$resCheck = mysqli_query($conn, $sqlCheck);

if (mysqli_num_rows($resCheck) > 0) { //the option to overwrite current vote if the user has alredy voted
  if (isset($_POST['like'])) {
    $sql2 = "UPDATE likes SET like_dislike = '1' WHERE username='$uid' AND $tableCol='$id' ";
    $res2 = mysqli_query($conn, $sql2);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  } elseif (isset($_POST['dislike'])) {
    $sql2 = "UPDATE likes SET like_dislike = '-1' WHERE username='$uid' AND $tableCol='$id' ";
    $res2 = mysqli_query($conn, $sql2);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }

} else { //if the user hasn't liked/disliked, then push the like to the likes table
  if (isset($_POST['like'])) {
    $sql = "INSERT INTO likes ($tableCol, username, like_dislike) VALUES ('{$id}', '{$uid}', '1')";
    $res = mysqli_query($conn, $sql);
    if ($res) {
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  } elseif (isset($_POST['dislike'])) {
    $sql = "INSERT INTO likes ($tableCol, username, like_dislike) VALUES ('{$id}', '{$uid}', '-1')";
    $res = mysqli_query($conn, $sql);
    if ($res) {
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }
}

?>
