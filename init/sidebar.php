<div id="sidebar">
  <a href="../home/index.php"><img src="../img/logo_text_gr.png" /></a>
  <a href="../home/index.php?category=bygdababbel" class="category regular <?php if ($_GET['category'] == 'bygdababbel') { echo "bold"; } ?> ">bygdababbel</a>
  <a href="../home/index.php?category=plugg" class="category regular <?php if ($_GET['category'] == 'plugg') { echo "bold"; } ?> ">plugg</a>
  <a href="../home/index.php?category=politik" class="category regular <?php if ($_GET['category'] == 'politik') { echo "bold"; } ?> ">politik</a>
  <a href="../home/index.php?category=raggarbilar" class="category regular <?php if ($_GET['category'] == 'raggarbilar') { echo "bold"; } ?> ">raggarbilar</a>
  <a href="../home/index.php?category=jippon" class="category regular <?php if ($_GET['category'] == 'jippon') { echo "bold"; } ?> ">jippon</a>
  <a href="../home/index.php?category=nyheter" class="category regular <?php if ($_GET['category'] == 'nyheter') { echo "bold"; } ?> ">nyheter</a>
  <a href="../home/index.php?category=memes" class="category regular <?php if ($_GET['category'] == 'memes') { echo "bold"; } ?> ">memes</a>
  <a href="../home/index.php?category=dagensbild" class="category regular <?php if ($_GET['category'] == 'dagensbild') { echo "bold"; } ?> ">dagens bild</a>

  <div id='char-indicator'>


  <?php
    include "config.php";
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
