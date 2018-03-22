<?php

// shows an alert to the user using client-side javascript
function showAlert($message){
  echo "<script type='text/javascript'>alert('$message');</script>";
}

/*
 * Uses the SQL Query to generate a string of options for a 'Select' view
 * Requires a completed query string, an array of strings which are the 
 * column names that can access the elements, and a connection
 */
function generateSelectOptions($queryString, $columnNames, $conn){
  $optionString = ""; // initialize options string

  try{
    /*
    * Iterate through each row and create an 'option' for each column in that row
    */
    foreach($conn->query($queryString) as $row){
      foreach($columnNames as $columnName){
        $optionString .= "<option>".$row[$columnName]."</option>";
      }
    }
  }
  catch(PDOException $e){
    $errorMessage = "Error, could not read ".$columnName." list".$e->getMessage();
    showAlert($errorMessage);
    return "";
  }
  return $optionString;
}
?>