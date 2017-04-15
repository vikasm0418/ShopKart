<?php

require "connect_to_mysql.php";  

$sqlCommand = "CREATE TABLE products (
		 		 id int(11) NOT NULL auto_increment,
		 		 title text NOT NULL,
		 		 price varchar(16) NOT NULL,
		 		 brand int(11) NOT NULL,
		 		 categories int(11) NOT NULL,
		 		 image LONGBLOB NOT NULL,
		 		 description text NOT NULL,
		 		 featured int(11) NOT NULL,
		 		 size varchar(16) NOT NULL,
		 		 color varchar(16),
		 		 img2 LONGBLOB,
		 		 img3 LONGBLOB,
		 		 deleted int(11) NOT NULL,
				 product_name varchar(255) NOT NULL,
		 		 PRIMARY KEY (id),
		 		 FOREIGN KEY(brand)
      			REFERENCES brand(id) ON DELETE CASCADE,
      		    FOREIGN KEY(categories)
      			REFERENCES categories(id) ON DELETE CASCADE,
		 		 ) ";
if (mysql_query($sqlCommand)){ 
    echo "Your products table has been created successfully!"; 
} else { 
    echo "CRITICAL ERROR: products table has not been created.";
}
?>

