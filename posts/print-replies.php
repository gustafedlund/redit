<?php
include "../init/config.php";

$pid = $_GET['pid'];
$sql = "SELECT * FROM posts WHERE post_id='$pid' ";
$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

$printOp = ""; // We push html to be printed into this variable

if (mysqli_num_rows($res) > 0) {
  while ($rows = mysqli_fetch_assoc($res)) { // Fetch printable information from every row (post)
    $title = $rows['post_title'];
    $creator = $rows['post_creator'];
    $content = $rows['post_content'];
    $date = $rows['post_date'];
    $views = $rows['post_views'];
    $likes = $rows['post_likes'];
    //Pushing HTML into the variable down here
    $printOp .= "<a class = 'original-post-frame'>";
      $printOp .= "<p class = 'original-post-title'>$title</p>";
      $printOp .= "<p class = 'original-post-content'>$content</p>";
      $printOp .= "<p class = 'original-post-creator'>$creator</p>";
      $printOp .= "<p class = 'original-post-date'>$date</p>";
      $printOp .= "<p class = 'original-post-views'>$views</p>";
      $printOp .= "<p class = 'original-post-likes'>$likes</p>";
    $printOp .= "</a>";
  }
}

$sql2 = "SELECT * FROM replies WHERE post_id='$pid' ORDER BY reply_date DESC ";
$res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

$printReplies = "";

if (mysqli_num_rows($res2) > 0) {
  while($rows2 = mysqli_fetch_assoc($res2)) {
    $replyCreator = $rows2['reply_creator'];
    $replyContent = $rows2['reply_content'];
    $replyDate = $rows2['reply_date'];
    $replyLikes = $rows2['reply_likes'];

    $printReplies .= "<span class = 'reply-frame'> ";
      $printReplies .= "<p class = 'reply-creator'>$replyCreator</p>";
      $printReplies .= "<p class = 'reply-content'>$replyContent</p>";
      $printReplies .= "<p class = 'reply-date'>$replyDate</p>";
      $printReplies .= "<p class = 'reply-likes'>$replyLikes</p>";
    $printReplies .= "</span>";

  }
} else {
  echo "Ingen har kommenterat ännu, bli den första!";
}
