<?php
require "./init/config.php";

$sql = "SELECT * FROM posts ORDER BY post_date DESC";
$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

$printPosts = ""; // We push html to be printed into this variable

if (mysqli_num_rows($res) > 0) {
  while ($rows = mysqli_fetch_assoc($res)) { // Fetch printable information from every row (post)
    $id = $rows['post_id'];
    $title = $rows['post_title'];
    $category = $rows['post_category'];
    $creator = $rows['post_creator'];
    $content = $rows['post_content'];
    $date = $rows['post_date'];
    $views = $rows['post_views'];
    $likes = $rows['post_likes'];
    $replies = $rows['post_replies'];

    //Pushing HTML into the variable down here
    $printPosts .= "<div class = 'printed-post-frame'>";

      $printPosts .= "<a href='posts/show-post.php?pid=$id' class='post-link'>";
        $printPosts .= "<div class='post-left'>";
          $printPosts .= "<h2 class='printed-post-title'> $title </h2>";
          $printPosts .= "<p class='printed-post-content'> $content </p>";
        $printPosts .= "</div>";
      $printPosts .= "</a>";

      $printPosts .= "<div class='post-right'>";
          $printPosts .= "<span class='upvote'></span>";
          $printPosts .=  "<span class='post_rating printed-post-likes'>$likes</span>";
          $printPosts .= "<span class='downvote'></span>";
      $printPosts .= "</div>";

      $printPosts .= "<div class='post-info'>";
        $printPosts .= "<a href='xx.php' class='links'> $category </a> <span class='divider'>/</span>";
        $printPosts .= "<span class='no_of_comments'> $replies </span><span class='comment_symbol'></span> <span class='divider'>/</span>";
        $printPosts .= "<span class='no_of_views'> $views </span><span class='view_symbol'></span> <span class='divider'>/</span>";
        $printPosts .= "<a class='links' href='../userpage/userpage.php?username=$creator' class='author'>$creator</a> <span class='divider'>/</span>";
        $printPosts .= "<span class='date_posted'>$date</span><span class='divider'>/</span>";

        if ($_SESSION['admin'] == 1) {
            $printPosts .= "<form method='post' action='posts/delete-posts.php'><input type='submit' name='delete' value='Delete post'></input></form>";
        }
      $printPosts .= "</div>";

    $printPosts .= "</div>";
  }
} else {
  // code...
}


?>
