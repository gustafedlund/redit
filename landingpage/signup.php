<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="../styles/start.css" />
<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900" rel="stylesheet">
</head>

<body>

<div id="maincontent_signup">

<div id="signup_form">

<form method="post" action="./parse-signup.php">

  <label>användarnamn: </label><input class="signup_form_input" type="text" name="new_username" value="<?php echo "$new_username";?>" /> <span class="errormsg"> <?php echo $username_err ?> </span> <br />

  <label>lösenord: </label><input class="signup_form_input" type="password" name="new_password" value="<?php echo "$new_password";?>" /> <span class="errormsg"> <?php echo $password_err ?> </span> <br />

  <label>bekräfta lösenord: </label><input class="signup_form_input" type="password" name="new_password_confirmation" /> <span class="errormsg"> <?php echo $password_confirm_err ?> </span> <br />

  <label>e-mail: </label><input class="signup_form_input" type="email" name="new_email" value="<?php echo "$new_email";?>" /> <span class="errormsg"> <?php echo $email_err ?> </span> <br />

  <input id="signup_button" type="submit" name="submit" value="Skapa användare!" />

</form>

<span><?php echo "$errormsg"; ?></span>

</div>

</div>

</body>
</html>
