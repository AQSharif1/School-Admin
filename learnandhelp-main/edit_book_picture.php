<?php
require 'db_configuration.php';

$status = session_status();
if ($status == PHP_SESSION_NONE) {
  session_start();
}

$connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

if ($connection->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$book_id = $_POST['book_id'];
$fileName = $_FILES['file']['name'];
$fileTMP = $_FILES['file']['tmp_name'];
$fileError = $_FILES['file']['error'];
$fileExt = explode('.', $fileName);
$fileActualExt = strtolower(end($fileExt));
$fileDestination = "";
if ($fileError === 0) {
  $fileNewName = uniqid('', true).".".$fileActualExt;
  $fileDestination = 'images/books/'.$fileNewName;
  move_uploaded_file($fileTMP, $fileDestination);
} else {
  echo "There was an error uploading your file.";
}


$sql = "UPDATE book SET image = '$fileDestination' WHERE id = $book_id;";

if (!mysqli_query($connection, $sql)) {
  echo("Error description: " . mysqli_error($connection));
}

mysqli_close($connection);

header('Location: books.php');
?>
