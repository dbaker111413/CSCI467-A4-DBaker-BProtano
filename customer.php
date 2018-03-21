<?php

// include necessary php files
require_once("a4_conn.php");
require_once("globalFunctions.php");

class customer {
  public $customerNumber = 0;
  public $customerName = "";
  public $billAddress1 = "";
  public $billAddress2 = "";
  public $billCity = "";
  public $billState = "";
  public $billZip = "";
  public $shipAddres1 = "";
  public $shipAddress2 = "";
  public $shipCity = "";
  public $shipState = "";
  public $shipZip = "";
  public $fname = "";
  public $lname = "";
  public $areaCode = "";
  public $midDigits = "";
  public $endDigits = "";
  public $ext = "";
  public $email = "";
  public $comment = "";
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
     $insertSQL = 'insert into customer ( name, address_line1, address_line2, city, state, zip,
					  ship_address_line1, ship_address_line2, ship_city,
                                          ship_state, ship_zip, fname, lname, phone_area,
                                          phone_middle, phone_end, phone_ext, email, comments )
	     		                  values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
  
     try {
       $stmt = $this->conn->prepare($insertSQL);
       $ok = $stmt->execute(array($this->customerName, $this->billAddress1, $this->billAddress2, $this->billCity, $this->billState, $this->billZip,
	                           $this->shipAddress1, $this->shipAddress2, $this->shipCity, $this->shipState, $this->shipZip, $this->fname,
	                           $this->lname, $this->areaCode, $this->midDigits, $this->endDigits, $this->ext, $this->email, 
				   $this->comment));


       $message = "Customer added successfully!";
       showAlert($message);
       return true;
     }
     catch (PDOException $e) {
       $errorMessage = "Error, customer could not be added\n".$e->getMessage();
       showAlert($errorMessage);
       return false;
     }
  }
}
?>
