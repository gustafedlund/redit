<?php
  require "./init/config.php";
  //include "posts/print-posts.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="styles/posts.css">
  <link rel="stylesheet" href="styles/main.css">
  <title>Redit</title>
</head>
<body>
  <!-- S I D E B A R - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
  <div id="sidebar">
    <a href="index.php"><img src="./img/logo_text_gr.png" /></a>
    <a href="index.html" class="category regular">bygdababbel</a>
    <a href="index.html" class="category regular">skola</a>
    <a href="index.html" class="category regular">politik</a>
    <a href="index.html" class="category regular">volvo</a>
    <a href="index.html" class="category regular">händelser</a>
    <a href="index.html" class="category regular">nyheter</a>
    <a href="index.html" class="category regular">meme</a>
    <a href="index.html" class="category regular">dagens bild</a>
      <div id='char-indicator'>
        <span id='avatar'></span>
        <div id='char-info'>
          <span id='username' class='bold'> <?php echo $_SESSION['username']; ?> </span> <br />
          <span id='redighet' class='light'>redighet: <span id='redighet' class='semi-bold'>36%</span></span><br />
          <a href='mypage.php'>min sida</a>
        </div>
    </div>
  </div>
<!-- M A I N - C O N T E N T - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->

  <div class="maincontent">

    <div class='thread-show'>
      <div class='thread-left'>
        <p class='thread-title' class='bold'>
          sample post title
        </p>
        <p class='firstpost'>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat...
        </p>
      </div>
      <div class='thread-right'>
        <span class='upvote' id='specificpost_up1'></span>
        <span class='post_rating' id='specificpost_rating1'>+34</span>
        <span class='downvote' id='specificpost_down1'></span>
      </div>
      <div class='thread-info'>
        <span class='no_of_comments'>4 </span><span class='comment_symbol'></span> <span class='divider'>/</span>
        <a href='userpage' class='author' id='spec_author'>what_is_up</a> <span class='divider'>/</span>
        <span class='date_posted' id='spec_post_date'>2018-10-14 18:22</span>
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
