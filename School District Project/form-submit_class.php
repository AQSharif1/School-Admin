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

$Class_Id = null;

if ($action == 'edit' or $action == 'add' or $action == 'admin_edit_class'){
	$class = $_POST['class-name'];
	$description = $_POST['description'];
	


} else {
		$User_Id = $_SESSION['User_Id'];
    $sql = "SELECT * FROM classes NATURAL JOIN users WHERE User_Id = $User_Id";
    $row = mysqli_fetch_array(mysqli_query($connection, $sql));

		$action = '';
    $Class_Id = $row['Class_Id'];
  		$class = $row['Class_Name'];
  		$description = $row['Description'];

}

// FIXME: Hardcoded in relation to database
// Correct method should pull the available classes from the database,
// Allow the user to select one using the interface, and then POST from there.

if ($Class_Id !=null){
	if( $Class_Id ==2){
		$class = "Python 101";
	}
	if( $Class_Id ==4){
		$class = "Python 201";
	}
	if( $Class_Id ==1){
		$class = "Java 101";
	}
	if( $Class_Id ==3){
		$class = "Java 201";
	}
}


if ($action == 'add') {
	$sql = "INSERT INTO classes VALUES (
		NULL,
		'$class',
  		'$description');";

} elseif($action == "edit") {
	$Class_Id = $_POST['Class_Id'];
	$sql = "UPDATE classes SET
			Class_Name = '$class',
			description = '$description'
			WHERE Class_Id = '$Class_Id';";

} elseif($action == "admin_edit_class") {
	$Class_Id = $_POST['Class_Id'];
	$sql = "UPDATE classes SET
			Class_Name = '$class',
			description = '$description'
			WHERE Class_Id = '$Class_Id';";

}

if (!mysqli_query($connection, $sql)) {
	echo("Error description: " . mysqli_error($connection));
  }
if ($action == 'add') {
	$Class_Id = mysqli_insert_id($connection);
	$User_Id = $_SESSION['User_Id'];
	$sql = 'INSERT INTO classes VALUES (' . $User_Id . ', ' . $Class_Id .');';
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
        <h1> <span class=\"accent-text\">Class Submitted</span></h1>
      </div>
  		</header>
		<h3> Class Details </h3>
    <div id=\"container_2\">
		<form action=\"class_edit.php\" method = \"post\">
				<input type='hidden' name='Class_Id' value=$Class_Id>
        <!---Sponsors Section -->
		<label id=\"class\"><b>Selected Class:</b> $class</label><br>
		<input type=\"hidden\" id=\"class\" name=\"class-name\" value=\"$class\">
		<!--dropdown--->
        <label id=\"description-label\"> <b>Description:</b> $description</label><br>
        <br>
		<input type='hidden' name='action' value='edit'>
		<input type=\"submit\" id=\"submit-class\" name=\"submit\" value=\"Edit\"></a>
		<br><br>
	</div>
  </body>
</html>
";
?>
