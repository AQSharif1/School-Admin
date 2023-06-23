<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }
 ?>


<!DOCTYPE html>
<html>
  <head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Learn and Help</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
  <?php include 'show-navbar.php'; ?>
  <?php show_navbar(); ?>
  <header class="inverse">
      <div class="container">
        <h1><span class="accent-text">Receipt</span></h1>
      </div>
  </header>
    <table id="receipt_table">
      <thead>
        <tr>
          <th>Grade Level</th>
          <th>Title</th>
          <th>Publisher</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total Price</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // For each entry, create a row in the table corresponding to that entry
          // Maintain book counts and total costs so they can be displayed below the table
          $total_price = 0;
          $book_count = 0;
          for ($i = 0; $i < $_POST['entry_count']; $i++) {
            $id_key = 'id_' . $i;
            $title_key = 'title_' . $i;
            $publisher_key = 'publisher_' . $i;
            $price_key = 'price_' . $i;
            $quantity_key = 'quantity_' . $i;
            $entry_price = floatval($_POST[$price_key]) * intval($_POST[$quantity_key]);
            echo "<tr>
                    <td>$_POST[$id_key]</td>
                    <td>$_POST[$title_key]</td>
                    <td>$_POST[$publisher_key]</td>
                    <td>$_POST[$price_key]</td>
                    <td>$_POST[$quantity_key]</td>
                    <td>₹$entry_price</td>
                  </tr>";
            $total_price = $total_price + $entry_price;
            $book_count = $book_count + intval($_POST[$quantity_key]);
          }
          echo "  </tr>
                </tbody>
                </table>
                <h3>Book Count: $book_count || Total Price: ₹$total_price</h3>"
        ?>
  </body>
</html>
