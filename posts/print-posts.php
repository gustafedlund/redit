<?php
require "./init/config.php";

$sql = "SELECT * FROM posts ORDER BY post_date DESC";
$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

$printPosts = ""; // We push html to be printed into this variable

if (mysqli_num_rows($res) > 0) {
  while ($rows = mysqli_fetch_assoc($res)) { // Fetch printable information from every row (post)
    $id = $rows['post_id'];
    $title = $rows['post_title'];
    $creator = $rows['post_creator'];
    $content = $rows['post_content'];
    $date = $rows['post_date'];
    $views = $rows['post_views'];
    $likes = $rows['post_likes'];
    $replies = $rows['post_replies'];

    //Pushing HTML into the variable down here
    $printPosts .= "<a href='posts/show-post.php?pid=$id' class = 'printed-post-frame'>";

      $printPosts .= "<div class='post-right'>";
        $printPosts .= "<span class='upvote'></span>";
        $printPosts .=  "<span class='post_rating printed-post-likes'>$likes</span>";
        $printPosts .= "<span class='downvote'></span>";
      $printPosts .= "</div>";

      $printPosts .= "<div class='post-info'>";
        $printPosts .= "<span class='no_of_comments'> $replies </span><span class='comment_symbol'></span> <span class='divider'>/</span>";
        $printPosts .= "<span class='no_of_views'> $views </span><span class='view_symbol'></span> <span class='divider'>/</span>";
        $printPosts .= "<a href='../userpage/userpage.php?username=$creator' class='author'>$creator</a> <span class='divider'>/</span>";
        $printPosts .= "<span class='date_posted'>$date</span>";
      $printPosts .= "</div>";

    $printPosts .= "</a>";
  }
} else {
  // code...
}


?>
</div>
