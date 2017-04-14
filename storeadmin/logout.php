<?php
	require $_SERVER['DOCUMENT_ROOT'].'/ShopKart/storescripts/connect_to_mysql.php';
	unset($_SESSION['SBUser']);
	header('Location:login.php');
?>