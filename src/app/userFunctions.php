<?php

function fetchAllUsers (){
	global $dbconnect;
try {
	
	$stmt = $dbconnect->query("SELECT * FROM users");
	
	$getAllUsers = $stmt->fetchAll(); 
} catch (\PDOException $e) {
	throw new \PDOException($e->getMessage(), (int) $e->getCode());
}
return $getAllUsers;
}


function addUser($userData){
	global $dbconnect;
try {

$query = "INSERT INTO users (first_name, last_name, email, password, phone, street, postal_code, city, country)
			VALUES (:first_name, :last_name, :email, :password, :phone, :street, :postal_code, :city, :country);
			";

			$stmt = $dbconnect->prepare($query); 
			$stmt->bindValue(":first_name", $userData['first_name']);
			$stmt->bindValue(":last_name", $userData['last_name']);
			$stmt->bindValue(":email", $userData['email']);
			$stmt->bindValue(":password", $userData['password']);
			$stmt->bindValue(":phone", $userData['phone']);
			$stmt->bindValue(":street", $userData['street']);
			$stmt->bindValue(":postal_code", $userData['postal_code']);
			$stmt->bindValue(":city", $userData['city']);
			$stmt->bindValue(":country", $userData['country']);
			$result = $stmt->execute(); 

		} catch (\PDOException $e) {
			throw new \PDOException($e->getMessage(), (int) $e->getCode());
		}
return $result;
}

function deleteUser(){
	global $dbconnect;
if (isset ($_POST["deleteUserBtn"])){
	$id = $_POST['deleteUserId'];
	try {
		$query = "
				DELETE FROM users 
				WHERE id = :id;
			";
		$stmt = $dbconnect->prepare($query); 
		$stmt->bindValue(":id", $id);
		$stmt->execute(); 
	}
		catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int) $e->getCode());
	
	}
}
}



function updateUser($userData){

	global $dbconnect;
	try {
		$query = "
			UPDATE users
			SET first_name = :first_name, last_name=:last_name, email=:email, password=:password, phone=:phone, street=:street, postal_code=:postal_code, city=:city, country=:country
			WHERE id= :id
			";

			$stmt = $dbconnect->prepare($query); 
			$stmt->bindValue(":first_name", $userData['first_name']);
			$stmt->bindValue(":last_name", $userData['last_name']);
			$stmt->bindValue(":email", $userData['email']);
			$stmt->bindValue(":password", $userData['password']);
			$stmt->bindValue(":phone", $userData['phone']);
			$stmt->bindValue(":street", $userData['street']);
			$stmt->bindValue(":postal_code", $userData['postal_code']);
			$stmt->bindValue(":city", $userData['city']);
			$stmt->bindValue(":country", $userData['country']);
			$stmt->bindValue(':id', $userData['id']);
			$result = $stmt->execute(); 
      
	} catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }	

    return $result; 

}

function fetchUser(){
	global $dbconnect;
    try {
        $query = "
            SELECT * FROM users
            WHERE id = :id;
        ";

        $stmt = $dbconnect->prepare($query);
        $stmt->bindvalue(':id', $_GET['id']);
        $stmt->execute();
     
        $getSpecifiedUser = $stmt->fetch();
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
    return $getSpecifiedUser;
} 
?>