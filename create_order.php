<?php
  /**
  * Include the necessary php files
  */
  require_once ("conn.php");
  require_once ("order.php");
  require_once ("globalFunctions.php");



  // include any html files required for the layout
  $page_title = "Create Customer Order";
  include ("html/header.html");
  include ("html/create_order.html");
  echo '<br>';
  $section = "Part 1";
  include ("html/footer.html");
?>
