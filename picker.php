<?php
  /**
  * Include the necessary php files
  */
  require_once ("conn.php");
  require_once ("item.php");
  require_once ("globalFunctions.php");

  // include any html files required for the layout
  $page_title = "Generate Pick Report";
  include ("html/header.html");
  include ("html/picker.html");
  echo '<br>';
  $section = "Part 2";
  include ("html/footer.html");
?>
