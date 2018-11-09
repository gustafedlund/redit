<?php

session_start();

require '../init/config.php';

unset($_SESSION['username']);
session_destroy();

header('Location: login.php?logout=success');

?>
