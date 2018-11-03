<?php

include '../php/config.php';

$validation_err = 0;

$new_username = $_POST['new_username'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['new_password_confirmation'];
$new_email = $_POST['new_email'];

//error variables

$username_err = $password_err = $password_confirm_err = $email_err = "";





//check username

if (empty($_POST['new_username'])) {

$username_err = "Du måste välja ett användarnamn! ";
$validation_err = 1;

}

if (preg_match("/[A-Za-z0-9_]/", $new_username)) {

  $username_err = "Användarnamnet får bara innehålla bokstäver, siffror och understreck! ";
  $validation_err = 1;

}

if (!empty($_POST['new_username'])) {

//query
  $sql = "SELECT * FROM users WHERE username = '$new_username'";
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) >= 1) {
    $username_err = "Användarnamnet är upptaget. Prova något annat! ";
    $validation_err = 1;

}

}

//check password

if(empty($_POST['new_password'])) {

  $password_err = "Du måste välja ett lösenord! ";
  $validation_err = 1;

}

if(preg_match("/[A-Za-z0-9_]/", $new_password)) {
  $password_err = "Lösenordet får bara innehålla bokstäver, siffror och understreck! ";
  $validation_err = 1;

}

if ($new_password !== $confirm_password) {
  $password_confirm_err = "Lösenorden matchar inte! ";
  $validation_err = 1;
}


//check e-mail

if(empty($_POST['new_email'])) {
  $email_err = "Du måste skriva in en e-mail! ";
  $validation_err = 1;

}

if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
  $email_err = "Ogiltlig e-mail! ";
  $validation_err = 1;

}

  $submit_query = "INSERT INTO users (username, password, email) VALUES ('$new_username', '$new_password', '$new_email')";

  $res = mysqli_query($conn, $submit_query) or die(mysqli_query($conn));

    if ($res) {
      header("location:login.php");
    }





?>
