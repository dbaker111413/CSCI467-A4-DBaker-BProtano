<?php

// include necessary php files
require_once("conn.php");
require_once("globalFunctions.php");

class order {
  public $orderNum = 0;
  public $date = "";
  public $status= "";
  public $expectedDate= "";
  public $lines = 0;
  public $customerNum = 0;
  public $shipmentNum = 0;
  public $conn;

  /*
  * Initialize class with connection string because it appears global variables
  * cannot be accessed within a class
  */
  function __construct($conn){
     $this->conn = $conn;
  }


  /*
  * inserts new customer into database.
  * returns true if successful, false otherwisex
  **/
  public function addToDatabase(){
     // data is validated as part of the html definition
     $insertSQL = 'insert into order_header ( order_date, order_status, order_expected_date, order_lines, customer_id,
	     		                  values (?, ?, ?, ?, ?)';
  
     try {
       $stmt = $this->conn->prepare($insertSQL);
       $ok = $stmt->execute(array($this->date, $this->status, $this->expectedDate, $this->lines, $this->customer_id));


       $message = "Customer Order created successfully!";
       showAlert($message);
       return true;
     }
     catch (PDOException $e) {
       $errorMessage = "Error, Customer Order could not be created\n".$e->getMessage();
       showAlert($errorMessage);
       return false;
     }
  }
}
?>
