<?php

require "../init/config.php";

$userID = $_POST['name'];
$query = "DELETE FROM users WHERE user_id = $userID";
mysqli_query($conn, $query);

echo "User deleted";

mysqli_close($conn);

?>
