<?php require 'config.php'; ?>
<div id="sidebar">
  <a href="../home/index.php"><img src="../img/logo_text_gr.png" /></a>

  <span id='sidebar_stuff'>
    <?php
      $sql = "SELECT * FROM categories";
      $result = mysqli_query($conn, $sql);
      if($result) {
        while ($rows = mysqli_fetch_assoc($result)) {
          $category = $rows['category'];
          $printCat = '';
          $printCat .= "<a href='../home/index.php?category=$category' class='category regular";
          if ($_GET['category'] == $category) {
            $printCat .= ' current_cat';
          }
          $printCat .= "'>$category</a>";
          echo $printCat;
        }
      }
    ?>

    <form method="post" action="search-parse.php">
      <input type="text" name="search" />
      <input type="submit" name="submit-search" />
    </form>
    
  </span>

  <div id='char-indicator'>

    <?php
      $user = $_SESSION['username'];
      $sql = "SELECT avatar FROM users WHERE username='$user'";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $data = $result->fetch_assoc();
        if ($data['avatar'] !== NULL) {
          echo "<span id='avatar' style='background-image:url(../uploads/upload_avatar/" . $data['avatar'] . ");'></span>";
        } else {
          echo "<span id='avatar' style='background-image:url(../img/sample-avatar.png);'></span>";
        }
      }
    ?>

    <div id='char-info'>
      <span id='username' class='bold'> <?php echo $_SESSION['username']; ?> </span> <br />
      <span id='redighet' class='light'>redighet: <span id='redighet' class='semi-bold'>

        <?php
          $user = $_SESSION['username'];
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

      </span></span><br />

  <form method="post" action="../userpage/userpage.php?user=<?php echo $_SESSION['username']; ?>" name="userpage_access">
    <input type="submit" value="min sida" />
  </form>

      <a href="../landingpage/logout.php" class='links'>logga ut</a>

    </div>
  </div>
</div>
