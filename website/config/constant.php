<?php
//start session
session_start();
define('SITEURL','http://localhost/HANDSCRAFT/website/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define("DB_DATABASE","handscrafts-order");
$conn= mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
$db_select=mysqli_select_db($conn,'handscrafts-order');
?>