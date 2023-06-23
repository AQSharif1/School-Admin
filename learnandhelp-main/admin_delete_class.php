<?php
require 'db_configuration.php';
// Create connection
$conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM classes WHERE Class_Id = " . $_POST['Class_Id'];
$result = $conn->query($sql);

$conn->close();
header("Location: admin_classes.php");
?>
