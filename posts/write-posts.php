<?php

require "../init/config.php";

session_start();

if (isset($_POST['post_submit'])) {

  $post_title = $_POST['post_title'];
  $post_text = $_POST['post_text'];
  $post_img = $_POST['post_img'];
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
  if(!empty($_POST['post_img'])) {

    $target_dir = "../uploads/upload_posts";
    $target_file = $target_dir . basename($_FILES["post_img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed = array('jpg', 'jpeg', 'png', 'gif');

    /*$check = getimagesize($_FILES["post_img"]["tmp_name"]);

    // is file an image?

    if ($check !== false) {
      header("Location: ./write-posts.php?success=fileisimage");
      $uploadOk = 1;
      exit();
    }
    else {
      header("Location: ./write-posts.php?error=notanimage");
      $uploadOk = 0;
      exit();
    }*/

    // is file too large?

    if ($_FILES["post_img"]["size"] > 1000000) {
      header("Location: ./write-posts.php?error=toolarge");
      $uploadOk = 0;
      exit();
    }

    // is file the right format? - - - - - - - i'm stuck here fam

    if(!in_array($imageFileType, $allowed)) {
      header("Location: ./write-posts.php?error=wrongformat");
      $uploadOk = 0;
      exit();
    }

    /*if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
      header("Location: ./write-posts.php?error=wrongformat");
      $uploadOk = 0;
      exit();
    }*/

    // is file uploaded?

    if ($uploadOk == 0) {
      header("Location: ./write-posts.php?error=notuploaded");
      exit();
    }
    else {
      if (move_uploaded_file($_FILES["post_img"]["name"], $target_file)) {
        header("Location: ./write-posts.php?success=fileuploaded");
        exit();
      }
      else {
        header("Location: ./write-posts.php?error=notuploaded");
        exit();
      }
    }

  }
  if (!empty($_POST['post_title'])  && !empty($_POST['post_text']) && empty($_POST['post_img'])) {
    $sql = "INSERT INTO posts (post_title, post_content, post_category, post_creator, post_date) VALUES ('$post_title', '$post_text', '$post_category', '$post_creator', NOW())";

    if(mysqli_query($conn, $sql)) {
      header("Location: ./write-posts.php?success=postcreated");
      exit();
    } else {
      header("Location: ./write-posts.php?error=notposted");
      exit();
    }

  }
  elseif (!empty($_POST['post_title'])  && !empty($_POST['post_text']) && !empty($_POST['post_img'])) {
    $sql = "INSERT INTO posts (post_title, post_content, post_img, post_category, post_creator, post_date) VALUES ('$post_title', '$post_text', '$target_file', '$post_category', '$post_creator', NOW())";

    if(mysqli_query($conn, $sql)) {
      header("Location: ./write-posts.php?success=postcreated");
      exit();
    } else {
      header("Location: ./write-posts.php?error=notposted");
      exit();
    }

  }



} /*else {
  header("Location: ../index.php");
  exit();
}*/

include "../init/header.php";
include "../init/sidebar.php";

 ?>

<div id="write_post">

<div id="msg_container">

  <?php
if (isset($_POST['post_submit'])) {
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
    echo "<p class='success'>Ditt inlägg har skickats in!</p> <a href='../index.php'>Tillbaka till startsidan</a>";
  }
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
      <option value="skola">Skola</option>
      <option value="politik">Politik</option>
      <option value="volvo">Volvo</option>
      <option value="handelser">Händelser</option>
      <option value="nyheter">Nyheter</option>
      <option value="meme">Memes</option>
      <option value="dagens-bild">Dagens bild</option>
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
