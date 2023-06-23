<?php
require 'db_configuration.php';
$connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
$action = $_POST['action'];
$name = $_POST['name'];
$desc = $_POST['description'];
if ($action == 'add') {
    $sql = "INSERT INTO classes VALUES
    (NULL, '$name','$desc')";
} else if ($action == 'update') {
    $id = $_POST['rowId'];
    $sql = "UPDATE classes SET
            Class_name = '$name',
            Description = '$desc'
            WHERE Class_Id = '$id'";
} else if ($action == 'delete')
    $sql = "DELETE FROM classes WHERE Class_Id = $id";
if (!mysqli_query($connection, $sql)) {
    echo("Error description: " . mysqli_error($connection));
}
mysqli_close($connection);
header("Location: admin_classes.php");
echo $action;
?>
