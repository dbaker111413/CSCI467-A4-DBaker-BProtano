<?php
  /**
  * Include the necessary php files
  */
  require_once ("conn.php");
  require_once ("globalFunctions.php");


  $orderNum = "1";
  

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
/*   echo "<pre>";
    print_r($_POST);
  echo "</pre>";
  // handles a post request to create an item when the submit button is clicked in item.html
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    // if 'which' is '0', that means the user does not want to create the item
    if (isset($_POST['test'])) {

        $tester = $_post['test'];
        echo $tester; 
        //exit;
    }
    else {
        // set values
        //$rowIds = $_POST['rowIds'];
        //echo $rowIds;
        //$rowIds = (explode(',', $eventDate, 2));
    }
  }
 

  /*  $sqlRace = "select name from race where distance = '$dist' order by name";

    echo '<table border="2"><br>';
    echo '<tr><td align="center">'; //column headers for table
    echo 'Race name';
    echo '</td></tr>';

    foreach ($conn->query($sqlRace) as $row) {
      echo '<tr><td>';
      echo $row['name'];
      echo '</td></tr>';
    }
    echo '</table>';
  }*/

  // include any html files required for the layout
  $page_title = "Generate Pick Report";
  include ("html/pickOut.html");
  //echo '<br>';
  //$section = "Part 2";
  //include ("html/footer.html");
?>
