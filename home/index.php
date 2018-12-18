<?php
  require "../init/config.php";
  require "../init/header.php";
  include "../posts/print-posts.php";
 ?>

<body>
<!-- S I D E B A R - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
<?php include "../init/sidebar.php" ?>
<!-- M A I N - C O N T E N T - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
  <div id="maincontent">

      <?php echo $printPosts; ?>

  </div>

  <!-- L E F T - S I D E - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->

  <div id='left-side'>
    <div id='sort'>
      <a href="
      <?php
        $current = $_SERVER['REQUEST_URI'];
        if (strpos($current, "?sort=popular") !== false) { //if sort is on popular
          $urlArr = explode("?", $current); //remove sort and go back to start(chronological)
          echo $urlArr[0];
        } elseif (strpos($current, "&sort=popular") !== false) { //if sort is on popular
          $urlArr = explode("&", $current); //remove sort and go back to start(chronological)
          echo $urlArr[0];
        } else {
          echo $current;
        }
      ?>
      ">
        <button id='sort_newest'>
          senaste
        </button></a>
        <a href="
        <?php
          $current = $_SERVER['REQUEST_URI'];
          if (strpos($current, "sort=popular") !== false) {
            echo "";
          } elseif (strpos($current, "?") == false) {
            echo $current . "?sort=popular";
          } elseif (strpos($current, "&sort=popular") !== false) {
            echo $current;
          } else {
            echo $current . "&sort=popular";
          }
        ?>
        ">
        <button id='sort_popular'>
          hetaste
        </button>
      </a>
      <?php
        if ($_SESSION['admin'] == 1) {
          echo "<a href='../userpage/admin_page.php'><button id='admin_panel'>administrera</button></a>";
        }
       ?>
    </div>

    <a href="../posts/write-posts.php">
      <div id='newpost'>
      </div>
    </a>

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
