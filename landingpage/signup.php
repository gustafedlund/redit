<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="../styles/start.css" />
<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900" rel="stylesheet">
</head>

<body>

<div id="maincontent">

<div id="signup_form">

<form>

  <label>användarnamn: </label><input class="signup_form_input" type="text" name="new_username" /><br />

  <label>lösenord: </label><input class="signup_form_input" type="text" name="new_password" /><br />

  <label>bekräfta lösenord: </label><input class="signup_form_input" type="text" name="new_password_confirmation" /><br />

  <label>e-mail: </label><input class="signup_form_input" type="email" name="new_email" /><br />

  <label>avatar: </label><label for="new_avatar" id="upload_avatar">ladda upp avatar...</label><input type="file" name="new_avatar" id="new_avatar" class="inputavatar" /><br />

  <input id="signup_button" type="submit" value="Skapa användare!" />

</form>

</div>

</div>

</body>
</html>
