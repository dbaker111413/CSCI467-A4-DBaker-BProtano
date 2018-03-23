<?php

// include necessary php files
require_once("conn.php");
require_once("globalFunctions.php");

class item {
  public $itemNumber = 0;
  public $itemDesc = "";
  public $uom = "";
  public $warehouseLoc = "";
  public $qty = "";
  public $price = "";
  public $vendor = 0;
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
     $insertSQL = 'insert into item ( description, uom, location, on_hand, price, vendor_id)
	     		               values (?, ?, ?, ?, ?, ?)';
 
     try {
       $stmt = $this->conn->prepare($insertSQL);
       $ok = $stmt->execute(array($this->itemDesc, $this->uom, $this->warehouseLoc, $this->qty, $this->price, $this->vendor));
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

  /*
  * Uses the parameter, which is either an item_id or an item description,
  * and gets the values for it from the database.
  */
  public function setItem($id){
    $selectSQL = "";
    // check if the input is numeric, which means it is an item_id
    if(is_numeric($id)){
      $selectSQL = "select * from item where item_num = ".$id;
      showAlert("selecting ID");
    }
    else{
      $selectSQL = "select * from item where description = '".$id."'";
      showAlert("selecting description");
    }

    // attempt to run the query
    try{
      // there should only be one row
      foreach($conn->query($selectSQL) as $row){
        $this->itemNumber = $row["item_id"];
	$this->itemDesc = $row["description"];
        $this->uom = $row["uom"];
        $this->warehouseLoc = $row["location"];
        $this->qty = $row["on_hand"];
	$this->price = $row["price"];
	$this->vendor = $row["vendor_id"];
      }
    }
    catch(PDOException $e){
      // show a message and make sure all values are set to defaults
      showAlert("Error! Could not read item from the database!".$e->getMessage());
      $this->itemNumber = 0;
      $this->itemDesc = "";
      $this->uom = "";
      $this->warehouseLoc = "";
      $this->qty = "";
      $this->price = "";
      $this->vendor = 0;
    }
  }

  /*
  * Updates an existing item in the database
  */
  public function updateDatabase(){
    // data is validated as part of the html definition
    $updateSQL = 'update item set description=?, uom=?, location=?, on_hand=?, price=? where item_id=?';

    // try executing the sql
    try{
      $smtm = $this->conn->prepare($updateSQL);
      $ok = $stmt->execute(array($this->itemDesc, $this->uom, $this->warehouseLoc, $this->qty, $this->price, $this->vendor,
                                 $this->itemNumber));
      $message = "Item updated successfully!";
      showAlert($message);
      return true;
    }
    catch (PDOException $e){
      $errorMessage = "Error, item could not be updated\n".$e->getMessage();
      showAlert($errorMessage);
      return false;
    }
  }
}
?>
