<?php
  /**
  * Include the necessary php files
  */
  require_once ("conn.php");
  require_once ("customer.php");
  require_once ("globalFunctions.php");

  $custDropDownArray = generateSelectOptions("select name from customer", array("name"), $conn);
  $custNumDropDownArray = generateSelectOptions("select customer_id from customer", array("customer_id"), $conn);
					     
  $c = new customer($conn);


  // handles a post request to create an item when the submit button is clicked in customer.html
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // first, check if a customer has been selected
    if(isset($_POST['custSelected'])){
      if($_POST['custSelected'] == '1') {
        $c->setCustomer($_POST["selectCustomer"]);
      }
      else if($_POST['custSelected'] == '2') {
        $c->setCustomer($_POST["selectCustomerNum"]);
      }
    }

    // if 'which' is '0', that means the user does not want to create the customer
    if (isset($_POST['which']) && $_POST['which'] == '0') {
        //exit;
    }
    else {
        // otherwise, we create a new customer and save it in the database
        $c = new customer($conn);

        // set values
	$c->customerNumber = $_POST['selectCustomerNum'];
	$c->customerName = $_POST['selectCustomer'];
	$c->billAddress1 = $_POST['billAddress1'];
	$c->billAddress2 = $_POST['billAddress2'];
	$c->billCity = $_POST['billCity'];
	$c->billState = $_POST['billState'];
	$c->billZip = $_POST['billZip'];
	$c->shipAddress1 = $_POST['shipAddress1'];
	$c->shipAddress2 = $_POST['shipAddress2'];
	$c->shipCity = $_POST['shipCity'];
	$c->shipState = $_POST['shipState'];
	$c->shipZip = $_POST['shipZip'];
	$c->fname = $_POST['fname'];
	$c->lname = $_POST['lname'];
	$c->areaCode = $_POST['areaCode'];
	$c->midDigits = $_POST['midDigits'];
	$c->endDigits = $_POST['endDigits'];
	$c->ext = $_POST['ext'];
	$c->email = $_POST['email'];
	$c->comment = $_POST['comment'];

        // now save it to the database
        if($c->updateDatabase()){
	  // on a successful update, clear the post array
	  $_POST = array();
	  $c = new customer($conn);
	}
    }
  }

  // include any html files required for the layout
  $page_title = "Update Customer";
  include ("html/header.html");
  include ("html/update_customer.html");
  echo '<br>';
  $section = "Part 1";
  include ("html/footer.html");
?>
