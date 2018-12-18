<?php
session_start();
require '../init/config.php';
if ($_SESSION['admin'] !== 1) {
  header('Location: ../home/index.php');
}

if($_GET['delete']) {
  $category = $_GET['delete'];
  $query = "DELETE FROM categories WHERE category = '$category'";
  $result = mysqli_query($conn, $query);
  if ($result) {
    header("Location: ../userpage/admin_page.php?catdeleted=" . $category . "");
  }
} elseif ($_GET['add']) {
  $newCat = $_POST['new_cat'];
  if (!empty($_POST['new_cat'])) {
    $sql = "INSERT INTO categories (category) VALUES ('$newCat')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      header("Location: ../userpage/admin_page.php?cat_added");
    } else {
      header("Location: ../userpage/admin_page.php?cat_not_added");
    }
  } else {
    header("Location: ../userpage/admin_page.php?cat_not_added");
  }
}

?>
