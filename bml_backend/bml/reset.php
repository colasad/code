<?php

  require_once('reset_password.php');

?>

<!DOCTYPE html>
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Reset Password</title>
  <link href="styles/users_wider.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <?php if ($success) { ?>
  <h1>Password Reset</h1>
  <p>Your password has been successfully reset. Please <a href="login.php">login</a> with your new password.</p>
  <?php } elseif ($_SESSION['nomatch']) { ?>
  <h1>Error</h1>
  <p>Sorry, there was an error. Make sure you used the complete URL in the email you received. The URL can be used to change your password only once. If necessary, <a href="forgotten.php">submit another request</a>.</p>
  <?php } else { ?>
  <h1>Reset Your Password</h1>
  <form id="form1" name="form1" method="post" action="">
    <p>
      <label for="password">New password:</label>
      <input type="password" name="password" id="password" />
    <span>
    <?php if ($_POST && isset($errors['password'])) {
      echo $errors['password'];
   } ?>
    </span></p>
    <p>
      <label for="conf_pw">Retype  password:</label>
      <input type="password" name="conf_password" id="conf_password" />
    <span>
    <?php if ($_POST && isset($errors['conf_password'])) {
      echo $errors['conf_password'];
   } ?>
    </span></p>
    <p>
      <input type="submit" name="reset" id="reset" value="Reset Password" />
    </p>
  </form>
  <?php } ?>
</body>
</html>