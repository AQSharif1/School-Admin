<?php
require 'db_configuration.php';

$status = session_status();
if ($status == PHP_SESSION_NONE) {
  session_start();
}
  // Create Connection
  $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Escape inputs to prevent SQL injection
  $usermail = $conn->escape_string($_POST["usermail"]);
  $account_password = $conn->escape_string($_POST["password"]);
  $hash = sha1($account_password);

  $sql = "SELECT Role, First_Name, User_Id FROM users WHERE Email='$usermail' AND Hash='$hash';";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      $entry = $result -> fetch_assoc();
      $_SESSION["email"] = $usermail;
      $_SESSION["role"] = $entry['Role'];
      $_SESSION["first_name"] = $entry['First_Name'];
      $_SESSION["User_Id"] = $entry['User_Id'];
      header('Location: index.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="icon" href="images/new_logo.png" type="image/icon type">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
  <?php include 'show-navbar.php'; ?>
  <?php show_navbar(); ?>
  <header class="inverse">
      <div class="container">
          <h1><span class="accent-text">Login</span></h1>
      </div>
  </header>
  <p style='font-weight: bold'>Invalid Username or Password</p>
  <br>
  <form action="validate-login.php" method="post">
      <label for="usermail">Email</label>
      <br>
      <input id="usermail" type="email" name="usermail" placeholder="Yourname@email.com" required>
      <br>
      <label for="password">Password</label>
      <br>
      <input id="password" type="password" name="password" placeholder="Password" required>
      <br>
      <input type="submit" id="submit-login" value="Login"/>
	</form>
  <a href="create_account.php" id="create_account_button">Create Account</a>
  </body>
</html>
