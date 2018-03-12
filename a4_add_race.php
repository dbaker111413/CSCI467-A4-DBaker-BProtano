<?php
  /*
  Author:     Bradley Protano
  Class:      466 Databases Section 1
  Instructor: Georgia Brown
  TA:         Koushik Gudla
  Semester:   Fall 2017
  Due:        11/27/2017

  Part II: This page allows the user to add a new horse race
  using a text box.

  tables:
  horse(horse_id, name, sire, dam)
  race(race_id,name,distance)   //m is miles, f is furlongs
  runsin(hid,rid,dt,tm,finish)  //hid is fk into horse, rid is fk into race

  */

  $page_title = "Add a Horse Race to the Database";
  include ("a4_header.html");
  require ("a4_conn.php");

  echo '<br>Enter the name of a horse race you\'d like to add:<br><br>';
  echo '<form name="add", id="add" action="assn11_add_race.php" method="post">';
  echo '<label for="name">Race Name </label>';
  echo '<input type="text" name="name" id="name"><br><br>';

  echo '<br>Along wth the distance of the race:<br><br>';
  echo '<label for="dist">Distance (in miles or furlongs) </label>';
  echo '<input type="text" name="dist" id="dist"><br><br>';

  echo '<input type="submit" name="submit" id="submit" value="Add Race">';
  echo '   ';
  echo '<input type="reset" name="reset" id="reset" value="Clear">';
  echo '<input type="hidden" name="which" id="which" value="add">';
  echo '<br><br>';
  echo '</form>';

  /**************************************************/
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['which'] == 'add') {
      $name = $_POST['name'];
      $dist = $_POST['dist'];
      $insertSQL = 'insert into race (name, distance) values (?, ?)';

      try {
        $stmt = $conn->prepare($insertSQL);
        $ok = $stmt->execute(array($name, $dist));
        echo ' Race, '.$name.', added successfully!';
      }
      catch (PDOException $e) {
        echo 'Oops, race could not be added.';
        echo 'Error: '.$e->getMessage();
      }
    }
  }
  
  echo '<br>';
  $section = "Part 2";
  include ("a4_footer.html");
?>
