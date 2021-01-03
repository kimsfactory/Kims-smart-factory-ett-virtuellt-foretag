<?php 
//database connection
require('../../src/dbconnect.php');
require('../../src/config.php');
// delete product
$error   = '';
$message = '';
if (isset($_POST['deleteBtn'])) {
 $id = $_POST['hidId'];
  $ProductHandler -> delete();      
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