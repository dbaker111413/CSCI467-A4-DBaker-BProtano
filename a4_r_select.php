<?php
  /*
  Author:     Bradley Protano
  Class:      466 Databases Section 1
  Instructor: Georgia Brown
  TA:         Koushik Gudla
  Semester:   Fall 2017
  Due:        11/20/2017

  */

  $page_title = "Races by Distance";
  include ("a4_header.html");
  require ("a4_conn.php");

  echo '<br>Select a horse to display their history:<br><br>';
  $sql = 'select distinct distance from race order by distance';

  echo '<form action="a4_r_select.php" method="post">';
  echo '<select name="dist">';
  foreach ($conn->query($sql) as $row) {
    echo '<option value="';
    echo $row["distance"];
    echo '">';
    echo $row["distance"]; 
    echo '</option>';
  }
  echo '</select>';
  echo '<br><br>';
  echo '<input type="submit" name="submit" id="submit" value="Show Races">';
  echo '</form>';
  /**********************************/
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dist = $_POST['dist'];
   
    $sqlRace = "select name from race where distance = '$dist' order by name";

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
  }

  echo '<br>';
  $section = "Part 0";
  include ("a4_footer.html");
?>
