<?php
require('../src/config.php');
require('../src/dbconnect.php');

// debug($_POST);
// exit;

// Delete an order
if (isset($_POST['delete-order-btn'])) {
  $orderId = $_POST['orderId'];
  $OrderDbHandler->deleteOrder(); 
}

// Fetch orders to display on page
$orders = $OrderDbHandler->fetchOrders();


// output with JSON
$data = [
  'orders'    => $orders,
];
echo json_encode($data);

?>