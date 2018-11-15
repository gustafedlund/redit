<?php
session_start();

require "../init/config.php";
require "../init/header.php";
require '../init/sidebar.php';

 ?>

 <div id="maincontent" class='userpage_maincontent'>

   <span id='userpage_top'>

     

     <span id="userpage_avatar"></span>

     <form method="post" action="parse-avatar.php" name="change_avatar_form" enctype="multipart/form-data" id="change_avatar_form">

       <label for="avatar_upload" id="avatar_upload_label" onclick="showForm();">ändra profilbild...</label> <input type="file" name="avatar_upload" id="avatar_upload" />

       <span id="file_uploaded"><?php echo "thisisthefile.png"; ?></span><br />

       <input type="submit" name="submit_avatar" value="" id="change_avatar_submit" />

     </form>


     <span id='userpage_info'>

       <span id='userpage_username'> <?php echo $_SESSION['username']; ?> </span>
       <span id='userpage_membersince'> <?php echo "medlem sedan"; ?> </span>
       <span id='userpage_redighet'> <?php echo "redighet"; ?> </span>

     </span>


     <span id='userpage_tagline'><?php echo "här kan du introducera dig själv eller bara skriva ditt favoritcitat eller nåt riktigt jävla töntigt.... no judgement!!!"; ?></span>

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

 </script>
