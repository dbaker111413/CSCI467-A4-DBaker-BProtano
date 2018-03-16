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
  * Validates the data. Returns true if values are okay for database,
  * false otherwise
  */
  private function validateData(){
     if(empty($this->itemDesc) || $this->itemDesc == ""){
       showAlert("Item Description cannot be empty!");
       return false;
     }
     if(empty($this->uom) || $this->uom == ""){
       showAlert("Unit of Measurement cannot be empty!");
       return false;
     }
     if(empty($this->warehouseLoc) || $this->warehouseLoc == ""){
       showAlert("Warehouse Location cannot be empty!");
       return false;
     }
     if(empty($this->qty) || $this->qty == "" || !is_numeric($this->qty)){
       showAlert("Quantity must be non-empty and numeric!");
       return false;
     }
     if(empty($this->price) || $this->price == "" || !is_numeric($this->price)){
       showAlert("Price must be non-empty and numeric!");
       return false;
     }

     return true;
  }

  /*
  * validates data and saves to the database
  * if the ID exists in the database, perform an update.
  * otherwise, perform an insert
  **/
  public function addToDatabase(){
     // first, check to make sure data is valid
     if(!$this->validateData()){
       exit;
     }

     // now that the data has been validated, save to the database
     $insertSQL = 'insert into item ( description, uom, location, on_hand, price)
	     		               values (?, ?, ?, ?, ?)';
 
     try {
       $stmt = $this->conn->prepare($insertSQL);
       $ok = $stmt->execute(array($this->itemDesc, $this->uom, $this->warehouseLoc, $this->qty, $this->price));
       $message = "Item added successfully!";
       showAlert($message);
     }
     catch (PDOException $e) {
       $errorMessage = "Error, item could not be added\n".$e->getMessage();
       showAlert($errorMessage);
       exit;
     }
  }
}
?>