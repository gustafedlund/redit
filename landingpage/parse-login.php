<?php

session_start();

if (isset($_POST['login_submit'])) { //did the user access this page by clicking submit ?

    require '../init/config.php';

    $uid = $_POST['input_username'];
    $pwd = $_POST['input_password'];

    if (empty($uid) || empty($pwd)) {
      header("Location: ./login.php?error=emptyfields");
      exit();
    }

    else {

      $sql = "SELECT * FROM users WHERE username=?;";

      $stmt = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql)) { //checking if there's errors in the sql statement
        header("Location: ./login.php?error=sqlrror");
        exit();
      }

      else {

        mysqli_stmt_bind_param($stmt, "s", $uid); //pass in parameter from users given when they tried to login
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        //did we get a result or not?

        if ($row = mysqli_fetch_assoc($result)) { //fetching data from result variable & puts it in an associative array

          //if there's a user matching - grab and hash PASSWORD

          $pwd_check = password_verify($pwd, $row['password']); //function takes password user put in, pwd from database , unhash, and see if they match

          if ($pwd_check == false) {
            header("Location: ./login.php?error=wrongpassword");
            exit();
          }
          elseif ($pwd_check == true) {

            //logged in! start session and set global session variables

            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['admin'] = $row['admin'];
            $_SESSION['loggedin'] = TRUE;

            if ($_POST['remember']) {
              setcookie('remember_user', $row['username'], time() + 3600000);
              setcookie('remember_password', $pwd, time() + 3600000);
            } elseif (!$_POST['remember']) {
              if (isset($_COOKIE['remember_user']) || isset($_COOKIE['remember_password'])) {
                setcookie('remember_user', 'do_not_remember', time() - 3600);
                setcookie('remember_password', 'do_not_remember', time() - 3600);
              }
            }

            header("Location: ../home/index.php?login=success");
            exit();

          }
          else {
            header("Location: ./login.php?error=wrongpassword");
            exit();
          }

        }

        else {
          header("Location: ./login.php?error=nouser");
          exit();
        }

      }
    }

}

else {

  header("Location: ./login.php");
  exit();

}
?>
