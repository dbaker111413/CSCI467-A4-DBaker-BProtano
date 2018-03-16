<?php
  /*
  Author:     Bradley Protano
  Class:      466 Databases Section 1
  Instructor: Georgia Brown
  TA:         Koushik Gudla
  Semester:   Fall 2017
  Due:        11/20/2017

  This page enables the web page to connect to the mysql database
  of horses and their races.

  */

  $host = 'students';
  $user = 'z1790145';
  $password = '1996Apr23';
  $db = 'z1790145';
  $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);

  try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e) {
    echo 'ERROR: '.$e->getMessage();
  }
?>
