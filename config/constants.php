<?php

//start session
session_start();
//config file for database
define('SITEURL','http://localhost/food-order/');
define('LOCALHOST','localhost');
define('USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');

$conn=mysqli_connect(LOCALHOST,USERNAME,DB_PASSWORD) or die(mysqli_error());//Database connection
$db_select=mysqli_select_db($conn,DB_NAME) or die(mysqli_error());//selecting database


?>