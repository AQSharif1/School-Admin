<?php
include 'show-button.php';

function show_navbar() {
    echo '<div class="navbar">
      <a href="index.php" id="nav-logo"><img id="logo" src="images/learn_n_help_logo.png"></a>
      <div>'; getButton(); echo '</div>
      <a href="classes.php">Classes</a>
      <a href="causes.php">Causes</a>
      <a href="blog.php">Blog</a>
      <a href="schools.php">Schools</a>
      <a href="meet_our_instructors.php">Meet our Instructors</a>
      <a href="contact_us.php">Contact Us</a>';
      if (isset($_SESSION['email'])) {
        if ($_SESSION['role'] == 'admin') {
          echo '<a href="administration.php">Administration</a>';
        }
        echo '<a href="registration_form.php" id="register">Register Now</a>';
      }
       echo '</div>';

}

?>