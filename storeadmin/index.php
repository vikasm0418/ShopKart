<?php
	require $_SERVER['DOCUMENT_ROOT'].'/ShopKart/storescripts/connect_to_mysql.php';
?>
<?php include 'includes/head.php' ;
	  include 'includes/nav.php' ;
	  if(!is_logged_in()){
	  	header('Location:login.php');
	  }
	 
?>
<body>
	<h1>Administrator Home</h1><br>
<?php include 'includes/foot.php' ;	?>

</body>
</html>