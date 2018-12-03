<?php

session_start();
require "../init/config.php";

$username = $_SESSION['user_delete'];
$query = "DELETE FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

mysqli_close($conn);

header("Location: admin_page.php");

?>
