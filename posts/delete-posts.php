<?php
session_start();
require "../init/config.php";

if(isset($_GET['delete'])) {
  $post_id = $_GET['delete'];
  $query = "DELETE FROM posts WHERE post_id = '$post_id'";
  $result = mysqli_query($conn, $query);

  $query2 = "DELETE FROM replies WHERE post_id = '$post_id'";
  $result2 = mysqli_query($conn, $query2);
  if ($result && $result2) {
    header("Location: ../home/index.php?postdeleted=" . $post_id . "");
  }
}

if(isset($_GET['rid'])) {
  $reply_id = $_GET['rid'];
  $post_id = $_GET['pid'];
  $query = "DELETE FROM replies WHERE reply_id = '$reply_id'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    $sql4 = "SELECT * FROM posts WHERE post_id='$post_id'";
    $res4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));

    $data = $res4->fetch_assoc();
    $originalComs = $data['post_replies'];
    $newComms = $originalComs - 1;

    $sql3 = "UPDATE posts SET post_replies = '$newComms' WHERE post_id = '$post_id' ";
    $res3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));

    header('Location: ' . $_SERVER['HTTP_REFERER']);

  }
}

?>
