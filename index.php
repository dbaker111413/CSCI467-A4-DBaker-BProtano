<?php
  /**
  * Include the necessary php files
  */
  require_once ("conn.php");
  require_once ("customer.php");
  require_once ("globalFunctions.php");

 
  // include any html files required for the layout
  $page_title = "AIP Home";
  include ("html/header.html");
  include ("html/index.html");
  echo '<br>';
  $section = "Part 1";
  include ("html/footer.html");
?>
