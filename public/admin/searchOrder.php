<?php
require('../src/config.php');
require('../src/dbconnect.php');

// debug($_GET);
// exit;

if (isset($_GET['searchQuery']) && !empty($_GET['searchQuery'])) {
	$searchName = "%$_GET['searchQuery']%";
	$orders = $OrderDbHandler->searchOrder();
} else {
		$orders = $OrderDbHandler->fetchOrders();
	}

// output with JSON
$data = [
  'orders'    => $orders,
];
echo json_encode($data);

?>