
 <?php
session_start();
 include "../init/sidebar.php";
 require "../init/header.php";
 include "print-replies.php";
  ?>

  <div id="maincontent">
    <div class="original-post">
      <?php echo $printOp; ?>
    </div>
    <div class="post-replies">
      <?php echo $printReplies; ?>
    </div>
  </div>
