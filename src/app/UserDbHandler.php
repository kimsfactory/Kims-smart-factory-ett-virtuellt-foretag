<?php
class UserDbHandler{
	
	public function fetch() {
		global $dbconnect;
		try {
		    $query = "
		        SELECT * FROM users
		    ";
		    $stmt = $dbconnect->query($query);
		    $users = $stmt->fetch();
		} catch (\PDOException $e) {
		    throw new \PDOException($e->getMessage(), (int) $e->getCode());
		}
		return $users;
	}
	


	public function fetchByEmail($email) {
	    global $dbconnect;
	    try {
	        $query = "
	            SELECT * FROM users
	            WHERE email = :email;
	        ";
	        $stmt = $dbconnect->prepare($query);
	        $stmt->bindValue(':email', $email);
	        $stmt->execute();
	        $user = $stmt->fetch();
	    } catch (\PDOException $e) {
	        throw new \PDOException($e->getMessage(), (int) $e->getCode());
	    }
	    return $user;
	}
	


	public function delete($id) {
		global $dbconnect;
		try {
		    $query = "
		        DELETE FROM users
		        WHERE id = :id;
		    ";
		    $stmt = $dbconnect->prepare($query);
		    $stmt->bindValue(':id', $id);
		    $stmt->execute();
		} catch (\PDOException $e) {
		    throw new \PDOException($e->getMessage(), (int) $e->getCode());
		}
	}
	


	public function update($userData) {
	    global $dbconnect;
	    try {
	        $query = "
	            UPDATE users
	            SET first_name = :first_name, last_name = :last_name, email = :email, password = :password, phone = :phone, street = :street, postal_code = :postal_code, city = :city, country = :country
	            WHERE id = :id
	        ";
	        $stmt = $dbconnect->prepare($query);
	        $stmt->bindValue(':first_name', $userData['first_name']);
	        $stmt->bindValue(':last_name', $userData['last_name']);
	        $stmt->bindValue(':email', $userData['email']);
	        $stmt->bindValue(':password', password_hash($userData['password'], PASSWORD_BCRYPT));
	        $stmt->bindValue(':phone', $userData['phone']);
	        $stmt->bindValue(':street', $userData['street']);
	        $stmt->bindValue(':postal_code', $userData['postal_code']);
	        $stmt->bindValue(':city', $userData['city']);
	        $stmt->bindValue(':country', $userData['country']);
	        $stmt->bindValue(':id', $userData['id']);
	        $result = $stmt->execute(); // returns true/false
	    } catch(\PDOException $e) {
	        throw new \PDOException($e->getMessage(), (int) $e->getCode());
	    }
	    return $result;
	}


	public function addAndFetch($userData) {
		global $dbconnect;
		try {
			$query = "
				INSERT INTO users (first_name, last_name, email, password, phone, street, postal_code, city, country)
				VALUES (:firstName, :lastName, :email, :password, :phone, :street, :postalCode, :city, :country);
			";
			$stmt = $dbconnect->prepare($query);
			$stmt->bindValue(':firstName', $userData['firstName']);
			$stmt->bindValue(':lastName', $userData['lastName']);
			$stmt->bindValue(':email', $userData['email']);
			$stmt->bindValue(':password', $userData['password']);
			$stmt->bindValue(':phone', $userData['phone']);
			$stmt->bindValue(':street', $userData['street']);
			$stmt->bindValue(':city', $userData['city']);
			$stmt->bindValue(':country', $userData['country']);
			$stmt->bindValue(':postalCode', $userData['postalCode']);
			$stmt->execute();
			$userId = $dbconnect->lastInsertId();
		} catch (\PDOException $e) {
		  	throw new \PDOException($e->getMessage(), (int) $e->getCode());
		}
		return $userId;
	}
	


	public function add($userData) {
	    global $dbconnect;
	    try {
	        $query = "
	            INSERT INTO users (first_name, last_name, email, password, phone, street, postal_code, city, country)
	            VALUES (:first_name, :last_name, :email, :password, :phone, :street, :postal_code, :city, :country);
	        ";
	        $stmt = $dbconnect->prepare($query);
	        $stmt->bindValue(':first_name', $userData['first_name']);
	        $stmt->bindValue(':last_name', $userData['last_name']);
	        $stmt->bindValue(':email', $userData['email']);
	        $stmt->bindValue(':password', password_hash($userData['password'], PASSWORD_BCRYPT));
	        $stmt->bindValue(':phone', $userData['phone']);
	        $stmt->bindValue(':street', $userData['street']);
	        $stmt->bindValue(':postal_code', $userData['postal_code']);
	        $stmt->bindValue(':city', $userData['city']);
	        $stmt->bindValue(':country', $userData['country']);
	        $result = $stmt->execute(); // returns true/false
	    } catch(\PDOException $e) {
	        throw new \PDOException($e->getMessage(), (int) $e->getCode());
	    }
	    return $result;
	}

}
?>