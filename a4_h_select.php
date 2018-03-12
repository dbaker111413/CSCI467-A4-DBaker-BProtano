<?php
  /*
  Author:     Bradley Protano
  Class:      466 Databases Section 1
  Instructor: Georgia Brown
  TA:         Koushik Gudla
  Semester:   Fall 2017
  Due:        11/20/2017

  */

  $page_title = "Races by Horse";
  include ("a4_header.html");
  require ("a4_conn.php");

  echo '<br>Select a horse to display their race history:<br><br>';
  $sql = 'select horse_id, name from horse';

  echo '<form action="a4_h_select.php" method="post">';
  echo '<select name="hrs">';
  foreach ($conn->query($sql) as $row) {
    echo '<option value="';
    echo $row["horse_id"];
    echo '">';
    echo $row["name"]; 
    echo '</option>';
  }
  echo '</select>';
  echo '<br><br>';
  echo '<input type="submit" name="submit" id="submit" value="Show Races">';
  echo '</form>';
  /**********************************/
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $horseId = $_POST['hrs'];
   
    $sqlHorse = "select r.name, finish, tm from horse h, race r, runsin i 
                  where horse_id = $horseId and horse_id = hid 
                 and rid = race_id order by r.name";

    echo '<table border="2"><br>';
    echo '<tr><td align="center">'; //column headers for table
    echo 'Race name';
    echo '</td><td align="center"> ';
    echo 'Finish position';
    echo '</td><td align="center"> ';
    echo 'Race time';
    echo '</td></tr>';

    foreach ($conn->query($sqlHorse) as $row) {
      echo '<tr><td>';
      echo $row['name'];
      echo '</td><td align="right"> ';
      echo $row['finish'];
      echo '</td><td align="right"> ';
      echo $row['tm'];
      echo '</td></tr>';
    }
    echo '</table>';
  }

  echo '<br>';
  $section = "Part 0";
  include ("a4_footer.html");
?>
