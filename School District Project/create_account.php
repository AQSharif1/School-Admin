<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="icon" href="images/logo.png" type="image/icon type">
    <title>Create Account</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
  <?php include 'show-navbar.php'; ?>
  <?php show_navbar(); ?>
  <header class="inverse">
      <div class="container">
          <h1> Welcome to <span class="accent-text">Learn and Help</span></h1>
      </div>
  </header>
  <br>
  <form action="process_new_account.php" method="post">
      <label for="firstname">First Name</label>
      <br>
      <input id="firstname" type="text" name="firstname" placeholder="First Name" required>
      <br>
      <label for="lastname">Last Name</label>
      <br>
      <input id="lastname" type="text" name="lastname" placeholder="Last name" required>
      <br>
      <label for="usermail">Email</label>
      <br>
      <input id="usermail" type="email" name="usermail" placeholder="Yourname@email.com" required>
      <br>
      <label for="password">Password</label>
      <br>
      <input id="password" type="password" name="password" placeholder="Password" required>
      <br>
      <input type="submit" id="submit-login" value="Create Account"/>
	</form>
  </body>
</html>
