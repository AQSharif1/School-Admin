<?php
require 'db_configuration.php';

$status = session_status();
if ($status == PHP_SESSION_NONE) {
  session_start();
}


function fill_form() {

  if (isset($_COOKIE['email']) and !isset($_POST['action'])){
    $student_email = $_COOKIE['email'];
    $connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

    if ($connection === false) {
  	  die("Failed to connect to database: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM classes WHERE Student_Email = '$student_email'";
    $row = mysqli_fetch_array(mysqli_query($connection, $sql));
    $db_id = $row['Class_Id'];
    $class = $row['Class_Name'];
    $description = $row['Description'];
    
  } else {
    $db_id = $_POST['Class_Id'];
  	$class = $_POST['class-name'];
	  $description = $_POST['description'];
  }
  echo "<div id= \"container_2\">
  <form id=\"survey-form\" action=\"form-submit_class.php\" method = \"post\">
    <input type='hidden' name='Class_Id' value=$db_id>

    <br>
    <label id=\"class\">Select Class</label>
    <select id=\"dropdown\" name=\"class-name\" required>
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
</div>
    ";
}
?>
