<?php 
require $_SERVER['DOCUMENT_ROOT'].'/ShopKart/storescripts/connect_to_mysql.php';
?>
<?php include 'includes/head.php' ;
	  include 'includes/nav.php' ;

	  $productID ;
	  if(isset($_GET['id'])){
	  	$productID = $_GET['id'];
	  }
	  $errors = array();
	  if(isset($_POST['submit'])){
	  	$user = sanitize($_POST['name']);
	  	$review = sanitize($_POST['review']);
	  	$stars = sanitize($_POST['stars']);

	  	if($_POST['name'] == ''){
	  		$errors[] .= "YOU MUST ENTER Your Name!";
	  	}
	  	if(!($_POST['stars'] < 5) || !($_POST['stars'] > 0)){
	  		$errors[] .= "You Must Give Valid Stars!";
	  	}
	  	//display errors
	  	if(!empty($errors)){
	  		echo display_errors($errors);
	  	}else{
	  		//Add brand to database
	  		$productID = $_GET['id'];
	  		$rsql = "INSERT INTO review (product_id,review,stars,user) VALUES ('$productID','$review','$stars','$user')";
	  		$rresult = mysqli_query($con,$rsql);
	  		header('Location:index.php');
	  	}
	  }		
?>
<body>
<!--content-->
<div class="contact">
			
	<div class="container">
		<h1>Add Review</h1>
	<div class="contact-form">
		
		<div class="col-md-8 contact-grid">
			<form action="review.php?id=<?=$_GET['id'] ?>" method="POST">
				<label for="name">User:</label>	
				<input type="text" name="name" placeholder="Name"><br><br>
				<label for="stars">Stars:</label>
		      		<input type="number" name="stars" id="stars" value="" ><br><br>
		      	<label for="review">Review:</label>
				<textarea cols="77" name="review" rows="6" placeholder="Add Review Here"></textarea>
				<div class="send">
					<input type="submit" id="submit" name="submit" value="Submit">
				</div>
			</form>
		</div>
		<div class="col-md-4">
		</div>
	<div class="clearfix"> </div>
	</div>
	</div>
		
</div>
<?php include 'includes/foot.php' ;	?>
</body>
</html>
			