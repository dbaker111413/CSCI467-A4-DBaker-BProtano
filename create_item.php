<?php
  /**
  * Include the necessary php files
  */
  require_once ("conn.php");
  require_once ("item.php");
  require_once ("globalFunctions.php");


  $dropDownArray = generateSelectOptions("select name from vendor",
                                          array("name"), $conn);

  $i = new item($conn);
  // handles a post request to create an item when the submit button is clicked in item.html
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // if 'which' is '0', that means the user does not want to create the item
    if (isset($_POST['which']) && $_POST['which'] == '0') {
        //exit;
    }
    else {
        // otherwise, we create a new item and save it in the database
        // set values
	$i->itemDesc = $_POST['itemDesc'];
	$i->uom = $_POST['uom'];
	$i->warehouseLoc = $_POST['warehouseLoc'];
	$i->qty = $_POST['qty'];
	$i->price = $_POST['price'];
	$i->setVendor($_POST['vendor']);

        // now save it to the database
        if($i->addToDatabase()){
	  // on a successful insert, clear the post array
	  $_POST = array();

          // remove vendor ID from current item object or it will show up in the form
	  $i->vendor = 0;
	}
    }
  }

  // include any html files required for the layout
  $page_title = "Create Item";
  include ("html/header.html");
  include ("html/create_item.html");
  echo '<br>';
  $section = "Part 1";
  include ("html/footer.html");
?>
