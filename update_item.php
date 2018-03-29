<?php
  /**
  * Include the necessary php files
  */
  require_once ("conn.php");
  require_once ("item.php");
  require_once ("globalFunctions.php");

  $descDropDownArray = generateSelectOptions("select description from item",
                                          array("description"), $conn);
  $numDropDownArray = generateSelectOptions("select item_id from item",
                                          array("item_id"), $conn);
  $vendorDropDownArray = generateSelectOptions("select name from vendor",
                                          array("name"), $conn);
					  
  $i = new item($conn);
  $vendorName = "";
  // handles a post request to create an item when the submit button is clicked in item.html
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    // first, check if an item has been selected
    if(isset($_POST['selectItem'])) {
      if($_POST['selectItem'] == '1'){
        $i->setItem($_POST["itemDesc"]);
        $vendorName = $i->getVendorName();
      }
      if($_POST['selectItem'] == '2'){
        $i->setItem($_POST["itemNum"]);
        $vendorName = $i->getVendorName();	
      }
    }

    // if 'which' is '0', that means the user does not want to create the item
    if (isset($_POST['which']) && $_POST['which'] == '0') {
        //exit;
    }
    else {
        // otherwise, we update the item and save it in the database

        // set values
	$i->itemNumber = $_POST['itemNum'];
	$i->itemDesc = $_POST['itemDesc'];
	$i->uom = $_POST['uom'];
	$i->warehouseLoc = $_POST['warehouseLoc'];
	$i->qty = $_POST['qty'];
	$i->price = $_POST['price'];
	$vendorName = $_POST['vendorName'];	
	$i->setVendor($vendorName);

        // now save it to the database
        if($i->updateDatabase()){
	  // on a successful insert, clear the post array
	  $_POST = array();
	  $i = new item($conn);
	}
    }
  }

  // include any html files required for the layout
  $page_title = "Update Item";
  include ("html/header.html");
  include ("html/update_item.html");
  echo '<br>';
  $section = "Part 2";
  include ("html/footer.html");
?>