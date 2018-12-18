<?php
  session_start();
  if ($_SESSION['loggedin'] !== TRUE) {
    header('Location: ../landingpage/login.php');
  }
 include "../init/sidebar.php";
 require "../init/header.php";
 include "print-replies.php";

 $post_id = $_GET['pid'];
 $query = "SELECT post_views FROM posts WHERE post_id='$post_id'";
 $result = mysqli_query($conn, $query);
 if ($result) {
   $data = $result->fetch_assoc();
   $originalViews = $data['post_views'];
   $updatedViews = $originalViews + 1;
   $query2 = "UPDATE posts SET post_views='$updatedViews' WHERE post_id='$post_id'";
   $result2 = mysqli_query($conn, $query2);
 }

  ?>

  <div id="maincontent">
    <div class="original-post">
      <?php echo $printOp; ?>
    </div>
    <div class="post-replies">
      <?php echo $printReplies; ?>
    </div>
  </div>
