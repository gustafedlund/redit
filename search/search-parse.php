<?php
session_start();
if ($_SESSION['loggedin'] !== TRUE) {
  header('Location: ../landingpage/login.php');
}
if (isset($_POST['submit-search'])) {
  $kw = $_POST['search'];
  require "../init/config.php";
  require "../init/header.php";
  require "../init/sidebar.php";

  $sql = "SELECT * FROM posts";
  $result = mysqli_query($conn, $sql);
  $queryResults = mysqli_num_rows($results);

  if ($queryResults > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

    }
  }


} else {
  echo "Something went wrong, please try again.";
}
 ?>

 <h1>Sökresultat</h1>
 <div class="search-results-wrapper">
   <?php ?>
 </div>
