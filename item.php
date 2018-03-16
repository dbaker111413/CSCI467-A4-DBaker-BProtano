<?php

// include necessary php files
require_once("a4_conn.php");
require_once("globalFunctions.php");

class item {
  public $itemNumber = 0;
  public $itemDesc = "";
  public $uom = "";
  public $warehouseLoc = "";
  public $qty = "";
  public $price = "";
  public $conn;

  /*
  * Initialize class with connection string because it appears global variables
  * cannot be accessed within a class
  */
  function __construct($conn){
     $this->conn = $conn;
  }

  /*
  * inserts new item into database.
  * returns true if successful, false otherwisex
  **/
  public function addToDatabase(){
     // data is validated as part of the html definition
     $insertSQL = 'insert into item ( description, uom, location, on_hand, price)
	     		               values (?, ?, ?, ?, ?)';
 
     try {
       $stmt = $this->conn->prepare($insertSQL);
       $ok = $stmt->execute(array($this->itemDesc, $this->uom, $this->warehouseLoc, $this->qty, $this->price));
       $message = "Item added successfully!";
       showAlert($message);
       return true;
     }
     catch (PDOException $e) {
       $errorMessage = "Error, item could not be added\n".$e->getMessage();
       showAlert($errorMessage);
       return false;
     }
  }
}
?>