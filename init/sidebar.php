<link rel="stylesheet" href="./styles/main.css">

<div id="sidebar">
  <a href="index.php"><img src="./img/logo_text_gr.png" /></a>
  <a href="index.html" class="category regular">bygdababbel</a>
  <a href="index.html" class="category regular">skola</a>
  <a href="index.html" class="category regular">politik</a>
  <a href="index.html" class="category regular">volvo</a>
  <a href="index.html" class="category regular">händelser</a>
  <a href="index.html" class="category regular">nyheter</a>
  <a href="index.html" class="category regular">meme</a>
  <a href="index.html" class="category regular">dagens bild</a>
    <div id='char-indicator'>
      <span id='avatar'></span>
      <div id='char-info'>
        <span id='username' class='bold'> <?php echo $_SESSION['username']; ?> </span> <br />
        <span id='redighet' class='light'>redighet: <span id='redighet' class='semi-bold'>36%</span></span><br />
        <a href='mypage.php' class="links">min sida</a><br />

        <a href="/landingpage/logout.php" class='links'>logga ut</a>

      </div>
  </div>
</div>
