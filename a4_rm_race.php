<?php
  /*
  Author:     Bradley Protano
  Class:      466 Databases Section 1
  Instructor: Georgia Brown
  TA:         Koushik Gudla
  Semester:   Fall 2017
  Due:        11/27/2017

  Part III: This page allows the user to select a race and view remove it
  using a drop down box.

  tables:
  horse(horse_id, name, sire, dam)
  race(race_id,name,distance)   //m is miles, f is furlongs
  runsin(hid,rid,dt,tm,finish)  //hid is fk into horse, rid is fk into race
  */

  $page_title = "Remove a Horse Race from the Database";
  include ("a4_header.html");
  require ("a4_conn.php");

  echo '<br>Select a race to remove from the database:<br><br>';
  $sql = 'select race_id, name, distance from race order by name';

  echo '<form action="a4_rm_race.php" method="post">';
  echo '<select name="id">';
  foreach ($conn->query($sql) as $row) {
    echo '<option value="';
    echo $row["race_id"];
    echo '">';
    echo $row["name"].', '.$row["distance"]; 
    echo '</option>';
  }
  echo '</select>';
  echo '<br><br>';
  echo '<input type="submit" name="submit" id="submit" value="Remove Race">';
  echo '</form>';
  /**********************************/
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
   
    $delSQL = "delete from race where race_id=?";

    try {
      $stmt = $conn->prepare($delSQL);
      $ok = $stmt->execute(array($id));
      echo ' Race '.$id.' deleted successfully!';
    }
    catch (PDOException $e) {
      echo 'Oops, race could not be deleted.';
      echo 'Error: '.$e->getMessage();
    }
  }  

  echo '<br>';
  $section = "Part 3";
  include ("a4_footer.html");
?>
