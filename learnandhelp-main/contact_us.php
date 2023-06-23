<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Learn and Help</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
  <?php include 'show-navbar.php'; ?>
  <?php show_navbar(); ?>
  <header class="inverse">
      <div class="container">
        <h1> <span class="accent-text">Contact Us</span></h1>
      </div>
  </header>
    <section class="about-me">
      <div class="container">
        <h2><span class="accent-text">Any Questions?</span></h2>
        <p>Please contact <strong>Siva Jasthi</strong></p>
        <a href="mailto: Siva.Jasthi@gmail.com"> Siva.Jasthi@gmail.com</a>
        <p>651.276.4671</p>
        <br>
        <h2>Website Creators</h2>
        <p>Learn and Help 1.0 development team:</p>
        <p><b>Daniel Duea</b>: DanielDuea@gmail.com</p>
        <p><b>Luis Duran-Enriquez</b>: duranluis320@gmail.com</p>
        <p><b>Michael Olson</b>: michaelolson01@gmail.com</p>
        <p><b>William Vicic</b>: william.vicic@gmail.com</p>
      </div>
    </section>
  </body>
</html>
