<?php
  /**
  * Include the necessary php files
  */
  require_once ("conn.php");
  require_once ("item.php");
  require_once ("globalFunctions.php");

  $dropDownArray = array("test", "test2");

  // handles a post request to create an item when the submit button is clicked in item.html
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // if 'which' is '0', that means the user does not want to create the item
    if (isset($_POST['which']) && $_POST['which'] == '0') {
        //exit;
    }
    else {
        // otherwise, we create a new item and save it in the database
        $i = new item($conn);

        // set values
	$i->itemDesc = $_POST['itemDesc'];
	$i->uom = $_POST['uom'];
	$i->warehouseLoc = $_POST['warehouseLoc'];
	$i->qty = $_POST['qty'];
	$i->price = $_POST['price'];

        // now save it to the database
        if($i->updateDatabase()){
	  // on a successful insert, clear the post array
	  $_POST = array();
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