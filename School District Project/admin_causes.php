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
        - <a class="toggle-vis" data-column="6">Delete</a>
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
            <th>Delete</th>
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
              echo "<tr>
                      <td><div contenteditable='true' onBlur='updateValue(this,\"Cause_name\",". $row["Cause_Id"] .")'>" . $row["Cause_name"]. "</div></td>
                      <td><div contenteditable='true' onBlur='updateValue(this,\"description\",". $row["Cause_Id"] .")'>" . $row["description"]. "</div></td>
                      <td><div contenteditable='true' onBlur='updateValue(this,\"URL\",". $row["Cause_Id"] .")'>" . $row["URL"]. "</div></td>
                      <td><div contenteditable='true' onBlur='updateValue(this,\"Contact_name\",". $row["Cause_Id"] .")'>" . $row["Contact_name"]. "</div></td>
                      <td><div contenteditable='true' onBlur='updateValue(this,\"Contact_email\",". $row["Cause_Id"] .")'>" . $row["Contact_email"]. "</div></td>
                      <td><div contenteditable='true' onBlur='updateValue(this,\"Contact_phone\",". $row["Cause_Id"] .")'>" . $row["Contact_phone"]. "</div></td>
                      <td>
                        <form action='admin_delete_cause.php' method='POST'>
                          <input type='hidden' name='Cause_Id' value='". $row["Cause_Id"] . "'>
                          <input type='submit' id='admin_buttons' name='delete' value='Delete'/>
                        </form>
                      </td>
                    </tr>";
            }
          }
        ?>
      </table>
    </div>
    <h1>Add New</h1>
    <form action="update_causes.php" method="post" id="add_cause">
      <input type="text" name="name" placeholder="Cause name" required>
      <textarea type="textarea" rows=9 cols=90 name="description" placeholder="Cause Description" required></textarea>
      <input type="text" name="URL" placeholder="URL" required>
      <input type="text" name="contact_name" placeholder="Contact name" required>
      <input type="email" id="contact-email" name="contact_email" class="form" required placeholder="Contact email">
      <input type="tel" id="contact-phone" name="contact_phone" placeholder="123-456-7899" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
      <input type="hidden" name="action" value="add" >
      <input type="submit" value="Add" style="width: 33%">
    </form>
  </body>
  <!--JQuery-->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

   <script type="text/javascript" charset="utf8"
           src="https://code.jquery.com/jquery-3.3.1.js"></script>
   <script type="text/javascript" charset="utf8"
           src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
   <script>
     function updateValue(element,column,id){
           console.log(element.innerText)
           var value = element.innerText
           $.ajax({
               url:'inline-edit.php',
               type: 'post',
               data:{
                   value: value,
                   column: column,
                   id: id,
                   table: "causes",
                   idName: "Cause_Id"
               },
               success:function(php_result){
           console.log(php_result);

               }

           })
       }
    </script>
</html>
