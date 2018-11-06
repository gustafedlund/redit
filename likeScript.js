function likes() {
  alert("<?php

    $con = mysqli_connect('localhost', 'root', 'root', 'redit');
    if(!$con) {
      die('Connection failed: ' . mysqli_connect_error());
    }
    $query = mysqli_query($con, \"UPDATE posts SET post_likes = ('$likes' + 1) WHERE post_id = '$id'\");

    mysqli_close($con);

   ?>");
}
