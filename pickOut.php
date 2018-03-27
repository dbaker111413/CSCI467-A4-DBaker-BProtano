<?php
  /**
  * Include the necessary php files
  */
  require_once ("conn.php");
  require_once ("item.php");
  require_once ("globalFunctions.php");

   echo "<pre>";
    print_r($_POST);
  echo "</pre>";
  // handles a post request to create an item when the submit button is clicked in item.html
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  echo '<h1>PICK REPORT:</h1>';

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
  //include ("html/header.html");
  //echo '<br>';
  //$section = "Part 2";
  //include ("html/footer.html");
?>
