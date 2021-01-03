<?php 
require('../../src/dbconnect.php');
require('../../src/app/usersfunctions.php');
if (isset ($_POST['updateUserBtn'])){
	$firstName 		= trim($_POST["firstName"]);
	$lastName 		= trim($_POST["lastName"]);
	$email 			= trim($_POST["email"]);
	$passWord 		= trim($_POST["passWord"]);
	$verifyPassWord = trim($_POST["verifyPassWord"]);
	$phone 			= trim($_POST["phone"]);
	$street 		= trim($_POST["street"]);
	$postalcode 	= trim($_POST["postalcode"]);
	$city 			= trim($_POST["city"]);
	$country 		= trim($_POST["country"]);

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
			$result = updateUser($userData);
              if ($result) {
               	header('Location: users.php');
				exit;
            } else {
                $msg = '<div class="error_msg">Skapandet av användaren misslyckades. Var snäll och försök igen senare!</div>';
            }
        }
    }




$getSpecifiedUser = fetchUser();

echo "<pre>";
print_r($result);
echo "</pre>";
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/users.css">
</head>
<body>
	<div class="container-fluid">
	 <?php include('layout/headerdaniel.php'); ?>
	</div>
	<div class="text-center userheadlinediv" >
		<h1>Update user </h1>
		<hr>
	</div>
<?=$msg?>
	<div class="container sm">
		<form id="update-user-form" method="POST">
			<div class="row">
				<div class="col">
					<label>First name </label>

					<input name="firstName" class="form-control" id="update-first-name" type="text" value="<?=htmlentities($getSpecifiedUser['first_name'])?>">
				</div>
			</div>
			<div class="row">
				<div class="col">
					<label>Last name </label>
					<input name="lastName" class="form-control" id="update-last-name" type="text" placeholder="last name" value="<?=htmlentities($getSpecifiedUser['last_name'])?>"> 
				</div>
			</div>

			<div class="row">
				<div class="col">
					<label>E-mail </label>
					<input name="email" class="form-control" id="update-email" type="text" placeholder="email" value="<?=htmlentities($getSpecifiedUser['email'])?>"> 
				</div>
			</div>
			<div class="row">
				<div class="col">
					<label>Password </label>
					<input name="passWord" class="form-control" id="update-password" type="password" placeholder="password" value="<?=htmlentities($getSpecifiedUser['password'])?>"> 
				</div>
			</div>
			<div class="row">
				<div class="col">
					<label>Phone number </label>

					<input name="phone" class="form-control" id="update-phone" type="text" placeholder="phone" value="<?=htmlentities($getSpecifiedUser['phone'])?>"> 
				</div>
			</div>
			<div class="row">
				<div class="col">
					<label>Street </label>

					<input name="street" class="form-control" id="update-street" type="text" placeholder="street" value="<?=htmlentities($getSpecifiedUser['street'])?>"> 
				</div>
			</div>
			<div class="row">
				<div class="col">
					<label>Postal code</label>

					<input name="postalcode" class="form-control" id="update-postalcode" type="text" placeholder="postalcode" value="<?=htmlentities($getSpecifiedUser['postal_code'])?>"> 
				</div>
			</div>
			<div class="row">
				<div class="col">
					<label>City </label>

					<input name="city" class="form-control" id="update-city" type="text" placeholder="city" value="<?=htmlentities($getSpecifiedUser['city'])?>"> 
				</div>
			</div>
			<div class="row">
				<div class="col">
					<label>Country </label>

					<input name="country" class="form-control" id="update-country" type="text" placeholder="country" value="<?=htmlentities($getSpecifiedUser['country'])?>"> 
				</div>
			</div>

			<input name="updateUserBtn" type="submit" class="btn btn-success" value="Update User"> 
			<button class="btn btn-success"> <a href="users.php"> Back </a> </button>

		</form>
	</div>

	
  <div class="footer">
  	<?php include('layout/footer.php');?>	
  </div>
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>