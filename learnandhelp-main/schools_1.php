<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Learn and Help</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function () {
        $('#schools thead tr').clone(true).appendTo( '#schools thead' );
        $('#schools thead tr:eq(1) th').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });

      var table = $('#schools').DataTable({
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
<div>
</div>
<?php include 'show-navbar.php'; ?>
<?php show_navbar(); ?>
<header class="inverse">
    <div class="container">
        <h1><span class="accent-text">Schools</span></h1>
    </div>
</header>
<div class="toggle_columns">
Toggle column: 
        - <a class="toggle-vis" data-column="0">Name</a>
        - <a class="toggle-vis" data-column="1">Type</a>
        - <a class="toggle-vis" data-column="2">Category</a>
        - <a class="toggle-vis" data-column="3">Grade_Level_Start</a>
        - <a class="toggle-vis" data-column="4">Grade_Level_End</a>
        - <a class="toggle-vis" data-column="5">Current_Enrollment</a>
        - <a class="toggle-vis" data-column="6">Address_Text</a>
        - <a class="toggle-vis" data-column="7">State_Name</a>
        - <a class="toggle-vis" data-column="8">State_Code</a>
        - <a class="toggle-vis" data-column="9">Pin_Code</a>
        - <a class="toggle-vis" data-column="10">Contact_Name</a>
        - <a class="toggle-vis" data-column="11">Contact_Designation</a>
        - <a class="toggle-vis" data-column="12">Contact_Phone</a>
        - <a class="toggle-vis" data-column="13">Contact_Email</a>
        - <a class="toggle-vis" data-column="14">Status</a>
        - <a class="toggle-vis" data-column="15">Notes</a>
</div>
<div style="padding-top: 10px; padding-bottom: 30px; width:90%; margin:auto; overflow:auto">
    <table id="schools" class="display compact">
        <thead>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Category</th>
            <th>Grade Level Start</th>
            <th>Grade Level End</th>
            <th>Current Enrollment</th>
            <th>Address Text</th>
            <th>State Name</th>
            <th>State Code</th>
            <th>Pin Code</th>
            <th>Contact Name</th>
            <th>Contact Designation</th>
            <th>Contact Phone</th>
            <th>Contact Email</th>
            <th>Status</th>
            <th>Notes</th>
          </tr>
        </thead>
        <?php

        // Pull school data from the databases and create a Jquery Datatable
        require 'db_configuration.php';
        $connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
        
        if ($connection->connect_error) {
            die("Failed to connect to database: " . $connection->connect_error);
        }

        $id = $_GET['id']; 

        if (isset($id)){
            if($id == 777) {        
                $sql = "SELECT * FROM schools WHERE id = ?";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
        
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<tr><td>" . $row["name"] . "</td><td>" . $row["type"] .
                    "</td><td>" . $row["category"] . "</td><td>" .
                    $row["grade_level_start"] . "</td><td>" . $row["grade_level_end"] .
                    "</td><td>" . $row["current_enrollment"] . "</td><td>" .
                    $row["address_text"] . "</td><td>" . $row["state_name"] .
                    "</td><td>" . $row["state_code"] . "</td><td>" .
                    $row["pin_code"] . "</td><td>" . $row["contact_name"] .
                    "</td><td>" . $row["contact_designation"] . "</td><td>" .
                    $row["contact_phone"] . "</td><td>" . $row["contact_email"] .
                    "</td><td>" . $row["status"] . "</td><td>" . $row["notes"] . "</td></tr>";
                    }
                }
            if($id == 1010) {        
                $sql = "SELECT * FROM schools WHERE id = ?";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
            
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<tr><td>" . $row["name"] . "</td><td>" . $row["type"] .
                    "</td><td>" . $row["category"] . "</td><td>" .
                    $row["grade_level_start"] . "</td><td>" . $row["grade_level_end"] .
                    "</td><td>" . $row["current_enrollment"] . "</td><td>" .
                    $row["address_text"] . "</td><td>" . $row["state_name"] .
                    "</td><td>" . $row["state_code"] . "</td><td>" .
                    $row["pin_code"] . "</td><td>" . $row["contact_name"] .
                    "</td><td>" . $row["contact_designation"] . "</td><td>" .
                    $row["contact_phone"] . "</td><td>" . $row["contact_email"] .
                    "</td><td>" . $row["status"] . "</td><td>" . $row["notes"] . "</td></tr>";
                }
            }
                    
            if($id == 9009) {        
                $sql = "SELECT * FROM schools WHERE id = ?";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
        
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<tr><td>" . $row["name"] . "</td><td>" . $row["type"] .
                    "</td><td>" . $row["category"] . "</td><td>" .
                    $row["grade_level_start"] . "</td><td>" . $row["grade_level_end"] .
                    "</td><td>" . $row["current_enrollment"] . "</td><td>" .
                    $row["address_text"] . "</td><td>" . $row["state_name"] .
                    "</td><td>" . $row["state_code"] . "</td><td>" .
                    $row["pin_code"] . "</td><td>" . $row["contact_name"] .
                    "</td><td>" . $row["contact_designation"] . "</td><td>" .
                    $row["contact_phone"] . "</td><td>" . $row["contact_email"] .
                    "</td><td>" . $row["status"] . "</td><td>" . $row["notes"] . "</td></tr>";
                    }
            }
            if($id == 4719) {        
                $sql = "SELECT * FROM schools WHERE id = ?";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
        
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<tr><td>" . $row["name"] . "</td><td>" . $row["type"] .
                    "</td><td>" . $row["category"] . "</td><td>" .
                    $row["grade_level_start"] . "</td><td>" . $row["grade_level_end"] .
                    "</td><td>" . $row["current_enrollment"] . "</td><td>" .
                    $row["address_text"] . "</td><td>" . $row["state_name"] .
                    "</td><td>" . $row["state_code"] . "</td><td>" .
                    $row["pin_code"] . "</td><td>" . $row["contact_name"] .
                    "</td><td>" . $row["contact_designation"] . "</td><td>" .
                    $row["contact_phone"] . "</td><td>" . $row["contact_email"] .
                    "</td><td>" . $row["status"] . "</td><td>" . $row["notes"] . "</td></tr>";
                    }
            }


                            else {
                echo "No school found.";
            }
            $stmt->close();
        } 
         else {
            echo "Invalid School ID input.";
        }
    
        ?>
    </table>
</div>
</body>
</html>
