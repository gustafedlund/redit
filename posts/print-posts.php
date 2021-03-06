<?php
session_start();
require "../init/config.php";

//URI category=x, sort=y : no sort = sort by latest, sort = sort by post rating
$currentCategory = $_GET['category']; //GETS CATEGORY THROUGH 'GET', THIS WAY THE SORTING WILL WORK EVEN WHEN ADDING NEW ONES!

if(isset($_GET['category']) && !isset($_GET['sort'])) {
  $sql = "SELECT * FROM posts WHERE post_category='$currentCategory' ORDER BY post_date DESC";
} elseif (isset($_GET['category']) && isset($_GET['sort'])) {
  $sql = "SELECT * FROM posts WHERE post_category='$currentCategory' ORDER BY post_likes DESC";
} elseif (!isset($_GET['category']) && !isset($_GET['sort'])) {
  $sql = "SELECT * FROM posts ORDER BY post_date DESC";
} else {
  $sql = "SELECT * FROM posts ORDER BY post_likes DESC";
}

$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

$printPosts = ""; // We push html to be printed into this variable

if (mysqli_num_rows($res) > 0) {
  while ($rows = mysqli_fetch_assoc($res)) { // Fetch printable information from every row (post)
    $id = $rows['post_id'];
    $title = $rows['post_title'];
    $category = $rows['post_category'];
    $category_link = "../home/index.php?category=$category";
    $creator = $rows['post_creator'];
    $content = $rows['post_content'];
    $image = $rows['post_img'];
    $date = $rows['post_date'];
    $views = $rows['post_views'];
    $replies = $rows['post_replies'];
    //Section for calculating likes on each post and inserting it into post_likes
    $sqlLikes = "SELECT SUM(like_dislike) AS likes FROM likes WHERE post_id='$id' ";
    $resLikes = mysqli_query($conn, $sqlLikes);
    $rowLikes = mysqli_fetch_assoc($resLikes);
    $totLikes = $rowLikes['likes'];
    $sqlLikes2 = mysqli_query($conn, "UPDATE posts SET post_likes='$totLikes' WHERE post_id='$id' ");
    $likes = $totLikes;
    //Pushing HTML into the variable down here
    $printPosts .= "<div class = 'printed-post-frame'>";

      $printPosts .= "<a href='../posts/show-post.php?pid=$id' class='post-link'>";
        $printPosts .= "<div class='post-left'>";
          $printPosts .= "<h2 class='printed-post-title'> $title </h2>";
          $printPosts .= "<p class='printed-post-content'> $content </p>";
          if ($image != NULL) {
            $printPosts .= "<img src='../posts/uploads/$image' class='post_img' alt='bild till tråden' />";
          }
        $printPosts .= "</div>";
      $printPosts .= "</a>";

      $printPosts .= "<div class='post-right'>";
          /*$printPosts .= "<span class='upvote'></span>";*/
          /*$printPosts .= "<span class='downvote'></span>";*/
          $printPosts .= "<form action='../posts/like-parse.php?pid=$id' name='likeform' method='POST'>";
          $printPosts .= "<input class='upvote' type = 'submit' value=$id name ='like'/>";
          $printPosts .=  "<span class='post_rating printed-post-likes'>$likes</span>";
          $printPosts .= "<input class='downvote' type = 'submit' value=$id name ='dislike'/></form>";
      $printPosts .= "</div>";

      $printPosts .= "<div class='post-info'>";
        $printPosts .= "<a href='$category_link' class='links'> $category </a> <span class='divider'>/</span>";
        $printPosts .= "<span class='no_of_comments'> $replies </span><span class='comment_symbol'></span> <span class='divider'>/</span>";
        $printPosts .= "<span class='no_of_views'> $views </span><span class='view_symbol'></span> <span class='divider'>/</span>";
        $printPosts .= "<a class='links' href='../userpage/user.php?username=$creator' class='author'>$creator</a> <span class='divider'>/</span>";
        $printPosts .= "<span class='date_posted'>$date</span><span class='divider'>/</span>";

        if ($_SESSION['admin'] == 1) {
            $printPosts .= "<form class='deletepost_form' method='post' action='../posts/delete-posts.php?delete=$id' id='admin_deletepost'><input id='delete' type='submit' name='delete' value='ta bort'></input></form>";
        }
      $printPosts .= "</div>";

    $printPosts .= "</div>";
  }
} else {
  // code...
}

//Like funktion


?>
