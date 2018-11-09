<?php

require '../init/config.php';

$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$username = $row['username'];
$email = $row['email'];
$post_permission = $row['post_permission'];

echo "$username, $email, $post_permission";


?>
