<?php

session_start();

require  '../init/config.php';
require "../init/header.php";

?>

<body id="signup_page">

<div id="maincontent_signup">

<div id="signup_form">

  <?php

  if (isset($_GET['error'])) { //if there's any errors in the url (using get bc its in the url)

    // specific error message depending on the error

    if ($_GET['error'] == "emptyfields") {
      echo '<p class="signup_error">du måste fylla i alla fält!</p>';
    }
    elseif ($_GET['error'] == "invalidmailuid") {
      echo '<p class="signup_error">ogiltligt användarnamn och e-mail!</p>';
    }
    elseif ($_GET['error'] == "invalidmail") {
      echo '<p class="signup_error">ogiltlig e-mail!</p>';
    }
    elseif ($_GET['error'] == "invaliduid") {
      echo '<p class="signup_error">ogiltligt användarnamn!</p>';
    }
    elseif ($_GET['error'] == "passwordcheck") {
      echo '<p class="signup_error">lösenorden matchar inte!</p>';
    }
    elseif ($_GET['error'] == "usertaken") {
      echo '<p class="signup_error">användarnamnet är upptaget!</p>';
    }
  }
  elseif ($_GET['signup'] == "success") {
    echo '<p class="signup_success">användare skapad! <a href="./login.php">logga in.</a></p>';
  }

   ?>

   <a href="login.php" id="createuser_link">
     har du redan ett konto? logga in!
   </a><br />

<form method="post" action="./parse-signup.php">

  <label>användarnamn: </label><input class="signup_form_input" type="text" name="uid" /> <br />

  <label>lösenord: </label><input class="signup_form_input" type="password" name="pwd" /> <br />

  <label>bekräfta lösenord: </label><input class="signup_form_input" type="password" name="pwd_rpt" /> <br />

  <label>e-mail: </label><input class="signup_form_input" type="email" name="mail" /> <br />

  <input id="signup_button" type="submit" name="signup_submit" value="Skapa användare!" />

</form>

</div>

</div>

</body>
</html>
