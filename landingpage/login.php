<?php

  session_start();

  require "../init/header.php";

 ?>

<body id=login_page>

<div id="maincontent_login">

<img src="../img/logo_text_gr.png" alt="Redit logo" />

<div id="login_form">

<form method="post" action="./parse-login.php">

  <label>användarnamn: </label><input class="login_form_input" type="text" name="input_username" /><br />

  <label>lösenord: </label><input class="login_form_input" type="password" name="input_password" /><br />

  <a href="signup.php" id="createuser_link">
    har du inget konto än? skapa ett nu!
  </a><br />

  <input id="login_button" type="submit" name="login_submit" />

</form>

</div>

</div>

</body>
</html>
