<?php

require '../init/config.php';

$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) >= 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $user_id = $row['user_id'];
    $username = $row['username'];
    $email = $row['email'];
    $post_permission = $row['post_permission'];

    echo "User ID: $user_id, Username: $username, Email: $email, Post permission: $post_permission";?><br><?php
  }
}

mysqli_close($conn);

?>
