<?php 
//database connection
require('../../src/dbconnect.php');
require('../../src/config.php');
// update product
$error   = '';
$message ='';
if (isset($_POST['updateBtn'])) { 
  $title        = trim($_POST['title']);
  $description  = trim($_POST['description']);
  $price        = trim($_POST['price']);
  $id           = trim($_POST['id']);
//validation of product name
  if (empty($title)) {
      $error .=  '<li> Update: Product name must not be empty</li>';
  }else if(is_numeric($title)){
      $error .=  '<li> Update:  In Product name, number is not allowed</li>';
  }else if(!preg_match("/^[a-zA-Z0-9 ]*$/",$title)){
       $error .=  '<li> Update: In Product name, only letter and whitespace are allowed</li>'; 
  }else if(strlen($title) > 90){
       $error .=  '<li> Update: Product name must have less than 30 characters</li>'; 
  }else if(strlen($title) < 5){
       $error .=  '<li> Update: Product name must have 4 characters more</li>'; 
  }
//validation of price
  if(empty($price)){
      $error .=  '<li> Update: Price must not be empty</li>';
  }else if(!preg_match('/^(0|[1-9]\d*)(\.\d{2})?$/',$price)){
       $error .=  '<li> Update: Price Seems wrong, 00/00.00 are right format</li>';
  }else if(strlen($price) > 9){
       $error .=  '<li>Update: Price seems too high</li>';
  }else if(strlen($price) < 2){
       $error .=  '<li> Update: Price seems too low</li>';
  }
//validation of product description
  if(empty($description)){
      $error .=  '<li> Update: Product description must not be empty</li>';
  }else if(is_numeric($description)){
      $error .=  '<li> Update: In Product description, number is not allowed</li>';
  }else if(!preg_match("/^[a-zA-Z]$/",$description[0])){
       $error .=  '<li>  Update: In Product description, start with letter</li>';
  }else if(!preg_match("/^[a-zA-Z ]*$/",substr($description, 0, 15))){
       $error .=  '<li>  Update: In Product description, First 15 character should have letter</li>';
  }else if(strlen($description) < 40){
       $error .=  '<li> Update: Product description should have at least 40 character</li>';
  }else if(strlen($description[0]) > 10){
       $error .=  '<li> First word is too long. *Use space to make it short</li>';
  }
  if($error){
       $message =  "<ul style='background-color:#f8d7da;'>{$error}</ul>";
    }
    else {   
    $ProductHandler -> update();    
  }
}
// Bringing all products to display on page
$products = $ProductHandler -> bringAll();
// output with JSON
$data = [
  'message' => $message,
  'products'=> $products,
];
echo json_encode($data);
?>