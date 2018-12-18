<?php

session_start();
require "../init/config.php";

if(isset($_GET['delete'])) {
  $post_id = $_GET['delete'];
  $query = "DELETE FROM posts WHERE post_id = '$post_id'";
  $result = mysqli_query($conn, $query);
  if ($result) {
    header("Location: ../home/index.php?postdeleted=" . $post_id . "");
  }
}

if(isset($_GET['rid'])) {
  $reply_id = $_GET['rid'];
  $query = "DELETE FROM replies WHERE reply_id = '$reply_id'";
  $result = mysqli_query($conn, $query);
  if ($result) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

?>
