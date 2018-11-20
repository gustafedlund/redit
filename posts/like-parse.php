<?php
session_start();
include "../init/config.php";

//Did the user like or dislike?
if (isset($_GET['like'])) {
  $pid = $_GET['like'];
} elseif (isset($_GET['dislike'])) {
  $pid = $_GET['dislike'];
}

//First check if the user has already liked or disliked
$uid = $_SESSION['username'];
$sqlCheck = "SELECT * FROM likes WHERE username='$uid' AND post_id='$pid' ";
$resCheck = mysqli_query($conn, $sqlCheck);

if (mysqli_num_rows($resCheck) > 0) { //the option to overwrite current vote if the user has alredy voted
  if (isset($_GET['like'])) {
    $sql2 = "UPDATE likes SET like_dislike = '1' WHERE username='$uid' AND post_id='$pid' ";
    $res2 = mysqli_query($conn, $sql2);
    header("Location: ../index.php?post-like=success");
  } elseif (isset($_GET['dislike'])) {
    $sql2 = "UPDATE likes SET like_dislike = '-1' WHERE username='$uid' AND post_id='$pid' ";
    $res2 = mysqli_query($conn, $sql2);
    header("Location: ../index.php?post-dislike=success");
  }

} else { //if the user hasn't liked/disliked, then push the like to the likes table
  if (isset($_GET['like'])) {
    $sql = "INSERT INTO likes (post_id, username, like_dislike) VALUES ('{$pid}', '{$uid}', '1')";
    $res = mysqli_query($conn, $sql);
    if ($res) {
      header("Location: ../index.php?post-like=success");
    } else {
      header("Location: ../index.php?post-like=failure");
    }
  } elseif (isset($_GET['dislike'])) {
    $sql = "INSERT INTO likes (post_id, username, like_dislike) VALUES ('{$pid}', '{$uid}', '-1')";
    $res = mysqli_query($conn, $sql);
    if ($res) {
      header("Location: ../index.php?post-dislike=success");
    } else {
      header("Location: ../index.php?post-dislike=failure");
    }
  }
}

?>
