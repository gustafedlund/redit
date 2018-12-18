<?php
session_start();

if (isset($_POST['submit-comment'])) {
  include "../init/config.php";
  $pid = $_GET['pid'];
  $user = $_SESSION['username'];
  $content = mysqli_real_escape_string($conn, $_POST['comment']);
  $content = htmlentities($content);

  $sql = "INSERT INTO replies (post_id, reply_creator, reply_content, reply_date) VALUES ('$pid', '$user', '$content', now())";
  $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

  if ($res) { //If it was successfully posted then
    header("Location: show-post.php?pid=$pid?comment=posted");
    exit();

  } else {
    echo "Something went wrong, please try again.";
  }

} else {
  echo "You are not allowed to do this.";
}
