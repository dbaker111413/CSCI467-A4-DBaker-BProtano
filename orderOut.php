<?php
  /**
  * Include the necessary php files
  */
  require_once ("conn.php");
  require_once ("globalFunctions.php");

  $orderNum = "1";

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $orderNum =  $_GET["id"];
  }

  $sql = $conn->query(
    "select o.order_id, o.order_date, c.name, c.customer_id, c.ship_address_line1, c.ship_address_line2, c.ship_city, 
    c.ship_state, c.ship_zip, o.order_expected_date, o.order_lines, i.location, d.line_qty, i.item_id, i.description, d.line_id 
    from order_header o, customer c, detail d, item i
    where c.customer_id = o.customer_id and d.order_id = o.order_id and i.item_id = d.item_id and o.order_id = ".$orderNum."
    group by d.line_id 
    order by o.order_expected_date");

  $sqlHead = $conn->query(
    "select o.order_id, o.order_date, c.name, c.customer_id, c.address_line1, c.address_line2, c.city, 
    c.ship_address_line1, c.ship_address_line2, c.ship_city, c.state, c.zip, c.ship_state, c.ship_zip, 
    o.order_expected_date, o.order_lines
    from order_header o, customer c
    where c.customer_id = o.customer_id and o.order_id = ".$orderNum."
    group by o.order_id 
    order by o.order_expected_date");

  while($head = $sqlHead->fetch(PDO::FETCH_ASSOC)) {
    $orderDate = $head['order_date'];
    $custName = $head['name'];
    $add1 = $head['address_line1'];
    $add2 = $head['address_line2'];
    $city = $head['city'];
    $state = $head['state'];
    $zip = $head['zip'];
    $add1s = $head['ship_address_line1'];
    $add2s = $head['ship_address_line2'];
    $citys = $head['ship_city'];
    $states = $head['ship_state'];
    $zips = $head['ship_zip'];
    $expectedDate = $head['order_expected_date'];
    $lineCount = $head['order_lines'];
  }
/*
  $i = 0;
  $index = 0;

  foreach($idArray as $value){
    $i++;
    echo '<a href="pick-index.php?id=';
    echo $value;
    echo '&pickStaff=';
    echo $pickStaff;
    echo '&rowIds=';
    echo $rowIds;
    echo '">';
    echo $i;
    echo '</a>';
  }

 */


  // include any html files required for the layout
  $page_title = "Select Pick Report";
  include ("html/orderOut.html");
  //echo '<br>';
  $section = "Part 2";
?>
