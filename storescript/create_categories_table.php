<?php
require "connect_to_mysql.php";  

$sqlCommand = "CREATE TABLE products (
		 		 id int(11) NOT NULL auto_increment,
				 category varchar(16) NOT NULL,
				 parent int(11) NOT NULL,
		 		 PRIMARY KEY (id)
		 		 ) ";
if (mysql_query($sqlCommand)){ 
    echo "Your categories table has been created successfully!"; 
} else { 
    echo "CRITICAL ERROR: products table has not been created.";
}
?>