<?php

require "../init/config.php";

session_start();

if (isset($_POST['post_submit'])) {

  $post_title = $_POST['post_title'];
  $post_text = $_POST['post_text'];
  $post_category = $_POST['categories'];
  $post_creator = $_SESSION['username'];

  if (empty($post_title) || empty($post_text) || $post_category == 'no_cat') {
    header("Location: ./write-posts.php?error=emptyfields");
    exit(); //if user makes a mistake, this stops code from running
  }
  elseif (!preg_match("/^[A-Za-zåäöÅÄÖ 0-9]*$/", $post_title) && !preg_match("/^[A-Za-z åäö ÅÄÖ 0-9]*$/", $post_text)) {
    header("Location: ./write-posts.php?error=forbiddenchars");
    exit();
  }

  if (!empty($_POST['post_title'])  && !empty($_POST['post_text'])) {
    $sql = "INSERT INTO posts (post_title, post_content, post_category, post_creator, post_date) VALUES ('$post_title', '$post_text', '$post_category', '$post_creator', NOW())";

    if(mysqli_query($conn, $sql)) {
      header("Location: ./write-posts.php?success=postcreated");
      exit();
    } else {
      header("Location: ./write-posts.php?error=notposted");
      exit();
    }
  }
}

include "../init/header.php";
include "../init/sidebar.php";

 ?>

<div id="write_post">

<div id="msg_container">

  <?php

      if ($_GET['error'] == 'emptyfields') {
        echo "Du måste fylla i alla fält!";
      }
      elseif ($_GET['error'] == 'forbiddenchars') {
        echo "Ditt inlägg innehåller förbjudna tecken...";
      }
      elseif ($_GET['error'] == 'toolarge') {
        echo "Din bild är för stor!";
      }
      elseif ($_GET['error'] == 'wrongformat') {
        echo "Din bild får endast vara i format JPG, PNG eller GIF!";
      }
      elseif ($_GET['error'] == 'notuploaded') {
        echo "Din bild laddades inte upp...";
      }
      elseif ($_GET['error'] == 'notposted') {
        echo "Något gick fel, ditt inlägg har inte skickats in...";
      }
      elseif ($_GET['success'] == 'postcreated') {
        echo "<p class='success'>Din tråd har skapats!</p> <a href='../home/index.php'>Tillbaka till startsidan</a>";
      }

  ?>

</div>

<form method="post" action="write-posts.php" id="write_post_form">

  <label for="post_title_input">titel: </label><input type="text" name="post_title" id="post_title_input" /><br />
  <label for="post_text_input"></label><textarea name="post_text" id="post_text_input" rows="10" cols="40" placeholder="Skriv inlägg..."></textarea> <br />
  <!--<label for="post_img">bild: </label><input type="file" name="post_img" id="post_img" /> <br />-->

  <label for="category_selector">kategori: </label>
    <select name="categories" form="write_post_form">
      <option value="no_cat">Välj en kategori...</option>
      <option value="bygdababbel">Bygdababbel</option>
      <option value="plugg">Plugg</option>
      <option value="politik">Politik</option>
      <option value="raggarbilar">Raggarbilar</option>
      <option value="jippon">Jippon</option>
      <option value="nyheter">Nyheter</option>
    </select><br />

  <span id='cancel-submit-container'>
    <span id="cancel_container">
      <a id="cancel_post" href="../home/index.php"></a>
      <span id='cancel_caption'>kasta inlägg</span>
    </span>
    <span id="submit_container">
      <input id="submit_post" type="submit" name="post_submit" value="" />
      <span id='submit_caption'>skicka in inlägg</span>
    </span>
  </span>
</form>

</div>
