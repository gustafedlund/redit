<?php

require "../init/config.php";

if (isset($_POST['post_submit'])) {

  $post_title = $_POST['post_title_input'];
  $post_text = $_POST['post_text_input'];
  $post_img = $_POST['post_file_upload'];
  $post_category = $_POST['categories'];

  if (empty($post_title) || empty($post_text) || empty($post_category)) {
    header("Location: ./write-posts.php?error=emptyfields");
    exit(); //if user makes a mistake, this stops code from running
  }
  elseif () {

  }



} /*else {
  header("Location: ../index.php");
  exit();
}*/

 ?>
<div id="write_post">

<form method="post" action="write-posts.php" id="write_post_form">
  <label for="post_title_input">titel: </label><input type="text" name="post_title" id="post_title_input" /><br />
  <label for="post_text_input">inlägg: </label><textarea name="post_text" id="post_text_input" rows="10" cols="40" placeholder="Skriv inlägg..."></textarea> <br />
  <label for="post_file_upload">bild: </label><input type="file" name="post_img" id="post_file_upload" /> <br />

  <label for="category_selector">kategori: </label>
    <select name="categories" form="write_post_form">
      <option value="bygdababbel">Bygdababbel</option>
      <option value="skola">Skola</option>
      <option value="politik">Politik</option>
      <option value="volvo">Volvo</option>
      <option value="handelser">Händelser</option>
      <option value="nyheter">Nyheter</option>
      <option value="meme">Memes</option>
      <option value="dagens-bild">Dagens bild</option>
    </select>

  <input type="submit" name="post_submit" value="skicka in!" />
</form>

</div>
