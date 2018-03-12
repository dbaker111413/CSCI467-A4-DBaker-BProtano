<?php
  /*
  tables:
  horse(horse_id, name, sire, dam)
  race(race_id,name,distance)   //m is miles, f is furlongs
  runsin(hid,rid,dt,tm,finish)  //hid is fk into horse, rid is fk into race

  */

  $page_title = "Create Customer";
  include ("a4_header.html");
  require ("a4_conn.php");

/* customer info box */
  echo '<div class="container">';
  echo '  <div class="customerBox">';
  echo '    <br>Customer Information:<br><br>';
  echo '    <form name="create", id="create" action="a4_create_customer.php" method="post">';
  echo '    <label for="name">Customer Name </label>';
  echo '    <input type="text" name="name" id="name"><br><br>';
  echo '  </div>';

/* billing address box */
  echo '  <div class="billingBox">';
  echo '    <br>Billing Address:<br><br>';
  echo '    <label for="address1">Address 1 </label>';
  echo '    <input type="text" name="address1" id="address1"><br><br>';

  echo '    <label for="address2">Address 2 </label>';
  echo '    <input type="text" name="address2" id="address2"><br><br>';

  echo '    <label for="city">City </label>';
  echo '    <input type="text" name="city" id="city">';

  echo '    <select>';
  echo '      <option value="il">IL</option>';
  echo '      <option value="ca">CA</option>';
  echo '    </select>';

  echo '    <label for="zip">Zip </label>';
  echo '    <input type="text" name="zip" id="zip"><br><br>';
  echo '  </div>';

/* shipping address box */
  echo '  <div class="shippingBox">';
  echo '    <br>Shipping Address:<br><br>';
  echo '    <label for="sAddress1">Address 1 </label>';
  echo '    <input type="text" name="sAddress1" id="sAddress1"><br><br>';

  echo '    <label for="sAddress2">Address 2 </label>';
  echo '    <input type="text" name="sAddress2" id="sAddress2"><br><br>';

  echo '    <label for="sCity">City </label>';
  echo '    <input type="text" name="sCity" id="sCity">';

  echo '    <select>';
  echo '      <option value="il">IL</option>';
  echo '      <option value="ca">CA</option>';
  echo '    </select>';

  echo '    <label for="sZip">Zip </label>';
  echo '    <input type="text" name="sZip" id="zip"><br><br>';
  echo '  </div>';

/* representative info box */
  echo '  <div class="repBox">';
  echo '    <br>Representative Contact Information:<br><br>';
  echo '    <label for="fName">First Name </label>';
  echo '    <input type="text" name="fName" id="fName">';
  echo '    <label for="lName">Last Name </label>';
  echo '    <input type="text" name="lName" id="lName"><br><br>';

  echo '    <label for="areaCode">Phone ( </label>';
  echo '    <input type="text" name="areaCode" id="areaCode">';
  echo '    <label for="midDigitse"> )  </label>';
  echo '    <input type="text" name="midDigits" id="midDigits">';
  echo '    <label for="endDigitse"> -  </label>';
  echo '    <input type="text" name="endDigits" id="endDigits">';
  echo '    <label for="ext"> (optional) ext. </label>';
  echo '    <input type="text" name="ext" id="ext">';

  echo '    <label for="email">Email </label>';
  echo '    <input type="text" name="email" id="email"><br><br>';
  echo '  </div>';

/* comments box */
  echo '  <div class="commentBox">';
  echo '    <br>Comments (optional):<br><br>';
  echo '    <label for="comment"> </label>';
  echo '    <input type="text" name="comment" id="comment"><br><br>';
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
    if ($_POST['which'] == 'create') {
      $name = $_POST['name'];
      $address1 = $_POST['address1'];
      $address2 = $_POST['address2'];
      $city = $_POST['city'];
      $state = "IL"; /*$_POST['state'];*/
      $zip = $_POST['zip'];
      /*if box for bill = ship logic here */
      $sAddress1 = $_POST['sAddress1'];
      $sAddress2 = $_POST['sAddress2'];
      $sCity = $_POST['sCity'];
      $sState = "IL"; /*$_POST['sState'];*/
      $sZip = $_POST['sZip'];
      $fName = $_POST['fName'];
      $lName = $_POST['lName'];
      $areaCode = $_POST['areaCode'];
      $midDigits = $_POST['midDigits'];
      $endDigits = $_POST['endDigits'];
      $ext = $_POST['ext'];
      $email = $_POST['email'];
      $comment = $_POST['comment'];

      $insertSQL = 'insert into customer ( name, address_line1, address_line2, city, state, zip,
					   ship_address_line1, ship_address_line2, ship_city,
                                           ship_state, ship_zip, fname, lname, phone_area,
                                           phone_middle, phone_end, phone_ext, email, comments )
	     		                   values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
 
      try {
        $stmt = $conn->prepare($insertSQL);
	$ok = $stmt->execute(array($name, $address1, $address2, $city, $state, $zip,
	                           $sAddress1, $sAddress2, $sCity, $sState, $sZip, $fName,
	                           $lName, $areaCode, $midDigits, $endDigits, $ext, $email, 
				   $comment));
        echo ' Customer, '.$name.', added successfully!';
      }
      catch (PDOException $e) {
        echo 'Error, customer could not be added.';
        echo 'Error: '.$e->getMessage();
      }
    }
  }
  
  echo '<br>';
  $section = "Part 1";
  include ("a4_footer.html");
?>
