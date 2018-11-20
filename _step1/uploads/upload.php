//check avatar

if (empty($_POST['new_avatar'])) {
  $avatar_err = "";
  } else {
  $new_avatar = $_POST['new_avatar'];
  $target_dir = "../uploads/";
  $target_file = $targer_dir . basename($_FILES["new_avatar"]["name"]);
  $uploadOK = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  if ($_FILES["new_avatar"]["size"] > 1000000) {
    $avatar_err = "Din bild får inte vara större än 1MB!";
    $uploadOK = 0;
  }

  if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
    $avatar_err = "Du kan bara ladda upp filer i format JPG, PNG eller GIF!";
    $uploadOK = 0;
  }

  if($uploadOK == 0) {
    $avatar_err = "Din bild laddades inte upp...";
  } else {
    $avatar_err = "Din bild har laddats upp!";

  }

}

<label>avatar: </label><label for="new_avatar" id="upload_avatar">ladda upp avatar...</label><input type="file" name="new_avatar" id="new_avatar" class="inputavatar" /> <span class="errormsg"><?php echo $avatar_err ?></span> <br />
