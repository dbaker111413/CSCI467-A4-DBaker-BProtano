<?php

/* scripts */
  echo '<script>
        function goBack() {
          window.history.back();
        }
        </script>';

  $page_title = "Confirm Create Customer";
  include ("a4_header.html");
  require ("a4_conn.php");

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['which'] == 'create') {
      $name = $_POST['name'];
      $address1 = $_POST['address1'];
      $address2 = $_POST['address2'];
      $city = $_POST['city'];
      $state = $_POST['billState'];
      $zip = $_POST['zip'];
      //*******if box for bill = ship logic here */
      $sAddress1 = $_POST['sAddress1'];
      $sAddress2 = $_POST['sAddress2'];
      $sCity = $_POST['sCity'];
      $sState = $_POST['shipState'];
      $sZip = $_POST['sZip'];
      $fName = $_POST['fName'];
      $lName = $_POST['lName'];
      $areaCode = $_POST['areaCode'];
      $midDigits = $_POST['midDigits'];
      $endDigits = $_POST['endDigits'];
      $ext = $_POST['ext'];
      $email = $_POST['email'];
      $comment = $_POST['comment'];


      echo '<div class="createCustomerConfirmContainer">';
      echo '  <div class="customerInfo">';
      echo '    <br>Confirm customer Information:<br><br>';
      echo '    <form name="confirm", id="confirm" action="a4_create_customer_confirm.php" method="post">';
      echo '    <label for="name">Customer Name </label>';
      echo htmlspecialchars($name);
      echo '         <br><br>';
      echo '  </div>';  

      echo '  <div class="customerBill">';
      echo '    <br>Billing address:<br><br>';
      echo '    <label>Address 1 </label>';
      echo htmlspecialchars($address1);
      echo '    <label>Address 2 </label>';
      echo htmlspecialchars($address2);
      echo '    <label>City </label>';
      echo htmlspecialchars($city);
      echo '    <label>State </label>';
      echo htmlspecialchars($state);
      echo '    <label>Zip </label>';
      echo htmlspecialchars($zip);
      echo '         <br><br>';
      echo '  </div>';  

      echo '  <div class="customerShip">';
      echo '    <br>Shipping address:<br><br>';
      echo '    <label>Address 1 </label>';
      echo htmlspecialchars($sAddress1);
      echo '    <label>Address 2 </label>';
      echo htmlspecialchars($sAddress2);
      echo '    <label>City </label>';
      echo htmlspecialchars($sCity);
      echo '    <label>State </label>';
      echo htmlspecialchars($sState);
      echo '    <label>Zip </label>';
      echo htmlspecialchars($sZip);
      echo '         <br><br>';
      echo '  </div>';  

      echo '  <div class="customerRep">';
      echo '    <br>Representative contact information:<br><br>';
      echo '    <label>First Name </label>';
      echo htmlspecialchars($fName);
      echo '    <label>Last Name </label>';
      echo htmlspecialchars($lName);
      echo '    <label>Phone ( </label>';
      echo htmlspecialchars($areaCode);
      echo '    <label>)  </label>';
      echo htmlspecialchars($midDigits);
      echo '    <label> - </label>';
      echo htmlspecialchars($endDigits);
      if ($ext != "") {
        echo '<label>ext. </label>';
	echo htmlspecialchars($ext);
      }
      echo '    <label>Email </label>';
      echo htmlspecialchars($email);
      echo '         <br><br>';
      echo '  </div>';  

/* comments box */
      echo '  <div class="customerComment">';
      echo '    <br>Comments<br><br>';
      echo '    <label for="comment"> </label>';
      echo '    <input type="text" name="comment" id="comment" maxlength="240"><br><br>';
      echo '  </div>';

/* cancel box */
      echo '  <div class="customerBack">';
      echo '    <br>';
      echo '    <button onclick="goBack()">Back</button>';
      echo '    <br><br>';
      echo '  </div>';
/* submit box */
      echo '  <div class="customerSubmit">';
      echo '    <br>';
      echo '    <input type="submit" name="submit" id="submit" value="Submit">';
      echo '    <input type="hidden" name="which" id="which" value="confirm">';
      echo '    <br><br>';
      echo '    </form>';
      echo '  </div>';

      echo '</div>';


/*
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
      }*/
    }
  }
  echo '<br>';
  include ("a4_footer.html");
?>
