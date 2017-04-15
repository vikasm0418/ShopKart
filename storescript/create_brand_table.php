<?php
require "connect_to_mysql.php";  

$sqlCommand = "CREATE TABLE products (
		 		 id int(11) NOT NULL auto_increment,
				 brand varchar(255) NOT NULL,
		 		 model text NOT NULL,
		 		 PRIMARY KEY (id)
		 		 ) ";
if (mysql_query($sqlCommand)){ 
    echo "Your brand table has been created successfully!"; 
} else { 
    echo "CRITICAL ERROR: products table has not been created.";
}
?>