<?php
  session_start();
  require "./init/config.php";
  require "./init/header.php";
  include "posts/print-posts.php";
 ?>

<body>
<!-- S I D E B A R - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
<?php include "./init/sidebar.php" ?>
<!-- M A I N - C O N T E N T - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
  <div id="maincontent">
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
