<?php
$db_host = "127.0.0.1";
$db_username = "root";
$db_pass = "messi10";
$db_name="ShopKart";

$con = mysqli_connect($db_host,$db_username,$db_pass,$db_name) or die("could not connect to mysql");
mysqli_select_db($con,$db_name) or die ("no databse");
require '../config.php';
require '../helpers/helpers.php';
?>