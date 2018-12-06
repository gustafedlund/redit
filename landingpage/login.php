<?php

  session_start();

  require "../init/header.php";

 ?>

<body id=login_page>

<div id="maincontent_login">

<img src="../img/logo_text_gr.png" alt="Redit logo" />

<div id="login_form">

<form method="post" action="./parse-login.php">

  <span class='errormsg_general'>

    <?php

    if (isset($_GET['error'])) { //if there's any errors in the url (using get bc its in the url)

      // specific error message depending on the error

      if ($_GET['error'] == "emptyfields") {
        echo '<p class="signup_error">du måste fylla i alla fält!</p>';
      }
      elseif ($_GET['error'] == "sqlerror") {
        echo '<p class="signup_error">något gick fel... prova igen!</p>';
      }
      elseif ($_GET['error'] == "wrongpassword") {
        echo '<p class="signup_error">användarnamn och lösenord matchar inte!</p>';
      }
      elseif ($_GET['error'] == "nouser") {
        echo '<p class="signup_error">användaren finns inte!</p>';
      }
    }

     ?>

  </span>

  <label>användarnamn: </label><input class="login_form_input" type="text" name="input_username" /><br />

  <label>lösenord: </label><input class="login_form_input" type="password" name="input_password" /><br />

  <a href="signup.php" id="createuser_link">
    har du inget konto än? skapa ett nu!
  </a><br />

  <input id="login_button" type="submit" name="login_submit" value="" />

</form>

</div>

</div>

</body>
</html>
