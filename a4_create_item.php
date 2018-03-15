<?php
  $page_title = "Create Item";
  include ("a4_header.html");
  require ("a4_conn.php");

  /* item info box */
  echo '<div class="container">';
  echo '  <div class="itemNumBox">';
  echo '    <br>Item Information: <br><br>';
  echo '    <form name="create", id="create" action="a4_create_item.php" method="post">';
  echo '      <label for="itemDesc">Item Description: </label>';
  echo '      <input type="text" name="itemDesc" id="itemDesc"><br><br>';
  
  echo '  </div>';

  /* item attributes box */
  echo '  <div class="itemAttributesBox">';
  echo '    <br>Item Attributes: <br><br>';
  echo '    <label for="uom">Unit of Measurement: </label>';
  echo '    <input type="text" name="uom" id="uom"><br><br>';

  echo '    <label for="warehouseLoc">Warehouse Location: </label>';
  echo '    <input type="text" name="warehouseLoc" id="warehouseLoc"><br><br>';

  echo '    <label for="qty">Initial Quantity On Hand: </label>';
  echo '    <input type="text" name="qty" id="qty"><br><br>';

  echo '    <label for="price">Unit Price: </label>';
  echo '    <input type="text" name="price" id="price"><br><br>';

  echo '  </div>';

  /* cancel box */
  echo '  <div class="cancelBox">';
  echo '    <br>';
  echo '    <input type="reset" name="reset" id="reset" value="Cancel">';
  echo '    <br><br>';
  echo '  </div>';

  /* submit box */
  echo '  <div class="submitBox">';
  echo '    <br>';
  echo '    <input type="submit" name="submit" id="submit" value="Submit">';
  echo '    <input type="hidden" name="which" id="which" value="create">';
  echo '    <br><br>';
  echo '    </form>';
  echo '  </div>';
  echo '</div>';

/**************************************************/
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