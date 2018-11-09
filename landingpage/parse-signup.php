<?php

if (isset($_POST['signup_submit'])) { //did the user access this page by clicking submit ?

  require '../init/config.php';

    $new_username = $_POST['uid'];
    $new_password = $_POST['pwd'];
    $confirm_password = $_POST['pwd_rpt'];
    $new_email = $_POST['mail'];

    if (empty($new_username) || empty($new_password) || empty($confirm_password) || empty($new_email)) {
      header("Location: ./signup.php?error=emptyfields&uid=" . $new_username . "&mail=" . $new_email);
      exit(); //if user makes a mistake, this stops code from running
    }

    elseif (!filter_var($new_email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[A-Za-z0-9]*$/", $new_username)) { //if both email and username are fucked
      header("Location: ./signup.php?error=invalidmailuid");
      exit(); //if user makes a mistake, this stops code from running

    }

    elseif (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) { //built-in function checking if email is valid
      header("Location: ./signup.php?error=invalidmail&uid=" . $new_username);
      exit(); //if user makes a mistake, this stops code from running
    }

    elseif (!preg_match("/^[A-Za-z0-9]*$/", $new_username)) { //checking if username includes ok characters
      header("Location: ./signup.php?error=invaliduid&mail=" . $new_email);
      exit(); //if user makes a mistake, this stops code from running
    }

    elseif ($new_password !== $confirm_password) {
      header("Location: ./signup.php?error=passwordcheck&uid=" . $new_username . "&mail=" . $new_email);
      exit(); //if user makes a mistake, this stops code from running
    }

    else { //if user tries to sign up using a username that has already been taken

      //create sql statement to run in db

      $sql = "SELECT username FROM users WHERE username=?"; // not putting $username, instead using a prepared statement for increased security - ? is a placeholder
      $stmt = mysqli_stmt_init($conn); //built in function

      if (!mysqli_stmt_prepare($stmt, $sql)) { //check if prepare failed
        header("Location: ./signup.php?error=sqlerror");
        exit();
      }

      else { //bind parameter from user to stmt created above - take info from user and send to db a bit later

        mysqli_stmt_bind_param($stmt, "s", $new_username);
        //p1 - which statement to bind info from users TO;
        //p2 - what data type is passed to statement "s" = string
        //p3 - information given by user

        //after binding - execute data from user together with sql statement from above

        mysqli_stmt_execute($stmt); //this will run info inside db

        //did we get a match in db ? if yes, the username is taken

        mysqli_stmt_store_result($stmt); //takes result from db and stores in db called stmt

        //how many results in stmt?

        $resultcheck = mysqli_stmt_num_rows($stmt); //variable resultcheck will have number of rows returned

        if ($resultcheck > 0) {
          header("Location: ./signup.php?error=usertaken&mail=" . $new_email);
          exit();
        }

        else {

          $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)"; //? as placeholder again, for safety

          $stmt = mysqli_stmt_init($conn);

          if (!mysqli_stmt_prepare($stmt, $sql)) { //check if sql and stmt dont work together
            header("Location: ./signup.php?error=sqlerror");
            exit();
          }

          else { //if stmt and sql work together

            $hashedPwd = password_hash($new_password, PASSWORD_DEFAULT); //hash password first

            mysqli_stmt_bind_param($stmt, "sss", $new_username, $hashedPwd, $new_email); //needs 3 s's because theres three parameters to fill

            mysqli_stmt_execute($stmt);

            //now user is successfully signed up!

            header("Location: ./signup.php?signup=success");
            exit();


          }
        }
      }

    }

mysqli_stmt_close($stmt); //closing statements
mysqli_close($conn); //close connection to db

}

else { //if user didnt get here using submit

  header("Location: ./signup.php");
  exit();

}

/*

 ('$new_username', '$new_password', '$new_email')

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

if($validation_err == 0) {

  $submit_query = "INSERT INTO users (username, password, email) VALUES ('$new_username', '$new_password', '$new_email')";

  $res = mysqli_query($conn, $submit_query) or die(mysqli_query($conn));

    if ($res) {
      header("location:login.php");
    }
} else {
  header("location:signup.php");
}






?>*/
