<?php
session_start();

// OBS Lägg till if logged in senare här

require('../../src/dbconnect.php');

if (isset($_POST["addUserBtn"])){
	$firstName = trim($_POST["firstName"]);
	$lastName = trim($_POST["lastName"]);
	$email = trim($_POST["email"]);
	$passWord = trim($_POST["passWord"]);
	$phone = trim($_POST["phone"]);
	$street = trim($_POST["street"]);
	$postalcode = trim($_POST["postalcode"]);
	$city = trim($_POST["city"]);
	$country = trim($_POST["country"]);

if (empty($firstName)){
        $error .= "<li>Please enter the users first name</li>";
    }
if(empty($lastName)){
        $error .= "<li>Please enter the users last name</li>";
    }
if(empty($email)){
        $error .= "<li>Please enter the users email</li>";
    }
if (empty($passWord)){
    	$error .="<li> Please enter the users password";
    }

if(empty($phone)){
        $error .= "<li>Please enter the users phone</li>";
    }
if(empty($street)){
        $error .= "<li>Please enter the users street</li>";
    }
if(empty($postalcode)){
        $error .= "<li>Please enter the users postalcode</li>";
    }
if(empty($city)){
        $error .= "<li>Please enter the users city</li>";
    }
if(empty($country)){
        $error .= "<li>Please enter the users country</li>";
    }

if (!empty($error)){
        $msg = "<ul class='error_msg'>$error</ul>";
    }

if (empty($error)){
	

try {

$query = "INSERT INTO users (first_name, last_name, email, password, phone, street, postal_code, city, country)
			VALUES (:first_name, :last_name, :email, :password, :phone, :street, :postal_code, :city, :country);
			";

			$stmt = $dbconnect->prepare($query); 
			$stmt->bindValue(":first_name", $firstName);
			$stmt->bindValue(":last_name", $lastName);
			$stmt->bindValue(":email", $email);
			$stmt->bindValue(":password", $passWord);
			$stmt->bindValue(":phone", $phone);
			$stmt->bindValue(":street", $street);
			$stmt->bindValue(":postal_code", $postalcode);
			$stmt->bindValue(":city", $city);
			$stmt->bindValue(":country", $country);
			$stmt->execute(); 

		} catch (\PDOException $e) {
			throw new \PDOException($e->getMessage(), (int) $e->getCode());
		}
}
}

//***************************Delete User PHP ********************

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

//***************************Hämtar användare från databas ********************

try {
	
	$stmt = $dbconnect->query("SELECT * FROM users");
	
	$getAllUsers = $stmt->fetchAll(); 
} catch (\PDOException $e) {
	throw new \PDOException($e->getMessage(), (int) $e->getCode());
}


//	echo "<pre>";
//		print_r($_POST);
//	echo "</pre>";
?>

<!-- ******************************* HTML. *************************************** -->

<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
</head>
<body>
	<div>
	<h1>Administer Users </h1>

	<h3> Edit or delete existing users </h3>
	  <?=$msg?>
	</div>
	<form id="add-user-form" method="POST">
		<input name="firstName" class="add-user-form-item" id="add-first-name" type="text" placeholder="first name">
		<input name="lastName" class="add-user-form-item" id="add-last-name" type="text" placeholder="last name">
		<input name="email" class="add-user-form-item" id="add-email" type="text" placeholder="email">
		<input name="passWord" class="add-user-form-item" id="add-password" type="text" placeholder="password">
		<input name="phone" class="add-user-form-item" id="add-phone" type="text" placeholder="phone">
		<input name="street" class="add-user-form-item" id="add-street" type="text" placeholder="street">
		<input name="postalcode" class="add-user-form-item" id="add-postalcode" type="text" placeholder="postalcode">
		<input name="city" class="add-user-form-item" id="add-city" type="text" placeholder="city">
		<input name="country" class="add-user-form-item" id="add-country" type="text" placeholder="country">
		<input name="addUserBtn" type="submit" class="button" value="Add User">

	</form>



	<table id="existing-users-tbl">
	
	<tbody>
			<?php foreach ($getAllUsers as $key => $user) { ?>
							
				<tr>
					<td class="tableinputdata" id="blogTitle"><?=htmlentities($user['first_name'])?></td>
					
					<td class="tableinputdata" id="blogContent"><?=htmlentities($user['last_name'])?></td>
			
					<td class="tableinputdata" id="blogAuthor"><?=htmlentities($user['email'])?></td>
				
					<td class="tableinputdata" id="blogTitle"><?=htmlentities($user['phone'])?></td>
			
					<td class="tableinputdata" id="blogContent"><?=htmlentities($user['street'])?></td>
			
					<td class="tableinputdata" id="blogAuthor"><?=htmlentities($user['postalcode'])?></td>
			
					<td class="tableinputdata" id="blogTitle"><?=htmlentities($user['city'])?></td>
			
					<td class="tableinputdata" id="blogContent"><?=htmlentities($user['country'])?></td>
				
					<td class="tableinputdata" id="blogAuthor"><?=htmlentities($user['register_date'])?></td>
					<td>
						<form action="" method="POST">
							<input type="hidden" name="deleteUserId" value="<?=$user['id']?>">
							<input type="submit" class="button" name="deleteUserBtn" value="Delete">
						</form>
						<form action="update_user.php" method="GET">
							<input type="hidden" name="id" value="<?=$user['id']?>">
							<input type="submit" class="button" name="updateUserBtn" value="Uppdatera">
						</form>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>	
	

</body>
</html>