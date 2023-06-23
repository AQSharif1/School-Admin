<?php
  require 'db_configuration.php';

  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }

  function fill_blog() {
    $MAX_POSTS = 5;
    // Create connection
    $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM blogs ORDER BY Created_Time DESC";
    $result = $conn->query($sql);
    // Create Post from data from each row
    if ($result->num_rows > 0) {
      $number_of_posts = 0;
      $number_of_pages = 1;
      echo '<div class="blog_page" id="page'. $number_of_pages . '">';
      while($row = $result->fetch_assoc()) {

        #create new page when the posts-per-page has been reached
        if ($number_of_posts == $MAX_POSTS) {
          $number_of_pages += 1;
          echo '
            </div>
            <div class="blog_page" id="page'. $number_of_pages . '" hidden="hidden">
            ';
          $number_of_posts = 0;
        }
        if ($row["Video_Link"] != NULL) {
          $blog_link = '<a class="blog_link" href=' . $row["Video_Link"] . '> Video </a> </div>';
        } else {
          $blog_link = '</div>';
        }
        $picture_sql = "SELECT Location FROM blog_pictures WHERE Blog_Id = " . $row["Blog_Id"];
        $picture_locations = $conn->query($picture_sql);
        $blog_pictures = '';
        if ($picture_locations->num_rows > 0) {
          while($picture = $picture_locations->fetch_assoc()) {
            $blog_pictures = $blog_pictures . '<img class="blog_picture" src="'. $picture['Location'] . '"> <br>';
          }
        }
        $blog_body =
        '
        <div class="blog_post"  id="'. $row['Blog_Id'] . '">
          <h2>' . $row['Title'] . '</h2>
          <h3> By: ' . $row['Author'] . '</h3>
          <p>' . $row['Created_Time'] . '</p>
          <p>' . nl2br($row['Description']) . '</p> <br>
        ';
        echo $blog_body.$blog_pictures.$blog_link;
        $number_of_posts += 1;
      }
      echo '</div>';
    } else {
      echo "0 results";
    }
    $conn->close();
  }

  function fill_TOC() {
    $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT Blog_Id, Title FROM blogs ORDER BY Created_Time DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // Place title in TOC
      while($row = $result->fetch_assoc()) {
        $TOC_Entry = '<li><a onclick="scrollToPost(\'' . $row['Blog_Id'] . '\')">' . $row['Title'] . '</a></li>';
        echo $TOC_Entry;
      }
    } else {
      echo "0 results";
    }
    $conn->close();
  }
  ?>
