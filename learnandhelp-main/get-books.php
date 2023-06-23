<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }
  require 'db_configuration.php';
  // Create connection
  $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM book ORDER BY id;";
  $result = $conn->query($sql);
  $resultString = "";
  if ($result->num_rows > 0) {
    // Create table with data from each row
    while($row = $result->fetch_assoc()) {
      if (isset($_SESSION['role']) AND $_SESSION['role'] == 'admin') {
        $resultString .= "<tr>
               <td><div contenteditable='true' onBlur='updateValue(this,\"grade_level\",". $row["id"] .")'>" . $row["grade_level"]. "</div></td>
               <td id='book_image'><img src='" . $row["image"] . "' onerror=\"src='images/books/default.png'\" loading='lazy'></td>
               <td><div contenteditable='true' onBlur='updateValue(this,\"title\",". $row["id"] .")'>" . $row["title"]. "</div></td>
               <td><div contenteditable='true' onBlur='updateValue(this,\"author\",". $row["id"] .")'>" . $row["author"]. "</div></td>
               <td><div contenteditable='true' onBlur='updateValue(this,\"publisher\",". $row["id"] .")'>" . $row["publisher"]. "</div></td>
               <td><div contenteditable='true' onBlur='updateValue(this,\"publishYear\",". $row["id"] .")'>" . $row["publishYear"]. "</div></td>
               <td><div contenteditable='true' onBlur='updateValue(this,\"numPages\",". $row["id"] .")'>" . $row["numPages"]. "</div></td>
               <td><div contenteditable='true' onBlur='updateValue(this,\"price\",". $row["id"] .")'>" . $row["price"]. "</div></td>
               <td><Button onclick='addToList(this)'>Add to List</Button></td>
               <td style='min-width: 300px;'>
                 <form action='edit_book_picture.php' method='post' enctype='multipart/form-data'>
                   <input type='file' name='file' accept='image/*'>
                   <input type='hidden' name='book_id' value='".$row['id']."'>
                   <input type='submit' value='Change Picture'>
                 </form>
              </tr>";
      } else {
        $resultString .= "<tr>
               <td>" . $row["grade_level"] . "</td>
               <td id='book_image'><img src='" . $row["image"] . "' onerror=\"src='images/books/default.png'\"></td>
               <td>" . $row["title"] . "</td>
               <td>" . $row["author"] . "</td>
               <td>" . $row["publisher"] . "</td>
               <td>" . $row["publishYear"] . "</td>
               <td>" . $row["numPages"] . "</td>
               <td>" . $row["price"] . "</td>
               <td><Button onclick='addToList(this)'>Add to List</Button></td>
              </tr>";
      }
    }
  }

  echo json_encode(["data" => $resultString]);

  $conn->close();
  ?>
