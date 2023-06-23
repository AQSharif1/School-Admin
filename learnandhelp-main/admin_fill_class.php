<?php
require 'db_configuration.php';

  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }

function admin_fill_form($Class_Id) {

  $connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

  if ($connection === false) {
    die("Failed to connect to database: " . mysqli_connect_error());
  }
  $sql = "SELECT * FROM classes WHERE Class_ID = '$Class_Id'";
  $row = mysqli_fetch_array(mysqli_query($connection, $sql));

  
  $class = $row['Class_Name'];
  $description = $row['Description'];
 
  echo "<div id= \"container_2\">
    <form id=\"survey-form\" action=\"form-submit_class.php\" method = \"post\">
      <input type='hidden' name='Class_Id' value=$Class_Id>
      <label id=\"description\"> Description</label>
      <input type=\"text\" id=\"description\" name=\"description\" class=\"form\" value=\"placeholder description\" required><br><!---description-->
  
      <br>
      <label id=\"class\">Select Class</label>
      <select id=\"dropdown\" name=\"class-name\" required>
        <option disabled value>
          Select your class
        </option>
        <option value= 'Python 101' ";
          if ($class == "Python 101")
              echo "selected";
      echo  ">
          Python 101
        </option>
        <option value= 'Java 101' ";
        if ($class == "Java 101")
            echo "selected";
      echo ">
          Java 101
        </option>
        <option value= 'Python 201' ";
        if ($class == "Python 201")
            echo "selected";
      echo ">
          Python 201
        </option>
	  <option value= 'Java 201' ";
        if ($class == "Java 201")
            echo "selected";
      echo ">
		Java 201
	  </option>
	</select>
	<!--dropdown--->

  <input type='hidden' name='Class_Id' value='". $Class_Id . "'/>
  </div>
  ";
}
?>
