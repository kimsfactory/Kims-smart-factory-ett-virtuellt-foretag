<?php
// Turn on/off error reporting
error_reporting(-1);

// Start session
session_start();

define('ROOT_PATH', '..' . __DIR__ . '/'); // path to 'my-page-3/'
define('SRC_PATH',  __DIR__ . '/'); // path to 'my-page-3/src/'

// Include functions and classes
require('app/commonFunction.php');
require('app/userFunctions.php');
require('app/ProductDbHandler.php');
require('app/UserDbHandler.php');
require('app/OrderDbHandler.php');


$ProductHandler = new ProductDbHandler();
$UserDbHandler = new UserDbHandler();
$OrderDbHandler = new OrderDbHandler();


