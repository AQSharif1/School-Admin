<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }
 ?>
<!DOCTYPE html>
<html lang="en-us">
  <head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Administration</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
    <?php include 'show-navbar.php'; ?>
    <?php show_navbar(); ?>
    <header class="inverse">
      <div class="container">
        <h1><span class="accent-text">Schools</span></h1>
      </div>
    </header>
    <div id="admin_icons" style="width: 75%; margin: auto;">
      <div class="admin_icon">
        <a href="schools_1.php?id=777" id="1"><img src="images/school.png" alt="private Heights"></a>
        <br>
        <label for="School_1">777</label>
      </div>
      <div class="admin_icon">
        <a href="schools_1.php?id=1010"id="2"><img src="images/school.png" alt="Dreamville"></a>
        <br>
        <label for="School_2">1010</label>
      </div>
      <div class="admin_icon">
        <a href="schools_1.php?id=4719" id="3"><img src="images/school.png" alt="Eagle Fly Academy"></a>
        <br>
        <label for="School_3">4719</label>
      </div>
      <br>
      <div class="admin_icon">
        <a href="schools_1.php?id=9009" id="4"><img src="images/school.png"  alt="Middle Ground"></a>
        <br>
        <label for="School_4">9009</label>
      </div>
 
  
        
      </div>
    </div>
  </body>
</html>
