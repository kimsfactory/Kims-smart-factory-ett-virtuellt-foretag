<?php
class OrderDbHandler{

	public function fetchOrders() {
		global $dbconnect;
		try {
			$query = "
				SELECT * FROM orders
			";
			$stmt = $dbconnect->query($query);
			$orders = $stmt->fetchAll();
		} catch (\PDOException $e) {
			throw new \PDOException($e->getMessage(), (int) $e->getCode());
		}
		return $orders;
	}



	public function searchOrder($searchName){
		global $dbconnect;
		try {
		  	$query = "
		  		SELECT * FROM orders 
		  		WHERE billing_full_name LIKE :billing_full_name
	  	  	";

		  	$stmt = $dbconnect->prepare($query);
		  	$stmt->bindvalue(':billing_full_name', $searchName);
		  	$stmt->execute();
		  	$orders = $stmt->fetchAll();
		} catch (\PDOException $e) {
		  throw new \PDOException($e->getMessage(), (int) $e->getCode());
		}
		return $orders;
	}



	public function deleteOrder($orderId){
  		global $dbconnect;
  		try {
    		$query = "
      			DELETE FROM orders
      			WHERE id = :id;
    		";

		    $stmt = $dbconnect->prepare($query);
		    $stmt->bindValue(':id', $orderId);
		    $stmt->execute();
		} catch (\PDOException $e) {
		    throw new \PDOException($e->getMessage(), (int) $e->getCode());
		}
  	}



	public function addOrder($orderData) {
		global $dbconnect;
				try {
			$query = "
				INSERT INTO orders (user_id, total_price, billing_full_name, billing_street, billing_postal_code, billing_city, billing_country)
				VALUES (:userId, :totalPrice, :fullName, :street, :postalCode, :city, :country);
			";
			$stmt = $dbconnect->prepare($query);
			$stmt->bindValue(':userId', $orderData['userId']);
			$stmt->bindValue(':totalPrice', $orderData['totalPrice']);
			$stmt->bindValue(':fullName', $orderData['"{$firstName} {$lastName}"']);
			$stmt->bindValue(':street', $orderData['street']);
			$stmt->bindValue(':postalCode', $orderData['postalCode']);
			$stmt->bindValue(':city', $orderData['city']);
			$stmt->bindValue(':country', $orderData['country']);
			$stmt->execute();
			$orderId = $dbconnect->lastInsertId();
		} catch (\PDOException $e) {
			throw new \PDOException($e->getMessage(), (int) $e->getCode());
		}
		return $orderId;
	}


	public function addOrderedItems() {
		global $dbconnect;
		try {
			$query = "
				INSERT INTO order_items (order_id, product_id, quantity, unit_price, product_title)
				VALUES (:orderId, :productId, :quantity, :price, :title);
			";
			$stmt = $dbconnect->prepare($query);
			$stmt->bindValue(':orderId', $orderId);
			$stmt->bindValue(':productId', $cartItem['id']);
			$stmt->bindValue(':quantity', $cartItem['quantity']);
			$stmt->bindValue(':price', $cartItem['price']);
			$stmt->bindValue(':title', $cartItem['title']);
			$stmt->execute();
		} catch (\PDOException $e) {
			throw new \PDOException($e->getMessage(), (int) $e->getCode());
		}
	}

}
?>