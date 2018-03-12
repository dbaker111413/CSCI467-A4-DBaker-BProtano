<?php
  /*
  Author:     Bradley Protano
  Class:      466 Databases Section 1
  Instructor: Georgia Brown
  TA:         Koushik Gudla
  Semester:   Fall 2017
  Due:        11/27/2017

  Part I: This page allows the user to add a horse and their parents
  using a text box.

  tables:
  horse(horse_id, name, sire, dam)
  race(race_id,name,distance)   //m is miles, f is furlongs
  runsin(hid,rid,dt,tm,finish)  //hid is fk into horse, rid is fk into race

  */

  $page_title = "Add a Horse to the Database";
  include ("a4_header.html");
  require ("a4_conn.php");

  echo '<br>Enter the name of a horse you\'d like to add:<br><br>';
  echo '<form name="add", id="add" action="assn11_add_hrs.php" method="post">';
  echo '<label for="name">Horse Name </label>';
  echo '<input type="text" name="name" id="name"><br><br>';

  echo '<br>Along wth the names of the horse\'s parents:<br><br>';
  echo '<label for="sName">Sire Name </label>';
  echo '<input type="text" name="sName" id="sName"><br><br>';

  echo '<label for="dName">Dam Name </label>';
  echo '<input type="text" name="dName" id="dName"><br><br>';

  echo '<input type="submit" name="submit" id="submit" value="Add Horse">';
  echo '   ';
  echo '<input type="reset" name="reset" id="reset" value="Clear">';
  echo '<input type="hidden" name="which" id="which" value="add">';
  echo '<br><br>';
  echo '</form>';

  /**************************************************/
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['which'] == 'add') {
      $name = $_POST['name'];
      $sName = $_POST['sName'];
      $dName = $_POST['dName'];
      $insertSQL = 'insert into horse (name, sire, dam) values (?, ?, ?)';

      try {
        $stmt = $conn->prepare($insertSQL);
        $ok = $stmt->execute(array($name, $sName, $dName));
        echo ' Horse, '.$name.', added successfully!';
      }
      catch (PDOException $e) {
        echo 'Oops, horse could not be added.';
        echo 'Error: '.$e->getMessage();
      }
    }
  }
  
  echo '<br>';
  $section = "Part 1";
  include ("a4_footer.html");
?>
