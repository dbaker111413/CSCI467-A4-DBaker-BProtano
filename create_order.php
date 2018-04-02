<?php
  /**
  * Include the necessary php files
  */
  require_once ("conn.php");
  require_once ("order.php");
  require_once ("globalFunctions.php");
  require_once ("item.php");
  require_once ("customer.php");
  require_once ("detail.php");
  // keeps track of how many lines there are
  $lineCounter = 0;
  $htmlDetailLines = "";
  $items = array();

  // drop down menu for item numbers
  $itemDropDownMenu = generateSelectOptions("select item_id from item", array("item_id"), $conn);
  $itemDDDMenu = generateSelectOptions("select description from item", array("description"), $conn);

  $custDropDownArray = generateSelectOptions("select name from customer", array("name"), $conn);
  $custNumDropDownArray = generateSelectOptions("select customer_id from customer", array("customer_id"), $conn);
  $c = new customer($conn);

  // generates and returns an html string for the line item table
  // it performs this by checking if itemnum[X] isset, if so then
  // that line exists; so an html line is appended to the string
  function generateDetailLines(){
    global $lineCounter, $conn, $items;
    $outputLine = "";
    
    while(isset($_POST["itemnum".$lineCounter])){
      // create an item
      $i = new item($conn);

      // set based on itemSelected post value 
      if($_POST["itemSelected".$lineCounter] == "1"){
        $i->setItem($_POST["itemdesc".$lineCounter]);
      }
      else {
        $i->setItem($_POST["itemnum".$lineCounter]);
      }
      
      array_push($items, $i);
      $outputLine .= generateSingleDetailLine($i);
      $lineCounter++;
    }
    return $outputLine;	
  }

  // generates a single html detail line
  function generateSingleDetailLine($i){
    global $lineCounter, $itemDropDownMenu, $itemDDDMenu;
    $deleteValue = '0';

    if(isset($_POST["hDelete".$lineCounter])){
      $deleteValue = $_POST["hDelete".$lineCounter];
    }

    $itemDesc = $i->itemDesc != "" ? "<option>".$i->itemDesc."</option>" : "";
    $itemNum = $i->itemNumber != "" ? "<option>".$i->itemNumber."</option>" : "";
    $uom = $i->uom != "" ? $i->uom : "--";
    $price = $i->price != "" ? $i->price : 0.00;
    $qty = isset($_POST["qty".$lineCounter]) ? $_POST["qty".$lineCounter] : 0;
    $total = $price * $qty;
    $date = isset($_POST["date".$lineCounter]) && $_POST["date".$lineCounter] != "mm/dd/yyyy" ? $_POST["date".$lineCounter] : date("Y-m-d"); 

    $delCheck = isset($_POST["hDelete".$lineCounter]) && $_POST["hDelete".$lineCounter] != 0 ? $_POST["hDelete".$lineCounter] : 0; 
    if ($delCheck == 0) {
    return "<tr class='row".$lineCounter."' name='row".$lineCounter."' id='row".$lineCounter."'>
	    <td><select id='itemdesc".$lineCounter."' name='itemdesc".$lineCounter."' onchange='itemDescSelected(".$lineCounter.")'> 
                ".$itemDesc."<option>-- Search by Item Description --</option>".$itemDDDMenu."</select></td>
            <td><select id='itemnum".$lineCounter."' name='itemnum".$lineCounter."' onchange='itemNumSelected(".$lineCounter.")'>
                ".$itemNum."<option>-- Search by Item Number --</option>".$itemDropDownMenu."</select></td>
	    <td><label id='price".$lineCounter."' name='price".$lineCounter."'>$".$price."</label></td>
	    <td><input type='number' id='qty".$lineCounter."' name='qty".$lineCounter."' value='".$qty."' onfocusout='update_total(".$lineCounter.")' step='1' min='0'></td>
	    <td><label id='uom".$lineCounter."' name='uom".$lineCounter."'>".$uom."</label></td>
	    <td><label id='total".$lineCounter."' name='total".$lineCounter."'>$".$total."</label></td>
	    <td><button type='button' id='delete".$lineCounter."' name='delete".$lineCounter."' onclick='delete_line(".$lineCounter.")'>DELETE</button>
                <input type='hidden' name='hDelete".$lineCounter."' id='hDelete".$lineCounter."' value='".$deleteValue."'></td> 
          <input type='hidden' name='itemSelected".$lineCounter."' id='itemSelected".$lineCounter."' value='0'>
	  </tr>";
    } else {
    return "<tr class='row".$lineCounter." deleted' name='row".$lineCounter."' id='row".$lineCounter."'>
	    <td><select id='itemdesc".$lineCounter."' name='itemdesc".$lineCounter."' onchange='itemDescSelected(".$lineCounter.")'>
                ".$itemDesc."<option>-- Select by Item Description --</option>".$itemDDDMenu."</select></td>
            <td><select id='itemnum".$lineCounter."' name='itemnum".$lineCounter."' onchange='itemNumSelected(".$lineCounter.")'>
                ".$itemNum."<option>-- Select by Item Number --</option>".$itemDropDownMenu."</select></td>
	    <td><label id='price".$lineCounter."' name='price".$lineCounter."'>$".$price."</label></td>
	    <td><input type='number' id='qty".$lineCounter."' name='qty".$lineCounter."' value='".$qty."' onfocusout='update_total(".$lineCounter.")'></td>
	    <td><label id='uom".$lineCounter."' name='uom".$lineCounter."'>".$uom."</label></td>
	    <td><label id='total".$lineCounter."' name='total".$lineCounter."'>$".$total."</label></td>
	    <td><button type='button' id='delete".$lineCounter."' name='delete".$lineCounter."' onclick='delete_line(".$lineCounter.")'>DELETE</button>
                <input type='hidden' name='hDelete".$lineCounter."' id='hDelete".$lineCounter."' value='".$deleteValue."'></td> 
          <input type='hidden' name='itemSelected".$lineCounter."' id='itemSelected".$lineCounter."' value='0'>
	  </tr>";

    }
  }

  /*    <input type='hidden' name='hDelete".$lineCounter."' id='hDelete".$lineCounter."' value='".$deleteValue."'></td> */
  if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // first, check if a customer has been selected
    if(isset($_POST['custSelected'])){
      if($_POST['custSelected'] == '1') {
        $c->setCustomer($_POST["selectCustomer"]);
      }
      else if($_POST['custSelected'] == '2') {
        $c->setCustomer($_POST["selectCustomerNum"]);
      }
      else if(isset($_POST['selectCustomerNum']) && $_POST['selectCustomerNum'] != "-- Search by Customer Number --"){
        $c->setCustomer($_POST["selectCustomerNum"]);
      }
    }

    $htmlDetailLines = generateDetailLines();

    if(isset($_POST["add"]) && $_POST["add"] == "1"){
      $htmlDetailLines .= generateSingleDetailLine(new item($conn));
      $lineCounter++;
    }

    // save the order and detail lines in the database when the user submits
    if(isset($_POST["which"]) && $_POST["which"] == "1"){
      // first, create and save the order header. We need to order ID before we can save the detail lines
      $order = new order($conn);
      $order->date = date("Y-m-d H:i:s");
      $order->status = "Created";  // required by business rule
      $order->expectedDate = $_POST['expectedDate'];
      $order->customerNum = $_POST['selectCustomerNum'];

      $details = array();
      // next create each detail line
      for($i = 0; $i < count($items); $i++){
        if(isset($_POST["hDelete".$i]) && $_POST["hDelete".$i] != "0"){
          continue;
        }
        $detail = new detail($conn);
	$detail->item_id = $items[$i]->itemNumber;
	$detail->line_qty = $_POST["qty".$i];
	array_push($details, $detail);
      }
      // now save the order with all the detail lines
      if($order->addToDatabase($details)){
        // empty the item array, the post array, and clear the detail lines
        $items = array();
	$_POST = array();
	$lineCounter = 0;
	$htmlDetailLines = "";
	$c = new customer($conn);
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
