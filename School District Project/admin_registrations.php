<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }

  // Block unauthorized users from accessing the page
  if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] != 'admin') {
      http_response_code(403);
      die('Forbidden');
    }
  } else {
    http_response_code(403);
    die('Forbidden');
  }
 ?>

<!DOCTYPE html>
<script>
</script>
<html>
  <head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Administration</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function () {
      $('#registration_table thead tr').clone(true).appendTo( '#registration_table thead' );
      $('#registration_table thead tr:eq(1) th').each(function () {
      var title = $(this).text();
      $(this).html('<input type="text" placeholder="Search ' + title + '" />');
      });

      var table = $('#registration_table').DataTable({
         initComplete: function () {
             // Apply the search
             this.api()
                 .columns()
                 .every(function () {
                     var that = this;

                     $('input', this.header()).on('keyup change clear', function () {
                         if (that.search() !== this.value) {
                             that.search(this.value).draw();
                         }
                     });
                 });
             },
         });

      $('a.toggle-vis').on('click', function (e) {
      e.preventDefault();

      // Get the column API object
      var column = table.column($(this).attr('data-column'));

      // Toggle the visibility
      column.visible(!column.visible());
      });
     });
    </script>
  </head>
  <body>
  <?php include 'show-navbar.php'; ?>
  <?php show_navbar(); ?>
    <header class="inverse">
      <div class="container">
        <h1><span class="accent-text">Registrations</span></h1>
      </div>
    </header>
    <!-- Jquery Data Table -->
    <div class="toggle_columns">
      Toggle column: <a class="toggle-vis" data-column="0">Reg_Id</a>
        - <a class="toggle-vis" data-column="1">Sponsor Name</a>
        - <a class="toggle-vis" data-column="2">Sponsor Email</a>
        - <a class="toggle-vis" data-column="3">Sponsor Phone Number</a>
        - <a class="toggle-vis" data-column="4">Spouse Name</a>
        - <a class="toggle-vis" data-column="5">Spouse Email</a>
        - <a class="toggle-vis" data-column="6">Spouse Phone Number</a>
        - <a class="toggle-vis" data-column="7">Student Name</a>
        - <a class="toggle-vis" data-column="8">Student Email</a>
        - <a class="toggle-vis" data-column="9">Student Phone Number</a>
        - <a class="toggle-vis" data-column="10">Class</a>
        - <a class="toggle-vis" data-column="11">Cause</a>
        - <a class="toggle-vis" data-column="12">Date Modified</a>
        - <a class="toggle-vis" data-column="13">Date Created</a>
        - <a class="toggle-vis" data-column="14">Options</a>
    </div>
    <div style="padding-top: 10px; padding-bottom: 30px; width:90%; margin:auto; overflow:auto">
      <table id="registration_table" class="display compact">
        <thead>
          <tr>
            <th>Reg Id</th>
            <th>Sponsor Name</th>
            <th>Sponsor Email</th>
            <th>Sponsor Phone Number</th>
            <th>Spouse Name</th>
            <th>Spouse Email</th>
            <th>Spouse Phone Number</th>
            <th>Student Name</th>
            <th>Student Email</th>
            <th>Student Phone Number</th>
            <th>Class</th>
            <th>Cause</th>
            <th>Date Modified</th>
            <th>Date Created</th>
            <th>Options</th>
          </tr>
        </thead>
        <tbody>
          <!-- Populating table with data from the database-->
          <?php
            require 'db_configuration.php';
            // Create connection
            $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM registrations Natural Join classes";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              // Create table with data from each row
              while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Reg_Id"]. "</td><td>" . $row["Sponsor_Name"].
                "</td><td>". $row["Sponsor_Email"]. "</td><td>" .
                $row["Sponsor_Phone_Number"]. "</td><td>" . $row["Spouse_Name"].
                "</td><td>" . $row["Spouse_Email"]. "</td><td>" .
                $row["Spouse_Phone_Number"]. "</td><td>" . $row["Student_Name"].
                "</td><td>" . $row["Student_Email"]. "</td><td>" .
                $row["Student_Phone_Number"]. "</td><td>" . $row["Class_Name"].
                "</td><td>" . $row["Cause"]. "</td><td>" .
                $row["Modified_Time"]. "</td><td>" . $row["Created_Time"].
                "</td>
                <td>
                  <form action='admin_edit.php' method='POST'>
                    <input type='hidden' name='Reg_Id' value='". $row["Reg_Id"] . "'>
                    <input type='submit' id='admin_buttons' name='edit' value='Edit'/>
                  </form>
                  <form action='admin_delete.php' method='POST'>
                    <input type='hidden' name='Reg_Id' value='". $row["Reg_Id"] . "'>
                    <input type='submit' id='admin_buttons' name='delete' value='Delete'/>
                  </form>
                </td>
                </tr>";
              }
            } else {
              echo "0 results";
            }
            $conn->close();
            ?>
        </tbody>
      </table>
    </div>
  </body>
</html>
