<?php
require "connect_to_mysql.php";
$sql = "CREATE TABLE admin(
				id int(11) NOT NULL auto_increment PRIMARY KEY,
				username varchar(24) NOT NULL,
				password varchar(24) NOT NULL,
				last_log_date date NOT NULL,
				UNIQUE KEY username(username)
				)";

if(mysqli_query($con,$sql)){
	echo " admin Table created successfully!";
} else {
	echo "admin table not created";
}
?>
