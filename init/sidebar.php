<link rel="stylesheet" href="./styles/main.css">

<div id="sidebar">
  <a href="../index.php"><img src="../img/logo_text_gr.png" /></a>
  <a href="index.html" class="category regular">bygdababbel</a>
  <a href="index.html" class="category regular">skola</a>
  <a href="index.html" class="category regular">politik</a>
  <a href="index.html" class="category regular">volvo</a>
  <a href="index.html" class="category regular">händelser</a>
  <a href="index.html" class="category regular">nyheter</a>
  <a href="index.html" class="category regular">meme</a>
  <a href="index.html" class="category regular">dagens bild</a>
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
        <span id='username' class='bold'> <?php session_start(); echo $_SESSION['username']; ?> </span> <br />
        <span id='redighet' class='light'>redighet: <span id='redighet' class='semi-bold'>36%</span></span><br />

<form method="post" action="../userpage/userpage.php?user=<?php echo $_SESSION['username']; ?>" name="userpage_access">
  <input type="submit" value="min sida" />
</form>

        <a href="/landingpage/logout.php" class='links'>logga ut</a>

      </div>
  </div>
</div>
