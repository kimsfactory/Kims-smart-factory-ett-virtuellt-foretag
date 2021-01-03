<?php


//if (!isset($_SESSION['username'])){
//  header('location: index.php?mustlogin');
//  exit;
//}
require('../../src/dbconnect.php');

require('../../src/app/userFunctions.php');


//***************************Add User PHP ********************
// Kontrollera alla inmatade värden
 $msg="";
if (isset($_POST["addUserBtn"])){
	$firstName = trim($_POST["firstName"]);
	$lastName = trim($_POST["lastName"]);
	$email = trim($_POST["email"]);
	$passWord = trim($_POST["passWord"]);
	$verifyPassWord = trim($_POST["verifyPassWord"]);
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

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $error .= "<li>Invalid email adress</li>"; 
}

if (empty($passWord)){
    	$error .="<li> Please enter the users password";
    }
if (strlen($passWord) < 8){
       $error .=  "<li> Password must be at least 8 characters </li>";
  }

if ($passWord !== $verifyPassWord){
	$error .= "<li>Password does not match verified password</li>";
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
        $msg = "<ul class='error_msg'>$error</ul> <style> .error_msg {background: #CA375B;} </style>";
    }

if (empty($error)){
	$userData = [
		 		'first_name' 	=> $firstName,
                'last_name' 	=> $lastName,
                'email'   		=> $email,
                'password' 		=> $passWord,
                'phone' 		=> $phone,
                'street'    	=> $street,
                'postal_code' 	=> $postalcode,
                'city'			=> $city,
                'country'		=> $country,
                'id'       		=> $_GET['id'],
            ];
			$result = addUser($userData);
              if ($result) {
                $msg = '<div class="success_msg">Ny användare är skapad</div>';
            } else {
                $msg = '<div class="error_msg">Skapandet av användaren misslyckades. Var snäll och försök igen senare!</div>';
            }
        }
    }
	
	
deleteUser();

$getAllUsers = fetchAllUsers();
//	echo "<pre>";
//		print_r($_POST);
//	echo "</pre>";
?>

<!-- ******************************* HTML. *************************************** -->

<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/users.css">


</head>

<body>
<div class="container-fluid">
	
 <?php include('layout/headerdaniel.php'); ?>
 
<div class="container">
	<div class="text-center userheadlinediv">	
		<h1>Welcome adminname </h1>
	
	</div>
	<div class="text-center userheadlinediv">
		<h3> Add a new user </h3>
		<hr>
	</div>
</div>
<div class="headline text-center">
	
	  		<p><?=$msg?></p>
<!--****************** Formulär för att lägga till users HTML ********
-->	  	
</div>
	<div class="container  justify-content-center">
		<form id="add-user-form" method="POST">
			<div class="row">
				<div class="col-sm">
					<label> First name </label>
					<input name="firstName" class="form-control" id="add-first-name" type="text" placeholder="first name">
				</div>
				<div class="col-sm">
					<label>Last name </label>
					<input name="lastName" class="form-control" id="add-last-name" type="text" placeholder="last name">
				</div>
			</div>
		
			<div class="row">
				<div class="col-sm">
					<label>Password </label>
					<input name="passWord" class="form-control" id="add-password" type="password" placeholder="password">
				</div>
				<div class="col-sm">

					<label>Verify password </label>
					<input name="verifyPassWord" class="form-control" id="add-verify-password" type="password" placeholder="verify password">
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm">
					<label>Adress </label>
					<input name="street" class="form-control" id="add-street" type="text" placeholder="street">
				</div>
				<div class="col-sm">
					<label>Postalcode </label>
					<input name="postalcode" class="form-control" id="add-postalcode" type="text" placeholder="postalcode">
				</div>
			</div>
			<div class="row">
				<div class="col-sm">
					<label>City</label>
					<input name="city" class="form-control" id="add-city" type="text" placeholder="city">
				</div>
				<div class="col-sm">
					<label>Country </label>
					<input name="country" class="form-control" id="add-country" type="text" placeholder="country">
				</div>
			</div>
				<div class="row">
				<div class="col-sm">
					<label>Email </label>
					<input name="email" class="form-control" id="add-email" type="text" placeholder="email">
				</div>

				<div class="col-sm">
					<label>Phone </label>
					<input name="phone" class="form-control" id="add-phone" type="text" placeholder="phone">
				</div>
			</div>

			<input name="addUserBtn" type="submit" class="btn btn-success"value="Add User">

		</form>
	</div>

<!--****************** Listar användare för delete/update ********
-->

	<div class="text-center userheadlinediv">
		<h3> Edit or delete existing users </h3>
	</div>
	<div class="container-fluid">
	<div class="table-responsive-sm">
		<table id="existing-users-tbl" class="table">
			<thead class="thead-dark">
				<tr>
					<th scope="col">First name</th>
					<th scope="col">last name</th>
					<th scope="col" class="d-none d-md-table-cell">email</th>
					<th scope="col" class="d-none d-lg-table-cell">phone</th>
					<th scope="col" class="d-none d-lg-table-cell">street</th>
					<th scope="col" class="d-none d-lg-table-cell">postalcode</th>
					<th scope="col" class="d-none d-lg-table-cell">city</th>
					<th scope="col" class="d-none d-xl-table-cell">country</th>
					<th scope="col" class="d-none d-xl-table-cell">regiter date</th>
					<th scope="col">update</th>
					<th scope="col">delete</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($getAllUsers as $key => $user) { ?>
								
					<tr>
						<td scope="row" class="tableinputdata" id="user_first_name"><?=htmlentities($user['first_name'])?></td>
						
						<td class="tableinputdata" id="user_last_name"><?=htmlentities($user['last_name'])?></td>
				
						<td class="d-none d-md-table-cell" id="user_email"><?=htmlentities($user['email'])?></td>
					
						<td class="d-none d-lg-table-cell" id="user_phone"><?=htmlentities($user['phone'])?></td>
				
						<td class="d-none d-lg-table-cell" id="user_street"><?=htmlentities($user['street'])?></td>
				
						<td class="d-none d-lg-table-cell" id="user_postalcode"><?=htmlentities($user['postal_code'])?></td>
				
						<td class="d-none d-lg-table-cell" id="user_city"><?=htmlentities($user['city'])?></td>
				
						<td class="d-none d-xl-table-cell" id="usedData"><?=htmlentities($user['country'])?></td>
					
						<td class="d-none d-xl-table-cell"id="userData"><?=htmlentities($user['register_date'])?></td>
						<td>
							<form action="updateuser.php" method="GET">
								<input type="hidden" name="id" value="<?=$user['id']?>">
								<input type="submit" class="btn btn-success"name="updateUserBtn" value="Uppdatera">
							</form>
						</td>
						<td>
							<form action="" method="POST">
								<input type="hidden" name="deleteUserId" value="<?=$user['id']?>">
								<input type="submit" class="btn btn-danger" name="deleteUserBtn" value="Delete">
							</form>
						</td>
						
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	</div>
</div>


 <?php include('layout/footer.php');?>	
 
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>