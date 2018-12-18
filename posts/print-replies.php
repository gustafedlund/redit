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
    $category = $rows['post_category'];
    $replies = $rows['post_replies'];
    $image = $rows['post_img'];
    $date = $rows['post_date'];
    $views = $rows['post_views'];
    //Section for calculating likes on each post and inserting it into post_likes
    $sqlLikes = "SELECT SUM(like_dislike) AS likes FROM likes WHERE post_id='$pid' ";
    $resLikes = mysqli_query($conn, $sqlLikes);
    $rowLikes = mysqli_fetch_assoc($resLikes);
    $totLikes = $rowLikes['likes'];
    $sqlLikes2 = mysqli_query($conn, "UPDATE posts SET post_likes='$totLikes' WHERE post_id='$pid' ");
    $likes = $totLikes;
    //Pushing HTML into the variable down here
    $printOp .= "<div class = 'printed-post-frame'>";
      $printOp .= "<div class = 'post-left'>";
        $printOp .= "<h2 class = 'printed-post-title'>$title</h2>";
        $printOp .= "<p class = 'printed-post-content'>$content</p>";
        if ($image != NULL) {
          $printOp .= "<img src='../posts/uploads/$image' class='post_img' alt='bild till tråden' />";
        }
      $printOp .= "</div>";

    $printOp .= "<div class='post-right'>";
      $printOp .= "<form action='like-parse.php?pid=$pid' name='likeform' method='POST'>";
      $printOp .= "<input class='upvote' type = 'submit' name ='like'/>";
      $printOp .=  "<span class='post_rating printed-post-likes'>$likes</span>";
      $printOp .= "<input class='downvote' type = 'submit' name ='dislike'/></form>";
    $printOp .= "</div>";

    $printOp .= "<div class='post-info'>";
      $printOp .= "<a href='xx.php' class='links'> $category </a> <span class='divider'>/</span>";
      $printOp .= "<span class='no_of_comments'> $replies </span><span class='comment_symbol'></span> <span class='divider'>/</span>";
      $printOp .= "<span class='no_of_views'> $views </span><span class='view_symbol'></span> <span class='divider'>/</span>";
      $printOp .= "<a class='links' href='../userpage/userpage.php?username=$creator' class='author'>$creator</a> <span class='divider'>/</span>";
    $printOp .= "<span class='date_posted'>$date</span><span class='divider'>/</span>";

    if ($_SESSION['admin'] == 1) {
        $printReplies .= "<form method='post' action='../posts/delete-posts.php'><input type='submit' name='delete' value='Delete post'></input></form>";
    }
    $printOp .= "</div>";
  $printOp .= "</div>";

    //write comment
    $printOp .= "<div class = 'write-comment'>";
      $printOp .= "<form action='write-comment.php?pid=$pid' name='commentform' method='POST'>";
        $printOp .= "<input class='write-comment-field' type='text' placeholder='Vad tycker du?' name='comment'>";
        $printOp .= "<input class='write-comment-submit' type='submit' name='submit-comment'></form>";
    $printOp .= "</div>";
  }
}

$sql2 = "SELECT * FROM replies WHERE post_id='$pid' ORDER BY reply_date DESC ";
$res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

$printReplies = "";

if (mysqli_num_rows($res2) > 0) {
  while($rows2 = mysqli_fetch_assoc($res2)) {
    $rid = $rows2['reply_id'];
    $replyCreator = $rows2['reply_creator'];
    $replyContent = $rows2['reply_content'];
    $replyDate = $rows2['reply_date'];
    //Sum array of total likes on this comment
    $sqlLikes3 = "SELECT SUM(like_dislike) AS likes FROM likes WHERE reply_id='$rid' ";
    $resLikes2 = mysqli_query($conn, $sqlLikes3);
    $rowLikes2 = mysqli_fetch_assoc($resLikes2);
    $totLikes2 = $rowLikes2['likes'];
    $sqlLikes4 = mysqli_query($conn, "UPDATE replies SET reply_likes='$totLikes2' WHERE reply_id='$rid' ");
    $replyLikes = $totLikes2;

    $printReplies .= "<div class = 'printed-post-frame'>";

        $printReplies .= "<div class='post-left'>";
          $printReplies .= "<p class='printed-post-content'> $replyContent </p>";
        $printReplies .= "</div>";

        $printReplies .= "<div class='post-right'>";
          $printReplies .= "<form action='like-parse.php?rid=$rid' name='likeform' method='POST'>";
          $printReplies .= "<input class='upvote' type = 'submit' name ='like'/>";
          $printReplies .=  "<span class='post_rating printed-post-likes'>$replyLikes</span>";
          $printReplies .= "<input class='downvote' type = 'submit' name ='dislike'/></form>";
        $printReplies .= "</div>";

    $printReplies .= "<div class='post-info'>";
      $printReplies .= "<a class='links' href='../userpage/userpage.php?username=$replyCreator' class='author'>$replyCreator</a> <span class='divider'>/</span>";
      $printReplies .= "<span class='date_posted'>$replyDate</span><span class='divider'>/</span>";

      if ($_SESSION['admin'] == 1) {
          $printReplies .= "<form method='post' action='../posts/delete-posts.php'><input type='submit' name='delete' value='Delete post'></input></form>";
      }
    $printReplies .= "</div>";

   $printReplies .= "</div>";

  }
} else {
//What if there are no comments?
}
