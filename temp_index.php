<?php
  /*
  Author:     Bradley Protano
  Class:      466 Databases Section 1
  Instructor: Georgia Brown
  TA:         Koushik Gudla
  Semester:   Fall 2017
  Due:        11/20/2017

  tables:
  horse(horse_id, name, sire, dam)
  race(race_id,name,distance)   //m is miles, f is furlongs
  runsin(hid,rid,dt,tm,finish)  //hid is fk into horse, rid is fk into race

  Assn10 index: Index provides info on horses and races in two forms.
  */

  $page_title = "Horse Racing Information";
  include ("html/header.html");
  require ("conn.php");

  echo "<br>Horses and their lineage:<br>";
  $stmt = $conn->query('select name, sire, dam from horse');

  echo '<table border="2"><br>';
 
  echo '<tr><td align="center"> '; //column headers for table
  echo 'Name';
  echo '</td><td align="center"> ';
  echo 'Sire';
  echo '</td><td align="center"> ';
  echo 'Dam';
  echo '</td></tr>';

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr><td>';
    echo $row['name'];
    echo '</td><td> ';
    echo $row['sire'];
    echo '</td><td> ';
    echo $row['dam'];
    echo '</td></tr>';
  }
  echo '</table>';

  echo "<br>Horse races and their distances:<br>";
  $stmt = $conn->query('select name, distance from race');

  echo '<table border="2"><br>';

  echo '<tr><td align="center">'; //column headers for table
  echo 'Name';
  echo '</td><td align="center"> ';
  echo 'Distance';
  echo '</td></tr>';

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr><td>';
    echo $row['name'];
    echo '</td><td> ';
    echo $row['distance'];
    echo '</td></tr>';
  }
  echo '</table>';

  echo '<br>';
  $section = "Part 0";
  include ("html/footer.html");
?>
