<?php

session_start();
require "../init/config.php";


  $post_id = $_GET['delete'];
  $query = "DELETE FROM posts WHERE post_id = '$post_id'";
  $result = mysqli_query($conn, $query);
  if ($result) {
    header("Location: ../home/index.php?postdeleted=" . $post_id . "");
  }


header("Location: ../home/index.php");

?>
