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
  $itemDDDMenu = generateSelectOptions("select description from item", array("description"), $conn);

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
    global $lineCounter, $itemDropDownMenu, $itemDDDMenu;
    $deleteValue = '0';

    if(isset($_POST["hDelete".$lineCounter])){
      $deleteValue = $_POST["hDelete".$lineCounter];
    }
    showAlert("Line ".$lineCounter." delete value: ".$deleteValue);
    return "<div class='row".$lineCounter."'><tr>
	    <td><select id='itemdesc".$lineCounter."' name='itemdesc".$lineCounter."' onchange='itemDescSelected(".$lineCounter.")'><option>-- Select by Item Description --</option>".$itemDDDMenu."</select></td>
            <td><select id='itemnum".$lineCounter."' name='itemnum".$lineCounter."' onchange='itemNumSelected(".$lineCounter.")'><option>-- Select by Item Number --</option>".$itemDropDownMenu."</select></td>
	    <td><label id='price".$lineCounter."' name='price".$lineCounter."'>$0.00</label></td>
	    <td><input type='text' id='qty".$lineCounter."' name='qty".$lineCounter."'></td>
	    <td><label id='uom".$lineCounter."' name='uom".$lineCounter."'>--</label></td>
            <td><input type='date' id='date".$lineCounter."' name='date".$lineCounter."'></input></td>
	    <td><label id='total".$lineCounter."' name='total".$lineCounter."'>$0.00</label></td>
	    <td><button type='button' id='delete".$lineCounter."' name='delete".$lineCounter."' onclick='delete_line(".$lineCounter.")'>DELETE</button>
                <input type='hidden' name='hDelete".$lineCounter."' id='hDelete".$lineCounter."' value='".$deleteValue."'></td>
          <input type='hidden' name='itemSelected".$lineCounter."' id='itemSelected".$lineCounter."' value='0'>
	  </tr></div>";
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $htmlDetailLines = generateDetailLines();

    

    if(isset($_POST["add"]) && $_POST["add"] == "1"){
      $htmlDetailLines .= generateSingleDetailLine();
      $lineCounter++;
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
