<?php
session_start();

require "../init/config.php";
require "../init/header.php";
require '../init/sidebar.php';

 ?>

 <div id="maincontent" class='userpage_maincontent'>

   <span id='userpage_top'>

     <?php

     $user = $_SESSION['username'];
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

     <form method="post" action="parse-avatar.php" name="change_avatar_form" enctype="multipart/form-data" id="change_avatar_form">

       <label for="avatar_upload" id="avatar_upload_label" onclick="showForm();">ändra profilbild...</label> <input type="file" name="avatar_upload" id="avatar_upload" />

       <span id="file_uploaded"><?php echo "ERROR MEDDELANDEN"; ?></span><br />

       <input type="submit" name="submit_avatar" value="" id="change_avatar_submit" />

     </form>


     <span id='userpage_info'>

<?php

$user = $_SESSION['username'];

$sql = "SELECT * FROM users WHERE username='$user'";
$result = mysqli_query($conn, $sql);

if ($result) {
  $data = $result->fetch_assoc();

  echo "<span id='userpage_username'>" . $data['username'] . "</span>";
  echo "<span id='userpage_membersince'>" . $data['member_since'] . "</span>";
  echo "<span id='userpage_redighet'>" . $data['user_id'] . "</span>";
}

 ?>

     </span>


     <span id='userpage_tagline'>

       <span id='tagline_container'>

         <?php

         $user = $_SESSION['username'];
         $sql = "SELECT bio FROM users WHERE username='$user'";
         $result = mysqli_query($conn, $sql);
         if ($result) {
           $data = $result->fetch_assoc();
           if ($data['bio'] !== NULL) {
             echo $data['bio'];
           } else {
             echo "skriv något om dig själv";
           }
         }

          ?>

       </span>

       <form action="parse_user_bio.php" method="post" id="change_tagline">
         <textarea name="tagline_input" placeholder="x"></textarea>
         <input type="button" id="tagline_cancel" />
          <span id="tagline_cancel_caption">avbryt ändringar</span>
         <input type="submit" name="submit" id="tagline_submit"/>
          <span id="tagline_submit_caption">spara beskrivning</span>
       </form>


       <button class="tagline_symbols" id="tagline_write" onclick="showWriteForm();"></button>
        <span id="tagline_write_caption">ändra beskrivning</span>
     </span>

   </span>

  <div id='userpage_box_container'>

    <span id='box1'></span>
    <span id='box2'></span>
    <span id='box3'></span>
    <span id='box4'></span>

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
}

 </script>
