<?php
  require "./init/config.php";
  include "posts/print-posts.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="styles/posts.css">
  <link rel="stylesheet" href="styles/main.css">
  <script type="text/javascript" src="likeScript.js"></script>
  <title>Redit</title>
</head>
<body>
<!-- S I D E B A R - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
<?php include "./init/sidebar.php" ?>
<!-- M A I N - C O N T E N T - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
<?php require "posts/print-posts.php"; ?>
  <div class="maincontent">

    <div class='thread-show'>
      <div class='thread-left'>
        <p class='thread-title' class='bold'>
          <?php echo $title; ?>
        </p>
        <p class='firstpost'>
          <?php echo $content; ?>
        </p>
      </div>
      <div class='thread-right'>
        <a class='upvote' id='specificpost_up1' onclick="likes();"></a>
       <span class='post_rating' id='specificpost_rating1'><?php

          $con = mysqli_connect("localhost", "root", "root", "redit");
          if(!$con) {
            die("Connection failed: " . mysqli_connect_error());
          }
          $resultsd1 = mysqli_query($con, "SELECT post_likes FROM posts WHERE post_id = '$id'");
          $row = mysqli_fetch_assoc($resultsd1);
          echo $row['post_likes'];

          ?></span>
        <span class='downvote' id='specificpost_down1'></span>
      </div>
      <div class='thread-info'>
        <span class='no_of_comments'>4 </span><span class='comment_symbol'></span> <span class='divider'>/</span>
        <a href='userpage' class='author' id='spec_author'> <?php echo $creator; ?> </a> <span class='divider'>/</span>
        <span class='date_posted' id='spec_post_date'> <?php echo $date; ?> </span>
      </div>
    </div>

  </div>

  <!-- L E F T - S I D E - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->

  <div id='left-side'>
    <div id='sort'>
      <button id='sort_popular'>
        hetaste
      </button>
      <button id='sort_newest'>
        senaste
      </button>
    </div>
    <div id='newpost'>
    </div>
  </div>

</body>
</html>
