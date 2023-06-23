<?php
require 'db_configuration.php';

$status = session_status();
if ($status == PHP_SESSION_NONE) {
  session_start();
}

if (!(isset($_SESSION['email']))) {
	header('Location: login.php');
}

include 'show-navbar.php';
$connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

if ($connection === false) {
	die("Failed to connect to database: " . mysqli_connect_error());
}
if (isset($_POST['action'])) {
	$action = $_POST['action'];
} else {
	$action = '';
}

if ($action == 'edit' or $action == 'add' or $action == 'admin_edit'){
	$sponsor_name = $_POST['sponsers-name'];
	$sponsor_email = $_POST['sponsers-email'];
	$sponsor_phone = $_POST['sponsers-phone'];
	$spouse_name = $_POST['spouses-name'];
	$spouse_email = $_POST['spouses-email'];
	$spouse_phone = $_POST['spouses-phone'];
	$student_name = $_POST['students-name'];
	$student_email = $_POST['students-email'];
	$student_phone = $_POST['students-phone'];
	$class_id = $_POST['role'];
	$cause = $_POST['cause'];
	$timestamp = date("Y-m-d");

} else {
		$User_Id = $_SESSION['User_Id'];
    $sql = "SELECT * FROM registrations NATURAL JOIN classes NATURAL JOIN user_registrations WHERE User_Id = $User_Id";
    $row = mysqli_fetch_array(mysqli_query($connection, $sql));

		$action = '';
    $Reg_Id = $row['Reg_Id'];
		$sponsor_name = $row['Sponsor_Name'];
		$sponsor_email = $row['Sponsor_Email'];
		$sponsor_phone = $row['Sponsor_Phone_Number'];
		$spouse_name = $row['Spouse_Name'];
		$spouse_email = $row['Spouse_Email'];
		$spouse_phone = $row['Spouse_Phone_Number'];
		$student_name = $row['Student_Name'];
		$student_email = $row['Student_Email'];
		$student_phone = $row['Student_Phone_Number'];
		$class_id = $row['Class_Id'];
		$cause = $row['Cause'];

}

// FIXME: Hardcoded in relation to database
// Correct method should pull the available classes from the database,
// Allow the user to select one using the interface, and then POST from there.

switch ($class_id){
	case 2:
		$class = "Python 101";
		break;
	case 4:
		$class = "Python 201";
		break;
	case 1:
		$class = "Java 101";
		break;
	case 3:
		$class = "Java 201";
}

switch ($cause){ // FIXME: Hardcoded in.
	case "lib":
		$cause = "Library";
		break;
	case "Dig_class":
		$cause = "Digital Classroom";
		break;
	case "Other":
		$cause = "No Preference";
}

if ($action == 'add') {
	$sql = "INSERT INTO registrations VALUES (
		NULL,
		'$sponsor_name',
		'$sponsor_email',
		'$sponsor_phone',
		'$spouse_name',
		'$spouse_email',
		'$spouse_phone',
		'$student_name',
		'$student_email',
		'$student_phone',
		'$class_id',
		'$cause',
		'$timestamp',
		'$timestamp');";

} elseif($action == "edit") {
	$Reg_Id = $_POST['Reg_Id'];
	$sql = "UPDATE registrations SET
			Sponsor_Name = '$sponsor_name',
			Sponsor_Email = '$sponsor_email',
			Sponsor_Phone_Number = '$sponsor_phone',
			Spouse_Name = '$spouse_name',
			Spouse_Email = '$spouse_email',
			Spouse_Phone_Number = '$spouse_phone',
			Student_Name = '$student_name',
			Student_Email = '$student_email',
			Student_Phone_Number = '$student_phone',
			Class_Id = '$class_id',
			Cause = '$cause',
			Modified_Time = '$timestamp'
			WHERE Reg_Id = '$Reg_Id';";

} elseif($action == "admin_edit") {
	$Reg_Id = $_POST['Reg_Id'];
	$sql = "UPDATE registrations SET
			Sponsor_Name = '$sponsor_name',
			Sponsor_Email = '$sponsor_email',
			Sponsor_Phone_Number = '$sponsor_phone',
			Spouse_Name = '$spouse_name',
			Spouse_Email = '$spouse_email',
			Spouse_Phone_Number = '$spouse_phone',
			Student_Name = '$student_name',
			Student_Email = '$student_email',
			Student_Phone_Number = '$student_phone',
			Class_Id = '$class_id',
			Cause = '$cause',
			Modified_Time = '$timestamp'
			WHERE Reg_Id = '$Reg_Id';";

}

if (!mysqli_query($connection, $sql)) {
	echo("Error description: " . mysqli_error($connection));
  }
if ($action == 'add') {
	$Reg_Id = mysqli_insert_id($connection);
	$User_Id = $_SESSION['User_Id'];
	$sql = 'INSERT INTO user_registrations VALUES (' . $User_Id . ', ' . $Reg_Id .');';
	if (!mysqli_query($connection, $sql)) {
		echo("Error description: " . mysqli_error($connection));
	 }
}
mysqli_close($connection);

echo "<!DOCTYPE html>
<!DOCTYPE html>
  <head>
    <title>Learn and Help</title>
		<link rel=\"icon\" href=\"images/icon_logo.png\" type=\"image/icon type\">
    <link href=\"https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap\" rel=\"stylesheet\">
    <link href=\"css/main.css\" rel=\"stylesheet\">
  </head>
  <body>";
		show_navbar();
	echo  "<header class=\"inverse\">
      <div class=\"container\">
        <h1> <span class=\"accent-text\">Registration Submitted</span></h1>
      </div>
  		</header>
		<h3> Registration Details </h3>
    <div id=\"container_2\">
		<form action=\"registration_edit.php\" method = \"post\">
				<input type='hidden' name='Reg_Id' value=$Reg_Id>
        <!---Sponsors Section -->
        <label id=\"name-label\"><b>Sponsor's Name:</b> $sponsor_name</label><br>
        <input type=\"hidden\" id=\"action\" name=\"action\" value=\"edit\">
        <label id=\"sponsers-email-label\"> <b>Sponsor's Email:</b> $sponsor_email</label><br>
		<label id=\"sponsors-number-label\"><b>Sponsor's Phone Number:</b> $sponsor_phone</label><br>
        <input type=\"hidden\" id=\"sponsers-name\" name=\"sponsers-name\" class=\"form\" value=\"$sponsor_name\"><!--name--->
		<input type=\"hidden\" id=\"sponsers-email\" name=\"sponsers-email\" class=\"form\" value=\"$sponsor_email\"><br><!---email-->
        <input type=\"hidden\" id=\"sponsers-phone\" name=\"sponsers-phone\" value=\"$sponsor_phone\">

        <br>
        <!---Spouse Section -->
        <label id=\"spouses-name-label\"><b>Spouse's Name:</b> $spouse_name</label><br>

        <label id=\"spouses-email-label\"> <b>Spouse's Email:</b> $spouse_email</label><br>

        <label id=\"spouses-number-label\"><b>Spouse's Phone Number:</b> $spouse_phone</label><br>
		<input type=\"hidden\" id=\"spouses-name\" name=\"spouses-name\" class=\"form\" value=\"$spouse_name\"><!--name--->
		<input type=\"hidden\" id=\"spouses-email\" name=\"spouses-email\" class=\"form\" value=\"$spouse_email\"><br><!---email-->
        <input type=\"hidden\" id=\"spouses-phone\" name=\"spouses-phone\" value=\"$spouse_phone\">

        <br>
        <!---Student Section -->
        <label id=\"students-name-label\"><b>Student's Name:</b> $student_name</label><br>

        <label id=\"students-email-label\"><b>Student's Email:</b> $student_email</label><br>

        <label id=\"students-number-label\"><b>Student's Phone Number:</b> $student_phone</label><br>
		<input type=\"hidden\" id=\"students-name\" name=\"students-name\" class=\"form\" value=\"$student_name\"><!--name--->
		<input type=\"hidden\" id=\"students-email\" name=\"students-email\" class=\"form\" value=\"$student_email\"><br><!---email-->
        <input type=\"hidden\" id=\"students-phone\" name=\"students-phone\" value=\"$student_phone\">

        <br>
        <label id=\"class\"><b>Selected Class:</b> $class</label><br>
		<input type=\"hidden\" id=\"class\" name=\"class\" value=\"$class\">
		<!--dropdown--->
		<p><b>Cause:</b> $cause</p><br>
		<input type=\"hidden\" id=\"cause\" name=\"cause\" value=\"$cause\">
		<br>
		<input type='hidden' name='action' value='edit'>
		<input type=\"submit\" id=\"submit-registration\" name=\"submit\" value=\"Edit\"></a>
		<br><br>
	</div>
  </body>
</html>
";
?>
