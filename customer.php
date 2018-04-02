<?php

// include necessary php files
require_once("conn.php");
require_once("globalFunctions.php");

class customer {
  public $customerNumber = 0;
  public $customerName = "";
  public $billAddress1 = "";
  public $billAddress2 = "";
  public $billCity = "";
  public $billState = "";
  public $billZip = "";
  public $shipAddress1 = "";
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
  * Uses the provided Id to get the customer information from the database
  **/
  public function setCustomer($id){
    $selectSQL = "";

    if(is_numeric($id)){
      $selectSQL = "select * from customer where customer_id=".$id;
    }
    else{
      $selectSQL = "select * from customer where name='".$id."'";
    }

    // attempt to run the query
    try{
      // there should only be one row
      foreach($this->conn->query($selectSQL) as $row){
        $this->customerNumber = $row['customer_id'];
      	$this->customerName = $row['name'];
      	$this->billAddress1 = $row['address_line1'];
      	$this->billAddress2 = $row['address_line2'];
      	$this->billCity = $row['city'];
      	$this->billState = $row['state'];
      	$this->billZip = $row['zip'];
      	$this->shipAddress1 = $row['ship_address_line1'];
      	$this->shipAddress2 = $row['ship_address_line2'];
      	$this->shipCity = $row['ship_city'];
      	$this->shipState = $row['ship_state'];
      	$this->shipZip = $row['ship_zip'];
      	$this->fname = $row['fname'];
      	$this->lname = $row['lname'];
      	$this->areaCode = $row['phone_area'];
      	$this->midDigits = $row['phone_middle'];
      	$this->endDigits = $row['phone_end'];
      	$this->ext = $row['phone_ext'];
      	$this->email = $row['email'];
      	$this->comment = $row['comments'];
      }
    }
    catch(PDOException $e){
      // show a message and make sure all values are set to defaults
      showAlert("Error! Could not read item from the database!".$e->getMessage());
      $this->customerNumber = 0;
      $this->customerName = "";
      $this->billAddress1 = "";
      $this->billAddress2 = "";
      $this->billCity = "";
      $this->billState = "";
      $this->billZip = "";
      $this->shipAddress1 = "";
      $this->shipAddress2 = "";
      $this->shipCity = "";
      $this->shipState = "";
      $this->shipZip = "";
      $this->fname = "";
      $this->lname = "";
      $this->areaCode = "";
      $this->midDigits = "";
      $this->endDigits = "";
      $this->ext = "";
      $this->email = "";
      $this->comment = "";
    }
  }

  /*
  * inserts new customer into database.
  * returns true if successful, false otherwise
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
       $ok = $stmt->execute(array($this->customerName, $this->billAddress1, $this->billAddress2,
                                  $this->billCity, $this->billState, $this->billZip,
	                          $this->shipAddress1, $this->shipAddress2, $this->shipCity, $this->shipState,
				  $this->shipZip, $this->fname, $this->lname, $this->areaCode, $this->midDigits,
				  $this->endDigits, $this->ext, $this->email, $this->comment));


       $message = "Customer added! Confirmation email with default user name and password were to ".$this->email;
       showAlert($message);
       return true;
     }
     catch (PDOException $e) {
       $errorMessage = "Error, customer could not be added\n".$e->getMessage();
       showAlert($errorMessage);
       return false;
     }
  }

  /*
  * updates an existing customer in the database.
  * returns true if successful, false otherwise
  **/
  public function updateDatabase(){
     // data is validated as part of the html definition
     $insertSQL = 'update customer set name=?, address_line1=?, address_line2=?, city=?, state=?, zip=?,
					  ship_address_line1=?, ship_address_line2=?, ship_city=?,
                                          ship_state=?, ship_zip=?, fname=?, lname=?, phone_area=?,
                                          phone_middle=?, phone_end=?, phone_ext=?, email=?, comments=?
					  where customer_id=?';
	     		                  
  
     try {
       $stmt = $this->conn->prepare($insertSQL);
       $ok = $stmt->execute(array($this->customerName, $this->billAddress1, $this->billAddress2,
                                   $this->billCity, $this->billState, $this->billZip,
	                           $this->shipAddress1, $this->shipAddress2, $this->shipCity, $this->shipState,
				   $this->shipZip, $this->fname, $this->lname, $this->areaCode,
				   $this->midDigits, $this->endDigits, $this->ext, $this->email, 
				   $this->comment, $this->customerNumber));


       $message = "Customer updated successfully!";
       showAlert($message);
       return true;
     }
     catch (PDOException $e) {
       $errorMessage = "Error, customer could not be updated\n".$e->getMessage();
       showAlert($errorMessage);
       return false;
     }
     catch (Exception $e) {
       $errorMessage = "Error, customer could not be updated\n".$e->getMessage();
       showAlert($errorMessage);
       return false;
     }
  }
}
?>
