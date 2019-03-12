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
  $rid = mysqli_insert_id($conn);
  //Automatically like your posted comment.
  $sql2 = "INSERT INTO likes (reply_id, username, like_dislike) VALUES ('$rid', '$user', '1')";
  $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
  //Increment 'post_replies'
  $sql4 = "SELECT * FROM posts WHERE post_id='$pid'";
  $res4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));
  $data = $res4->fetch_assoc();
  $originalComs = $data['post_replies'];
  $newComms = $originalComs + 1;
  $sql3 = "UPDATE posts SET post_replies = '$newComms' WHERE post_id = '$pid' ";
  $res3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));

  if ($res && $res2 && $res3) { //If it was successfully posted then
    header("Location: show-post.php?pid=$pid");
    exit();

  } else {
    echo "Something went wrong, please try again.";
  }

} else {
  echo "You are not allowed to do this.";
}
