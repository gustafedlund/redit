<?php

session_start();

require "../init/config.php";
require "../init/header.php";
require '../init/sidebar.php';

 ?>

 <div id='userpage_maincontent'>

   <span id='userpage_top'>

     <?php

     $user = $_GET['username'];
     $sql = "SELECT avatar FROM users WHERE username='$user'";
     $result = mysqli_query($conn, $sql);
     if ($result) {
       $data = $result->fetch_assoc();
       if ($data['avatar'] !== NULL) {
         echo "<span id='userpage_avatar' style='background-image:url(../uploads/upload_avatar/" . $data['avatar'] . ");'></span>";
       } else {
         echo "<span id='userpage_avatar' style='background-image:url(../img/sample-avatar.png);'></span>";
       }
     }

      ?>

    <span id='userpage_info'>
      <?php
        echo "<span id='userpage_username'>" . $_GET['username'] . "</span>";
      ?>
    </span>

   <span id='userpage_tagline'>

     <span id='tagline_container'>
       <?php
       $user = $_GET['username'];
       $sql = "SELECT bio FROM users WHERE username='$user'";
       $result = mysqli_query($conn, $sql);
       if ($result) {
         $data = $result->fetch_assoc();
         if ($data['bio'] !== NULL) {
           echo $data['bio'];
         } else {
           echo $_GET['username'] . "har inte skrivit något om sig själv än...";
         }
       }
        ?>
     </span>
   </span>
</span>

  <div id='userpage_box_container'>

    <span class="userpage_box" id='box1'>
      <h2 class="userpage_box_title">startade trådar</h2>

      <?php

      $user = $_GET['username'];
      $sql = "SELECT * FROM posts WHERE post_creator='$user'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
          $title = $rows['post_title'];
          $date = $rows['post_date'];

          echo "<p class='list_of_posts'>
            $title / $date
          </p>";
        }
      }

       ?>

    </span>
    <span class="userpage_box" id='box2'>
      <h2 class="userpage_box_title">kommenterade trådar</h2>
        <?php
        $user = $_GET['username'];
        $sql = "SELECT * FROM replies WHERE reply_creator='$user'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($rows = mysqli_fetch_assoc($result)) {
            $id = $rows['post_id'];

              $query2 = "SELECT post_title FROM posts WHERE post_id='$id'";
              $result2 = mysqli_query($query2);

                if (mysqli_num_rows($result2) > 0) {
                  while ($rows2 = mysqli_fetch_assoc($result2)) {
                    $title = $rows2['post_title'];

                    echo "<p class='list_of_posts'>
                      $title
                    </p>";
                  }
                }
              }
            }
         ?>

    </span>

    <div class="userpage_bottom">
      <span class="member_since">
        medlem sedan
        <?php
          $user = $_GET['username'];
          $sql = "SELECT member_since FROM users WHERE username='$user'";
          $result = mysqli_query($conn, $sql);
          if ($result) {
            $data = $result->fetch_assoc();
            echo $data['member_since'];
          }
        ?>
      </span>
       /
      <span class="redighet"> <!-- likes från kommentarer? kanske att de ger +0.1 eller så? -->
        redighet:
        <?php
        $user = $_GET['username'];
        $sql = "SELECT post_likes FROM posts WHERE post_creator='$user'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          $likes = 0;
          while ($rows = mysqli_fetch_assoc($result)) {
            $like = $rows['post_likes'];
            $likes += $like;
          }
          echo $likes;
        }
         ?>
      </span>
    </div>
  </div>

 </div>

 <a href="../posts/write-posts.php">
   <div id='newpost'>
   </div>
 </a>

 <script>

function showForm() {
  document.getElementById('change_avatar_form').style.display = 'block';
}
function showWriteForm() {
  document.getElementById('change_tagline').style.display = 'block';
  document.getElementById('tagline_container').style.display = 'none';
  document.getElementById('tagline_write').style.display = 'none';
}
function cancelWriteForm() {
  document.getElementById('change_tagline').style.display = 'none';
  document.getElementById('tagline_container').style.display = 'inline-block';
  document.getElementById('tagline_write').style.display = 'inline-block';
}

 </script>