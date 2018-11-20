<?php

session_start();

require '../init/config.php';
require "../init/header.php";

unset($_SESSION['username']);
session_destroy();

header('Location: login.php?logout=success');

?>

<body>
  
</body>
