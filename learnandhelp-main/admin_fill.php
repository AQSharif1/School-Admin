<?php
require 'db_configuration.php';

  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }

function admin_fill_form($Reg_Id) {

  $connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

  if ($connection === false) {
    die("Failed to connect to database: " . mysqli_connect_error());
  }
  $sql = "SELECT * FROM registrations NATURAL JOIN classes WHERE Reg_ID = '$Reg_Id'";
  $row = mysqli_fetch_array(mysqli_query($connection, $sql));

  $sponsor_name = $row['Sponsor_Name'];
  $sponsor_email = $row['Sponsor_Email'];
  $sponsor_phone = $row['Sponsor_Phone_Number'];
  $spouse_name = $row['Spouse_Name'];
  $spouse_email = $row['Spouse_Email'];
  $spouse_phone = $row['Spouse_Phone_Number'];
  $student_name = $row['Student_Name'];
  $student_email = $row['Student_Email'];
  $student_phone = $row['Student_Phone_Number'];
  $class = $row['Class_Name'];
  $cause = $row['Cause'];

  echo "<div id= \"container_2\">
    <form id=\"survey-form\" action=\"form-submit.php\" method = \"post\">
      <input type='hidden' name='Reg_Id' value=$Reg_Id>
      <!---Sponsors Section -->
      <label id=\"name-label\">Sponsor's Name</label>
      <input type=\"text\" id=\"sponsers-name\" name=\"sponsers-name\" class=\"form\" value=\"$sponsor_name\" required><br><!--name--->
      <label id=\"sponsers-email-label\"> Sponsor's Email</label>
      <input type=\"email\" id=\"sponsers-email\" name=\"sponsers-email\" class=\"form\" value=\"$sponsor_email\" required><br><!---email-->
      <label id=\"sponsors-number-label\">Sponsor's Phone Number</label>
      <input type=\"tel\" id=\"sponsers-phone\" name=\"sponsers-phone\" value=\"$sponsor_phone\" required>

      <br>
      <!---Spouse Section -->
      <label id=\"spouses-name-label\">Spouse's Name</label>
      <input type=\"text\" id=\"spouses-name\" name=\"spouses-name\" class=\"form\" value=\"$spouse_name\" required><br>
      <label id=\"spouses-email-label\"> Spouse's Email</label>
      <input type=\"email\" id=\"spouses-email\" name=\"spouses-email\" class=\"form\" value=\"$spouse_email\" required ><br>
      <label id=\"spouses-number-label\">Spouse's Phone Number</label>
      <input type=\"tel\" id=\"spouses-phone\" name=\"spouses-phone\" value=\"$spouse_phone\" required>

      <br>
      </div>
      <div id=\"right\">
      <!---Student Section -->
      <label id=\"students-name-label\">Student's Name</label>
      <input type=\"text\" id=\"students-name\" name=\"students-name\" class=\"form\" required value=\"$student_name\"><br>
      <label id=\"students-email-label\"> Student's Email</label>
      <input type=\"email\" id=\"students-email\" name=\"students-email\" class=\"form\" required value=\"$student_email\"><br
      <label id=\"students-number-label\">Student's Phone Number</label>
      <input type=\"tel\" id=\"students-phone\" name=\"students-phone\" value=\"$student_phone\" required>

      <br>
      <label id=\"class\">Select Class</label>
      <select id=\"dropdown\" name=\"role\" required>
        <option disabled value>
          Select your class
        </option>
        <option value=2 ";
          if ($class == "Python 101")
              echo "selected";
      echo  ">
          Python 101
        </option>
        <option value=1 ";
        if ($class == "Java 101")
            echo "selected";
      echo ">
          Java 101
        </option>
        <option value=4 ";
        if ($class == "Python 201")
            echo "selected";
      echo ">
          Python 201
        </option>
	  <option value=3 ";
        if ($class == "Java 201")
            echo "selected";
      echo ">
		Java 201
	  </option>
	</select>
	<!--dropdown--->
	<p><strong>Cause</strong></p>
	<label>
	  <input type=\"radio\" name=\"cause\" value=\"lib\" ";
        if ($cause == "Library")
            echo "checked=\"checked\"";
      echo ">Library
	</label>
	<br>
	<label>
	  <input type=\"radio\" name=\"cause\" value=\"Dig_class\" ";
        if ($cause == "Digital Classroom")
            echo "checked=\"checked\"";
      echo ">Digital Classroom</label>
	<label>
	  <br>
	  <input type=\"radio\" name=\"cause\" value=\"Other\" ";
        if ($cause == "No Preference")
            echo "checked=\"checked\"";
      echo "> No Preference
	</label><!---radioButtons--->
  <input type='hidden' name='Reg_Id' value='". $Reg_Id . "'/>
  </div>
  ";
}
?>
