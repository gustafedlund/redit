<?php

session_start();
require "../init/config.php";

$username = $_SESSION['username'];
$query = "DELETE FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

echo "$username was deleted";

mysqli_close($conn);

header("Location: admin_page.php");

?>
