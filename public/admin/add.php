<?php 
//database connection
require('../../src/dbconnect.php');
require('../../src/config.php');
// Add new product
$error   = '';
$message ='';
if (isset($_POST['addBtn'])) {
  $title        = trim($_POST['title']);
  $description  = trim($_POST['description']);
  $price        = trim($_POST['price']);
//validation of product name
  if (empty($title)) {
      $error .=  '<li> Product name must not be empty</li>';
  }else if(is_numeric($title)){
      $error .=  '<li> Product name: Only number is not allowed</li>';
  }else if(!preg_match("/^[a-zA-Z0-9 ]*$/",$title)){
       $error .=  '<li> Product name: Only letter, number and whitespace are allowed</li>'; 
  }else if(strlen($title) > 90){
       $error .=  '<li> Product name must have less than 90 characters</li>'; 
  }else if(strlen($title) < 5){
       $error .=  '<li> Product name must have 4 characters long</li>'; 
  }
//validation of price
  if(empty($price)){
      $error .=  '<li> Price must not be empty</li>';
  }else if(!preg_match('/^(0|[1-9]\d*)(\.\d{2})?$/',$price)){
       $error .=  '<li> Price: Seems wrong price, 00/00.00 are right format</li>';
  }else if(strlen($price) > 9){
       $error .=  '<li>Price seems too high</li>';
  }else if(strlen($price) < 2){
       $error .=  '<li> Price seems too low</li>';
  }
 //validation of product description
$firstWord=explode(' ',trim($_POST['description']));
  if(empty($description)){
      $error .=  '<li> Product description must not be empty</li>';
  }else if(is_numeric($description)){
      $error .=  '<li> Product description: number is not allowed</li>';
  }else if(!preg_match("/^[a-zA-Z]$/",$description[0])){
       $error .=  '<li>  Product description: start with letter</li>';
  }else if(!preg_match("/^[a-zA-Z ]*$/", substr($description, 0, 15))){
       $error .=  '<li>  Product description: First 15 character should have letter</li>';
  }else if(strlen($description) < 40){
       $error .=  '<li>  Product description should have at least 40 character</li>';
  }else if(strlen($firstWord[0]) > 10){
       $error .=  '<li> First word is too long. *Use space to make it short</li>';
  }
  if($error){
       $message =  "<ul style='background-color:#f8d7da;'>{$error}</ul>";
    }
    else {
    $ProductHandler -> add();    
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