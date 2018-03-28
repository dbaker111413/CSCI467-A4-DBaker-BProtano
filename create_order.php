<?php
  /**
  * Include the necessary php files
  */
  require_once ("conn.php");
  require_once ("order.php");
  require_once ("globalFunctions.php");

  // keeps track of how many lines there are
  $lineCounter = 0;
  $htmlDetailLines = "";

  // drop down menu for item numbers
  $itemDropDownMenu = generateSelectOptions("select item_id from item", array("item_id"), $conn);

  // generates and returns an html string for the line item table
  // it performs this by checking if itemnum[X] isset, if so then
  // that line exists; so an html line is appended to the string
  function generateDetailLines(){
    global $lineCounter;
    $outputLine = "";

    while(isset($_POST["itemnum".$lineCounter])){
      $outputLine .= generateSingleDetailLine();
      $lineCounter++;
    }
    return $outputLine;	
  }

  // generates a single html detail line
  function generateSingleDetailLine(){
    global $lineCounter, $itemDropDownMenu;
    return '<tr>
	    <td><select id="itemnum"'.$lineCounter.' name="itemnum"'.$lineCounter.'><option>-- Select Item --</option>'.$itemDropDownMenu.'</select></td>
	    <td><label id="price"'.$lineCounter.' name="price"'.$lineCounter.'>$0.00</label></td>
	    <td><label id="qty"'.$lineCounter.' name="qty"'.$lineCounter.'>0</label></td>
	    <td><label id="uom"'.$lineCounter.' name="uom"'.$lineCounter.'>--</label></td>
	    <td><label id="total"'.$lineCounter.' name="total"'.$lineCounter.'>$0.00</label></td>
	    <td><button id="delete"'.$lineCounter.' name="delete"'.$lineCounter.' onclick="delete_line()" value="0">DELETE</button></td>
	  </tr>';
  }


  if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $htmlDetailLines = generateDetailLines();

    // TEMP
    $htmlDetailLines .= generateSingleDetailLine();
    $lineCounter++;

    if(isset($_POST['itemnum0'])){
      showAlert($_POST['itemnum0']);
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
