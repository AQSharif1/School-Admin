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
              <h1> Welcome to <span class="accent-text">Learn and Help</span></h1>
          </div>
      </header>
    <div id="container_2">
        <!---Sponsors Section -->
        <label id="name-label">Sponsor's Name: ' . $sponsor_name . '</label>

        <label id="sponsers-email-label"> Sponsor's Email: ' . $sponsor_email . '</label>
        <input type="email" id="sponsers-email" name="sponsers-email" class="form" required placeholder="Enter Sponsor's email"><br><!---email-->
        <label id="sponsors-number-label">Sponsor's Phone Number: ' . $sponsor_phone . '</label>
        <input type="tel" id="sponsers-phone" name="sponsers-phone" placeholder="123-456-7899" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
        <br>
        <br>
        <br>
        <!---Spouse Section -->
        <label id="spouses-name-label">Spouse's Name: ' . $spouse_name . '</label>
        <input type="text" id="spouses-name" name="spouses-name" class="form" required placeholder="Enter Spouse's name"><br>
        <label id="spouses-email-label"> Spouse's Email: ' . $spouse_email . '</label>
        <input type="email" id="spouses-email" name="spouses-email" class="form" required placeholder="Enter Spouse's email"><br>
        <label id="spouses-number-label">Spouse's Phone Number: ' . $spouse_phone . '</label>
        <input type="tel" id="spouses-phone" name="spouses-phone" placeholder="123-456-7899" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
        <br>
        <br>
        <br>
        <!---Student Section -->
        <label id="students-name-label">Student's Name: ' . $student_name . '</label>
        <input type="text" id="students-name" name="students-name" class="form" required placeholder="Enter Student's name"><br>
        <label id="students-email-label"> Student's Email: ' . $student_email . '</label>
        <input type="email" id="students-email" name="students-email" class="form" required placeholder="Enter Student's email"><br>
        <label id="students-number-label">Student's Phone Number: ' . $student_phone . '</label>
        <input type="tel" id="students-phone" name="students-phone" placeholder="123-456-7899" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
        <br>
        <br>
        <label id="class">Select Class</label>
        <select id="dropdown" name="role" required>
          <option disabled selected value>
            Select your class
          </option>
          <option value="py1">
            Python 101
          </option>
          <option value="java1">
            Java 101
          </option>
          <option value="py2">
            Python 201
          </option>
		  <option value="java2">
			Java 201
		  </option>
		</select>
		<!--dropdown--->
		<p><strong>Cause</strong></p>
		<label>
		  <input type="radio" name="cause" value="lib">Library
		</label>
		<br>
		<label>
		  <input type="radio" name="cause" value="Dig_class">Digital Classroom</label>
		<label>
		  <br>
		  <input type="radio" name="cause" value="Other"> No Preference
		</label><!---radioButtons--->
		<br>
		<input type="submit" id="submit" name="submit" value="Submit">
	  </form><!---survey-form--->
	</div>
  </body>
</html>
