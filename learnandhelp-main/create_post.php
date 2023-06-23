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

if (isset($_POST['create_post'])) {
  $title = addslashes($_POST['title']);
  $author = addslashes($_POST['author']);
  $description = addslashes($_POST['description']);
  $video_link = $_POST['video_link'];
  $timestamp = date("Y-m-d H:i:s");
  $fileNameArray = [];
  for($i = 0; $i < count($_FILES['file']['name']); $i++) {
    $fileName = $_FILES['file']['name'][$i];
    $fileTMP = $_FILES['file']['tmp_name'][$i];
    $fileError = $_FILES['file']['error'][$i];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    if ($fileError === 0) {
      $fileNewName = uniqid('', true).".".$fileActualExt;
      $fileDestination = 'images/blog_pictures/'.$fileNewName;
      move_uploaded_file($fileTMP, $fileDestination);
      array_push($fileNameArray, $fileDestination);
    } else {
      echo "There was an error uploading your file.";
    }
  }

  $sql = "INSERT INTO blogs VALUES (
		NULL,
		'$title',
    '$author',
    '$description',
    '$video_link',
    '$timestamp',
    '$timestamp');";

  if (!mysqli_query($connection, $sql)) {
    echo("Error description: " . mysqli_error($connection));
  } else {
    $last_id = mysqli_insert_id($connection);
    foreach($fileNameArray as $location){
      $sql = "INSERT INTO blog_pictures VALUES (
        NULL,
        '$last_id',
        '$location');";

      if (!mysqli_query($connection, $sql)) {
        echo("Error description: " . mysqli_error($connection));
      }
    }
  }
}

mysqli_close($connection);

header('Location: blog.php');
?>
