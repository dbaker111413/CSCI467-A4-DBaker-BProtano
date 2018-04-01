<?php
  /**
  * Include the necessary php files
  */
  require_once ("conn.php");
  require_once ("globalFunctions.php");

  $rowIds = "";
  $orderNum = "";
  $pickStaff = "";

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rowIds = $_POST["rowIds"];
    $pickStaff =  $_POST["pickStaff"];

    //grab selected ids with garbage
    $rowArray =  explode(",", $rowIds);

    //remove garbage
    $rowArray = array_slice ( $rowArray, 0, -108 );
    $rowArray = array_slice ( $rowArray, 1 );

    //grab every 6th item from the array (which are now the IDs)
    $idArray = array();
    $i = 0;
    foreach ($rowArray as $value){
      if ( $i++ % 6 == 0 ) {
        $idArray[] = str_replace( "PB-AIP-", "", $value);
      }
    }

    $orderNum = $idArray[0];
  } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $orderNum =  $_GET["id"];
    $pickStaff =  $_GET["pickStaff"];
  }


  $sql = $conn->query(
    "select o.order_id, o.order_date, c.name, c.customer_id, c.ship_address_line1, c.ship_address_line2, c.ship_city, 
    c.ship_state, c.ship_zip, o.order_expected_date, o.order_lines, i.location, d.line_qty, i.item_id, i.description, d.line_id 
    from order_header o, customer c, detail d, item i
    where c.customer_id = o.customer_id and d.order_id = o.order_id and i.item_id = d.item_id and o.order_id = ".$orderNum."
    group by d.line_id 
    order by o.order_expected_date");

  $sqlHead = $conn->query(
    "select o.order_id, o.order_date, c.name, c.customer_id, c.ship_address_line1, c.ship_address_line2, c.ship_city, 
    c.ship_state, c.ship_zip, o.order_expected_date, o.order_lines
    from order_header o, customer c
    where c.customer_id = o.customer_id and o.order_id = ".$orderNum."
    group by o.order_id 
    order by o.order_expected_date");

  while($head = $sqlHead->fetch(PDO::FETCH_ASSOC)) {
    $orderDate = $head['order_date'];
    $custName = $head['name'];
    $add1 = $head['ship_address_line1'];
    $add2 = $head['ship_address_line2'];
    $city = $head['ship_city'];
    $state = $head['ship_state'];
    $zip = $head['ship_zip'];
    $expectedDate = $head['order_expected_date'];
    $lineCount = $head['order_lines'];
  }



  // include any html files required for the layout
  $page_title = "Generate Pick Report";
  include ("html/pickOut.html");
  //echo '<br>';
  $section = "Part 2";
  //include ("html/footerReport.html");
?>
