<?php
  /*
  tables:
  horse(horse_id, name, sire, dam)
  race(race_id,name,distance)   //m is miles, f is furlongs
  runsin(hid,rid,dt,tm,finish)  //hid is fk into horse, rid is fk into race

  */

/* script stuff */

  echo '<script>
       function autoTab(current,to) {
	 if(current.getAttribute && current.value.length == current.getAttribute("maxlength")){
           to.focus()
	 }
       }
       </script>
       '; // end javascript echo

  $page_title = "Create Customer";
  include ("a4_header.html");
  require ("a4_conn.php");

/* customer info box */
  echo '<div class="container">';
  echo '  <div class="customerBox">';
  echo '    <br>Customer Information:<br><br>';
  echo '    <form name="create", id="create" action="a4_create_customer_confirm.php" onsubmit="return validateForm()" method="post">';
  echo '    <label for="name">Customer Name </label>';
  echo '    <input type="text" required name="name" id="name" maxlength="25"><br><br>';
  echo '  </div>';

/* billing address box */
  echo '  <div class="billingBox">';
  echo '    <br>Billing Address:<br><br>';
  echo '    <label for="address1">Address 1 </label>';
  echo '    <input type="text" required name="address1" id="address1" maxlength="25"><br><br>';

  echo '    <label for="address2">Address 2 </label>';
  echo '    <input type="text" required name="address2" id="address2" maxlength="25"><br><br>';

  echo '    <label for="city">City </label>';
  echo '    <input type="text" required name="city" id="city" maxlength="25">';

  echo '    <label for="billState">State </label>';
  echo '    <select id="billState" name="billState" selected="IL">
              <option value="AL">Alabama</option>
              <option value="AK">Alaska</option>
              <option value="AZ">Arizona</option>
              <option value="AR">Arkansas</option>
              <option value="CA">California</option>
              <option value="CO">Colorado</option>
              <option value="CT">Connecticut</option>
              <option value="DE">Delaware</option>
              <option value="DC">District Of Columbia</option>
              <option value="FL">Florida</option>
              <option value="GA">Georgia</option>
              <option value="HI">Hawaii</option>
              <option value="ID">Idaho</option>
              <option value="IL" selected="selected">Illinois</option>
              <option value="IN">Indiana</option>
              <option value="IA">Iowa</option>
              <option value="KS">Kansas</option>
              <option value="KY">Kentucky</option>
              <option value="LA">Louisiana</option>
              <option value="ME">Maine</option>
              <option value="MD">Maryland</option>
              <option value="MA">Massachusetts</option>
              <option value="MI">Michigan</option>
              <option value="MN">Minnesota</option>
              <option value="MS">Mississippi</option>
              <option value="MO">Missouri</option>
              <option value="MT">Montana</option>
              <option value="NE">Nebraska</option>
              <option value="NV">Nevada</option>
              <option value="NH">New Hampshire</option>
              <option value="NJ">New Jersey</option>
              <option value="NM">New Mexico</option>
              <option value="NY">New York</option>
              <option value="NC">North Carolina</option>
              <option value="ND">North Dakota</option>
              <option value="OH">Ohio</option>
              <option value="OK">Oklahoma</option>
              <option value="OR">Oregon</option>
              <option value="PA">Pennsylvania</option>
              <option value="RI">Rhode Island</option>
              <option value="SC">South Carolina</option>
              <option value="SD">South Dakota</option>
              <option value="TN">Tennessee</option>
              <option value="TX">Texas</option>
              <option value="UT">Utah</option>
              <option value="VT">Vermont</option>
              <option value="VA">Virginia</option>
              <option value="WA">Washington</option>
              <option value="WV">West Virginia</option>
              <option value="WI">Wisconsin</option>
              <option value="WY">Wyoming</option>
            </select>';

  echo '    <label for="zip">Zip </label>';
  echo '    <input type="text" required name="zip" id="zip" pattern="\d*" title="Valid 6 digit zip code" minlength="6" maxlength="6"><br><br>';
  echo '  </div>';

/* shipping address box */
  echo '  <div class="shippingBox">';
  echo '    <br>Shipping Address:<br><br>';
  echo '    <label for="sAddress1">Address 1 </label>';
  echo '    <input type="text" required name="sAddress1" id="sAddress1" maxlength="25"><br><br>';

  echo '    <label for="sAddress2">Address 2 </label>';
  echo '    <input type="text" required name="sAddress2" id="sAddress2" maxlength="25"><br><br>';

  echo '    <label for="sCity">City </label>';
  echo '    <input type="text" required name="sCity" id="sCity" maxlength="25">';

  echo '    <label for="shipState">State </label>';
  echo '    <select id="shipState" name="shipState">
              <option value="AL">Alabama</option>
              <option value="AK">Alaska</option>
              <option value="AZ">Arizona</option>
              <option value="AR">Arkansas</option>
              <option value="CA">California</option>
              <option value="CO">Colorado</option>
              <option value="CT">Connecticut</option>
              <option value="DE">Delaware</option>
              <option value="DC">District Of Columbia</option>
              <option value="FL">Florida</option>
              <option value="GA">Georgia</option>
              <option value="HI">Hawaii</option>
              <option value="ID">Idaho</option>
              <option value="IL" selected="selected">Illinois</option>
              <option value="IN">Indiana</option>
              <option value="IA">Iowa</option>
              <option value="KS">Kansas</option>
              <option value="KY">Kentucky</option>
              <option value="LA">Louisiana</option>
              <option value="ME">Maine</option>
              <option value="MD">Maryland</option>
              <option value="MA">Massachusetts</option>
              <option value="MI">Michigan</option>
              <option value="MN">Minnesota</option>
              <option value="MS">Mississippi</option>
              <option value="MO">Missouri</option>
              <option value="MT">Montana</option>
              <option value="NE">Nebraska</option>
              <option value="NV">Nevada</option>
              <option value="NH">New Hampshire</option>
              <option value="NJ">New Jersey</option>
              <option value="NM">New Mexico</option>
              <option value="NY">New York</option>
              <option value="NC">North Carolina</option>
              <option value="ND">North Dakota</option>
              <option value="OH">Ohio</option>
              <option value="OK">Oklahoma</option>
              <option value="OR">Oregon</option>
              <option value="PA">Pennsylvania</option>
              <option value="RI">Rhode Island</option>
              <option value="SC">South Carolina</option>
              <option value="SD">South Dakota</option>
              <option value="TN">Tennessee</option>
              <option value="TX">Texas</option>
              <option value="UT">Utah</option>
              <option value="VT">Vermont</option>
              <option value="VA">Virginia</option>
              <option value="WA">Washington</option>
              <option value="WV">West Virginia</option>
              <option value="WI">Wisconsin</option>
              <option value="WY">Wyoming</option>
            </select>';

  echo '    <label for="sZip">Zip </label>';
  echo '    <input type="text" required name="sZip" id="zip" pattern="\d*" title="Valid 6 digit zip code" minlength="6" maxlength="6"><br><br>';
  echo '  </div>';

/* representative info box */
  echo '  <div class="repBox">';
  echo '    <br>Representative Contact Information:<br><br>';
  echo '    <label for="fName">First Name </label>';
  echo '    <input type="text" required name="fName" id="fName" maxlength="25">';
  echo '    <label for="lName">Last Name </label>';
  echo '    <input type="text" required name="lName" id="lName" maxlength="25"><br><br>';

  echo '    <label for="areaCode">Phone ( </label>';
  echo '    <input type="text" required name="areaCode" id="areaCode" 
	      pattern="\d*" title="3 digit area code" oninput="autoTab(this, document.create.midDigits)" minlength="3" maxlength="3">';
  echo '    <label for="midDigitse"> )  </label>';
  echo '    <input type="text" required name="midDigits" id="midDigits" 
	      pattern="\d*" oninput="autoTab(this, document.create.endDigits)" title="3 digits" minlength="3" maxlength="3">';
  echo '    <label for="endDigits"> -  </label>';
  echo '    <input type="text" required name="endDigits" id="endDigits" pattern="\d*" title="4 digits" minlength="4" maxlength="4">';
  echo '    <label for="ext"> (optional) ext. </label>';
  echo '    <input type="text" name="ext" id="ext" pattern="\d*" title="Up to 4 digit extension" minlength="1" maxlength="4>';

  echo '    <label for="email">Email </label>';
  echo '    <input type="text" required name="email" id="email" maxlength="25"><br><br>';
  echo '  </div>';

/* comments box */
  echo '  <div class="commentBox">';
  echo '    <br>Comments (optional):<br><br>';
  echo '    <label for="comment"> </label>';
  echo '    <input type="text" name="comment" id="comment" maxlength="240"><br><br>';
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
      $state = $_POST['billState'];
      $zip = $_POST['zip'];
      /*******if box for bill = ship logic here */
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
  $section = "Part 1";
  include ("a4_footer.html");
?>
