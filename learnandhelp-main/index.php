<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }
 ?>

<!DOCTYPE html>
<script>
</script>
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

        <h1> Welcome to <div><img id="big_logo" src="images/learn_n_help_big_logo.jpg"></div></h1>
      </div>
    </header>
    <section class="about">
      <div class="container">
        <h2>Learn and Help <span class="accent-text">Highlights</span></h2>
        <ul>
          <li>You learn "Python Programming" from Dr. Siva Jasthi!</li>
          <li>Online classes will be held from September 11 to May 28.</li>
          <li>Total number of classes: 30</li>
          <li>Total number of hours of instruction: ~50 hours</li>
          <li>Class Size: limited to ~25 students</li>
          <li>Course Fee: $500</li>
        </ul>
        <a href="#" class="btn">Click to learn more</a>
      </div>
    </section>
    <section class="inverse">
      <div class="container">
        <h2>Interested in <span class="accent-text">Learn and Help</span></h2>
        <article>
          <h3>Learn Programming Today!</h3>
          <a href="registration_form.php" class="btn">Register Now</a>
        </article>
      </div>
    </section>
  </body>
</html>
