<?php
require 'db_configuration.php';
// Create connection
$conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM causes WHERE Cause_Id = " . $_POST['Cause_Id'];
$result = $conn->query($sql);

$conn->close();
header("Location: admin_causes.php");
?>
