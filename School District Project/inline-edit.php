<?php
include 'db_configuration.php';

    $connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    if ($connection === false) {
        die("Failed to connect to database: " . mysqli_connect_error());
    }

    $value = $_POST['value'];
    $column = $_POST['column'];
    $id = $_POST['id'];
    $table = $_POST['table'];
    $idName = $_POST['idName'];

    $sql="UPDATE $table SET $column = '$value' WHERE $idName = '$id'";
    mysqli_query($connection, $sql);


?>
