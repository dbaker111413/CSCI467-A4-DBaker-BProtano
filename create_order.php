<?php
  /**
  * Include the necessary php files
  */
  require_once ("conn.php");
  require_once ("order.php");
  require_once ("globalFunctions.php");

  // handles a post request to create an item when the submit button is clicked in customer.html
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // if 'which' is '0', that means the user does not want to create the customer
    if (isset($_POST['which']) && $_POST['which'] == '0') {
        //exit;
    }
    else {
        // otherwise, we create a new customer and save it in the database
        $i = new customer($conn);

        // set values
	$i->customerName = $_POST['customerName'];
	$i->billAddress1 = $_POST['billAddress1'];
	$i->billAddress2 = $_POST['billAddress2'];
	$i->billCity = $_POST['billCity'];
	$i->billState = $_POST['billState'];
	$i->billZip = $_POST['billZip'];
	$i->shipAddress1 = $_POST['shipAddress1'];
	$i->shipAddress2 = $_POST['shipAddress2'];
	$i->shipCity = $_POST['shipCity'];
	$i->shipState = $_POST['shipState'];
	$i->fname = $_POST['fname'];
	$i->lname = $_POST['lname'];
	$i->areaCode = $_POST['areaCode'];
	$i->midDigits = $_POST['midDigits'];
	$i->endDigits = $_POST['endDigits'];
	$i->ext = $_POST['ext'];
	$i->email = $_POST['email'];
	$i->comment = $_POST['comment'];

        // now save it to the database
        if($i->addToDatabase()){
	  // on a successful insert, clear the post array
	  $_POST = array();
	}
    }
  }

  // include any html files required for the layout
  $page_title = "Create Customer Order";
  include ("html/header.html");
  include ("html/create_order.html");
  echo '<br>';
  $section = "Part 1";
  include ("html/footer.html");
?>
