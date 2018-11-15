<?php
session_start();

require "../init/config.php";
require "../init/header.php";
require '../init/sidebar.php';

 ?>

 <div id="maincontent" class='userpage_maincontent'>

   <span id='userpage_top'>

     <span id='userpage_avatar'></span>

     <span id='userpage_info'>

       <span id='userpage_username'> <?php echo "currentuser"; ?> </span>
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
