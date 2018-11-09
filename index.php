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
  <div class="maincontent">

      <?php echo $printPosts; ?>

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
      <?php
        if ($_SESSION['admin'] == 1) {
          echo "<a href='userpage/admin_page.php'><button id='admin_panel'>admin stuff</button></a>";
        }
       ?>
    </div>
    <div id='newpost'>
    </div>
  </div>

</body>
</html>
