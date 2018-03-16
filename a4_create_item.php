<?php
  require ("a4_conn.php");
  $page_title = "Create Item";
  include ("a4_header.html");
  include ("html/item.html");

  // handles a post request to create an item when the submit button is clicked in item.html
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['which']) == 'create') {
      // confirm that the user actually wants to insert this item
      echo "<script type='text/javascript'>confirm('Are you sure you want to create this item?');</script>";
      if(confirm("Are you sure you want to create this item?")){
        $itemDesc = $_POST['itemDesc'];
        $uom = $_POST['uom'];
        $warehouseLoc = $_POST['warehouseLoc'];
        $qty = $_POST['qty'];
        $price = $_POST['price'];
      
        $insertSQL = 'insert into item ( description, uom, location, on_hand, price)
	     		               values (?, ?, ?, ?, ?)';
 
        try {
          $stmt = $conn->prepare($insertSQL);
	  $ok = $stmt->execute(array($itemDesc, $uom, $warehouseLoc, $qty, $price));
	  $message = "Item added successfully!";
          echo "<script type='text/javascript'>alert('$message');</script>";
        }
        catch (PDOException $e) {
          echo 'Error, customer could not be added.';
          echo 'Error: '.$e->getMessage();
        }
      }
    }
  }
  echo '<br>';
  $section = "Part 1";
  include ("a4_footer.html");
?>