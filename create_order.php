<?php
  /**
  * Include the necessary php files
  */
  require_once ("conn.php");
  require_once ("order.php");
  require_once ("globalFunctions.php");
  require_once ("item.php");

  // keeps track of how many lines there are
  $lineCounter = 0;
  $htmlDetailLines = "";
  $items = array();

  // drop down menu for item numbers
  $itemDropDownMenu = generateSelectOptions("select item_id from item", array("item_id"), $conn);
  $itemDDDMenu = generateSelectOptions("select description from item", array("description"), $conn);

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

    return "<div class='row".$lineCounter."'><tr>
	    <td><select id='itemdesc".$lineCounter."' name='itemdesc".$lineCounter."' onchange='itemDescSelected(".$lineCounter.")'>
                ".$itemDesc."<option>-- Select by Item Description --</option>".$itemDDDMenu."</select></td>
            <td><select id='itemnum".$lineCounter."' name='itemnum".$lineCounter."' onchange='itemNumSelected(".$lineCounter.")'>
                ".$itemNum."<option>-- Select by Item Number --</option>".$itemDropDownMenu."</select></td>
	    <td><label id='price".$lineCounter."' name='price".$lineCounter."'>$".$price."</label></td>
	    <td><input type='text' id='qty".$lineCounter."' name='qty".$lineCounter."' value='".$qty."' onfocusout='update_total(".$lineCounter.")'></td>
	    <td><label id='uom".$lineCounter."' name='uom".$lineCounter."'>".$uom."</label></td>
            <td><input type='date' id='date".$lineCounter."' name='date".$lineCounter."' value=".$date."></input></td>
	    <td><label id='total".$lineCounter."' name='total".$lineCounter."'>$".$total."</label></td>
	    <td><button type='button' id='delete".$lineCounter."' name='delete".$lineCounter."' onclick='delete_line(".$lineCounter.")'>DELETE</button>
                <input type='hidden' name='hDelete".$lineCounter."' id='hDelete".$lineCounter."' value='".$deleteValue."'></td>
          <input type='hidden' name='itemSelected".$lineCounter."' id='itemSelected".$lineCounter."' value='0'>
	  </tr></div>";
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $htmlDetailLines = generateDetailLines();

    

    if(isset($_POST["add"]) && $_POST["add"] == "1"){
      $htmlDetailLines .= generateSingleDetailLine(new item($conn));
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
