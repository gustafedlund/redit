<?php
require "../init/config.php";

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
    //Pushing HTML into the variable down here
    $printPosts .= "<a class = 'printed-post-frame'>";
      $printPosts .= "<p class = 'printed-post-title'>$title</p>";
      $printPosts .= "<p class = 'printed-post-content'>$content</p>";
      $printPosts .= "<p class = 'printed-post-creator'>$creator</p>";
      $printPosts .= "<p class = 'printed-post-date'>$date</p>";
      $printPosts .= "<p class = 'printed-post-views'>$views</p>";
      $printPosts .= "<p class = 'printed-post-likes'>$likes</p>";
    $printPosts .= "</a>";


  }
  echo $printPosts;
} else {
  // code...
}


?>
