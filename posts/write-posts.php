<?php
session_start();
if ($_SESSION['loggedin'] !== TRUE) {
  header('Location: ../landingpage/login.php');
}
require "../init/config.php";

if (isset($_POST['post_submit'])) {

  $post_title = $_POST['post_title'];
  $post_text = $_POST['post_text'];
  $post_category = $_POST['categories'];
  $post_creator = $_SESSION['username'];
  $fileNameNew = NULL;

  if ($_FILES['file']['name'] != '') {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($fileActualExt, $allowed)) {
      if ($fileError === 0) {
        if ($fileSize < 1000000) {
          $fileNameNew = "post_" . $post_creator . mt_rand() . "." . $fileActualExt;
          $fileDestination = 'uploads/' . $fileNameNew;
          move_uploaded_file($fileTmpName, $fileDestination);
        } else {
          header('Location: ./write-posts.php?error=filesize');
          exit();
        }
      } else {
        header('Location: ./write-posts.php?error=uploaderr');
        exit();
      }
    } else {
      header('Location: ./write-posts.php?error=filetype');
      exit();
    }
  }

  if (empty($post_title) || empty($post_text) || $post_category == 'no_cat') {
    header("Location: ./write-posts.php?error=emptyfields");
    exit(); //if user makes a mistake, this stops code from running
  }
  elseif (!preg_match("/^[A-Za-zåäöÅÄÖ 0-9]*$/", $post_title) && !preg_match("/^[A-Za-z åäö ÅÄÖ 0-9]*$/", $post_text)) {
    header("Location: ./write-posts.php?error=forbiddenchars");
    exit();
  }

  if (!empty($_POST['post_title'])  && !empty($_POST['post_text'])) {
    $sql = "INSERT INTO posts (post_title, post_content, post_img, post_category, post_creator, post_date, post_replies) VALUES ('$post_title', '$post_text', '$fileNameNew', '$post_category', '$post_creator', NOW(), 0)";

    if(mysqli_query($conn, $sql)) {
      header("Location: ./write-posts.php?success=postcreated");
      //Also automatically like your own post when posted.
      $pid = mysqli_insert_id($conn);
      $sql2 = "INSERT INTO likes (post_id, username, like_dislike) VALUES ('$pid', '$post_creator', 1)";
      $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
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
<html>

<div id="write_post">

<div id="msg_container">

  <?php

      if ($_GET['error'] == 'emptyfields') {
        echo "Du måste fylla i alla fält!";
      }
      elseif ($_GET['error'] == 'forbiddenchars') {
        echo "Ditt inlägg innehåller förbjudna tecken...";
      }
      elseif ($_GET['error'] == 'filesize') {
        echo "Din bild är för stor!";
      }
      elseif ($_GET['error'] == 'filetype') {
        echo "Din bild får endast vara i format JPG, PNG eller GIF!";
      }
      elseif ($_GET['error'] == 'uploaderr') {
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

<form method="post" action="write-posts.php" enctype="multipart/form-data" id="write_post_form">

  <label class="label_1" for="post_title_input">titel: </label><input class="input_1" type="text" name="post_title" id="post_title_input" /><br />
  <label class="label_1" for="post_text_input"></label><textarea class="input_1" name="post_text" id="post_text_input" rows="10" cols="40" placeholder="Skriv inlägg..."></textarea> <br />
  <div class="fileUpload_post">
    <label id="replace_btn_img" for="post_img">ladda upp en bild... </label><input type="file" name="file" id="post_img" /><span class="img_explained">du kan ladda upp jpg, png eller gif, max 1mb</span><br />
  </div>

  <label class="label_1" for="category_selector">kategori: </label>
    <select id="category_selector" name="categories" form="write_post_form">
      <option value="no_cat">välj en kategori...</option>
      <?php
        $sql3 = "SELECT * FROM categories";
        $result3 = mysqli_query($conn, $sql3);
        if(mysqli_num_rows($result3) > 0) {
          while ($rows = mysqli_fetch_assoc($result3)) {
            $category = $rows['category'];
            echo "<option value='$category'>$category</option>";
          }
        }
        echo "</select>";
        if ($_SESSION['admin'] == 1) {
          echo "<a href='../userpage/admin_page.php' id='edit_categories' class='links'>redigera kategorier</a>";
        }
       ?>

    <br />

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
</html>
<script>
/*following code is interpreted from jsfiddle (but edited to match needs)*/

var button = document.getElementById('replace_btn_img');
var input  = document.getElementById('post_img');

// Making input invisible, but leaving shown fo graceful degradation
input.style.display = 'none';

button.addEventListener('click', function (e) {
    e.preventDefault();
    input.click();
});

input.addEventListener('change', function () {
  var info = this.value;
  var imgName = info.slice(12);
  button.innerText = imgName;
});

</script>
