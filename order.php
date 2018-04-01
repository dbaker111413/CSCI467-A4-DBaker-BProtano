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
  * inserts new customer into database. An array of detail lines are passed in to be saved with the order
  * returns true if successful, false otherwise
  **/
  public function addToDatabase($detail_lines){

     // Set $lines to the count of $detail_lines
     $lines = count($detail_lines);
     
     // data is validated as part of the html definition
     $insertSQL = 'insert into order_header ( order_date, order_status, order_expected_date,
                                              order_lines, customer_id) values (?, ?, ?, ?, ?)';

     // this gets the id of the newly created order
     $selectSQL = 'select order_id from order_header order by order_id desc';

     try {
       showAlert($this->customerNum);
       $stmt = $this->conn->prepare($insertSQL);
       $ok = $stmt->execute(array($this->date, $this->status, $this->expectedDate, $this->lines, $this->customerNum));
       // get the order_id for the detail lines, we only care about the first row
       foreach($this->conn->query($selectSQL) as $row){
         $this->orderNum = $row["order_id"];
	 break;
       }

       // now set the order id and save each detail line
       foreach($detail_lines as $line){
         $line->order_id = $this->orderNum;
	 $line->addToDatabase();
       }
      
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
