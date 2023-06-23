<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }
?>

<!DOCTYPE html>
<script>
</script>
<html>
  <head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Learn and Help</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function () {
        $('#causes thead tr').clone(true).appendTo( '#causes thead' );
        $('#causes thead tr:eq(1) th').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });

        var table = $('#causes').DataTable({
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
        <h1><span class="accent-text">Causes</span></h1>
      </div>
    </header>
    <div class="toggle_columns">
      Toggle column: <a class="toggle-vis" data-column="0">Cause</a>
        - <a class="toggle-vis" data-column="1">Description</a>
        - <a class="toggle-vis" data-column="2">URL</a>
        - <a class="toggle-vis" data-column="3">Contact Name</a>
        - <a class="toggle-vis" data-column="4">Contact Email</a>
        - <a class="toggle-vis" data-column="5">Contact Phone</a>
    </div>
    <div style="padding-top: 10px; padding-bottom: 30px; width:90%; margin:auto; overflow:auto">
      <table id="causes" class="display compact">
        <thead>
          <tr>
            <th>Cause</th>
            <th>Description</th>
            <th>URL</th>
            <th>Contact Name</th>
            <th>Contact Email</th>
            <th>Contact Phone</th>
          </tr>
        </thead>
        <?php
          // Pull Cause data from the databases and create a Jquery Datatable
          require 'db_configuration.php';
          $connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
          if ($connection === false) {
            die("Failed to connect to database: " . mysqli_connect_error());
          }
          $sql = "SELECT * FROM causes";
          $result = mysqli_query($connection, $sql);
          if ($result->num_rows > 0) {
            // Create table with data from each row
            while($row = $result->fetch_assoc()) {
              echo '<tr>
                      <td>'.$row['Cause_name'].'</td>
                      <td><p style="text-align: left; word-wrap: break-word;">'.$row['description'].'</p></td>
                      <td>'.$row['URL'].'</td>
                      <td>'.$row['Contact_name'].'</td>
                      <td>'.$row['Contact_phone'].'</td>
                      <td>'.$row['Contact_email'].'</td>
                    </tr>';
            }
          }
        ?>
      </table>
    </div>
  </body>
</html>
