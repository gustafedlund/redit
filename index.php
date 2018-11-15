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

    <div id="write_post_container">
      <span id="cancel_post" onclick="hideContainer();"></span>
      <?php
      include "./posts/write-posts.php";
      ?>
    </div>

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

    <div id='newpost' onclick="showContainer();">
    </div>

  </div>

</body>

<script>
var newPost = document.getElementById('newpost');
var writeContainer = document.getElementById('write_post_container');

function showContainer() {
  writeContainer.style.display = 'block';
}

function hideContainer() {
  writeContainer.style.display = 'none';
}

</script>

</html>
