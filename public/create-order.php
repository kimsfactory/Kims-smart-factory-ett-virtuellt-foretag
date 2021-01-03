<?php
require('../src/config.php');
require(SRC_PATH . 'dbconnect.php');

$pageTitle = "Create order";
$pageId = "create_order";

//echo "<pre>"
//print_r($_POST);
//echo "</pre>"
//exit;


if (isset($_POST['createOrderBtn'])) {
	$firstName = trim($_POST['firstName']);
	$lastName = trim($_POST['lastName']);
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	$phone = trim($_POST['phone']);
	$street = trim($_POST['street']);
	$city = trim($_POST['city']);
	$country = trim($_POST['country']);
	$postalCode = trim($_POST['postalCode']);
	$totalPrice = trim($_POST['cartTotalPrice']);


	$error = "";
	//error messages
    if (empty($firstName) || empty($lastName)) {
        $error .= "<li>Your names are missing.</li>";
    }
    if (empty($email)) {
        $error .= "<li>Your e-mail adress is missing.</li>";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error .= "<li>Your e-mail adress is not correct</li>";
    }
    if (empty($password)) {
        $error .= "<li>Your password is missing</li>";
    }
    if (!empty($password) && strlen($password) < 8) {
        $error .= "<li>Your password should be at least 8 characters long.</li>";
    }
    if (empty($phone)) {
        $error .= "<li>Your phone number is missing.</li>";
    }
    if (empty($street)) {
        $error .= "<li>Your street adress is missing.</li>";
    }
    if (empty($city)) {
        $error .= "<li>Your city is missing.</li>";
    }
    if (empty($country)) {
        $error .= "<li>Your country is missing.</li>";
    }
    if (empty($postal_code)) {
        $error .= "<li>Your postal code is missing.</li>";
    }


    if ($error) {
    	$_SESSION['msg'] = "<ul class='error_msg'>{$error}</ul>";
    	header('Location: checkout.php');
		exit;
	}

	//Check if user already exists in our DB
	$user = $OrderDbHandler->fetchByEmail($email);

	if ($user) {	//If user exists already in our DB
		$userId = $user['id'];
	} else {	//Else create new user, and fetch the newly created userId
		$userData = [
            'firstName'    => $firstName,
            'lastName'     => $lastName,
            'email'        => $email,
            'password'     => $password,
            'phone'        => $phone,
            'street'       => $street,
            'city'         => $city,
            'country'      => $country,
            'postalCode'   => $postalCode,
       	];
		$userId = $UserDbHandler->addAndFetch($userData);
	}

	//Create order
	$orderData = [
        'userId'       => $userId,
        'totalPrice'   => $totalPrice,
        'fullName'     => "{$firstName} {$lastName}",
        'postalCode'   => $postalCode,
        'street'       => $street,
        'city'         => $city,
        'country'      => $country,
    ];
	$orderId = $OrderDbHandler->addOrder($orderData);

	//Create ordereditems
	foreach ($_SESSION['cartItems'] as $cartId => $cartItem) {
		$OrderDbHandler->addOrderedItems();
	}

	header('Location: order-confirmation.php');
	exit;
}