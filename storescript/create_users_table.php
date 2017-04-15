<?php
require "connect_to_mysql.php";  

$sqlCommand = "CREATE TABLE admin (
		 		 id int(11) NOT NULL auto_increment,
				 full_name varchar(24) NOT NULL,
		 		 password varchar(24) NOT NULL,
		 		 join_date date NOT NULL,
		 		 last_login date NOT NULL,
		 		 permissions text,
		 		 PRIMARY KEY (id),
		 		 ) ";
if (mysql_query($sqlCommand)){ 
    echo "Your users table has been created successfully!"; 
} else { 
    echo "CRITICAL ERROR: admin table has not been created.";
}
?>