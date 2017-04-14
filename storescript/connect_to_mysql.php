<?php
$db_host = "127.0.0.1";
$db_username = "root";
$db_pass = "messi10";
$db_name="ShopKart";

$con = mysqli_connect($db_host,$db_username,$db_pass,$db_name) or die("could not connect to mysql");
mysqli_select_db($con,$db_name) or die ("no databse");

session_start();

require $_SERVER['DOCUMENT_ROOT'].'/ShopKart/config.php';
require BASEURL.'/helpers/helpers.php';

if(isset($_SESSION['SBUser'])){
	$userID = $_SESSION['SBUser'];
	$sql8 = "SELECT * FROM users WHERE id='$userID'";
	$result8 = mysqli_query($con,$sql8);
	$user_data = mysqli_fetch_assoc($result8);
	$fn = explode(' ',$user_data['full_name']);
	$user_data['first'] = $fn[0];
	$user_data['last'] = $fn[1];
}

if(isset($_SESSION['success_flash'])){
	echo '<div class="bg-success"><p class="text-success text-center">'.$_SESSION['success_flash'].'</p></div>';
	unset($_SESSION['success_flash']);
}
if(isset($_SESSION['error_flash'])){
	echo '<div class="bg-danger"><p class="text-danger text-center">'.$_SESSION['error_flash'].'</p></div>';
	unset($_SESSION['error_flash']);
}

?>