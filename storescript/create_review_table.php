<?php 
require "connect_to_mysql.php";  

$sqlCommand = "CREATE TABLE admin (
		 		 id int(11) NOT NULL auto_increment,
		 		 product_id int(11) NOT NULL auto_increment,
				 review text,
				 star int(11) ,
		 		 user varchar(24) NOT NULL,
		 		 PRIMARY KEY (id),
		 		 FOREIGN KEY(prodict_id)
      			REFERENCES products(id) ON DELETE CASCADE,
		 		 ) ";
if (mysql_query($sqlCommand)){ 
    echo "Your review table has been created successfully!"; 
} else { 
    echo "CRITICAL ERROR: admin table has not been created.";
}
?>