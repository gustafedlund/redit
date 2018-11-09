<?php

require '../init/config.php';

unset($_SESSION['username']);
session_destroy();

header('Location: login.php');

?>
