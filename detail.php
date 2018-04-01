<?php

require_once("globalFunctions.php");

class detail {
  $line_id = 0;
  $order_id = 0;
  $item_id = 0;
  $line_qty = 0;

  /*
  * Initialize class with connection string because it appears global variables
  * cannot be accessed within a class
  */
  function __construct($conn){
     $this->conn = $conn;
  }

  /*
  * inserts new item into database.
  * returns true if successful, false otherwise
  **/
  public function addToDatabase(){
     // data is validated as part of the html definition
     $insertSQL = 'insert into item ( order_id, item_id, line_qty)
	     		               values (?, ?, ?)';
 
     try {
       $stmt = $this->conn->prepare($insertSQL);
       $ok = $stmt->execute(array($this->order_id, $this->item_id, $this->line_qty);
       return true;
     }
     catch (PDOException $e) {
       $errorMessage = "Error, detail line could not be added\n".$e->getMessage();
       showAlert($errorMessage);
       return false;
     }
     catch (Exception $e){
       $errorMessage = "Error, detail could not be added\n".$e->getMessage();
       showAlert($errorMessage);
       return false;
     }
  }

  /*
  * Uses the parameter, which is either a line_id
  * and gets the values for it from the database.
  */
  public function setDetail($id){
    $this->line_id = $id;
    $selectSQL = "";
    // check if the input is numeric, which means it is an item_id
    $selectSQL = "select * from detail where line_id = ".$id;

    // attempt to run the query
    try{
      // there should only be one row
      foreach($this->conn->query($selectSQL) as $row){
    	$this->order_id = $row["order_id"];
    	$this->item_id = $row["item_id"];
    	$this->line_qty = $row["line_qty"];
      }
    }
    catch(PDOException $e){
      // show a message and make sure all values are set to defaults
      showAlert("Error! Could not read item from the database!".$e->getMessage());
      $this->order_id = $row["order_id"];
      $this->item_id = $row["item_id"];
      $this->line_qty = $row["line_qty"];
    }
  }

  /*
  * Updates an existing item in the database
  */
  public function updateDatabase(){
    // data is validated as part of the html definition
    $updateSQL = 'update detail set order_id=?, item_id=?, line_qty=? where line_id=?';

    // try executing the sql
    try{
      $stmt = $this->conn->prepare($updateSQL);

      $ok = $stmt->execute(array($this->order_id, $this->item_id, $this->line_qty, $this->line_id));
      return true;
    }
    catch (PDOException $e){
      $errorMessage = "Error, detail line could not be updated\n".$e->getMessage();
      showAlert($errorMessage);
      return false;
    }
    catch (Exception $e){
      showAlert("Error, detail line could not be updated\n".$e->getMessage());
      return false;
    }
  }
}

?>