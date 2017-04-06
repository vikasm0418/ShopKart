<?php
	require '../storescripts/connect_to_mysql.php';
?>
<?php include 'includes/head.php' ;
	  include 'includes/nav.php' ;
	  
	  //get brands from database
	  $sql = "SELECT * FROM brand ORDER BY brand";
	  $result = mysqli_query($con,$sql);
	  $errors  = array();

	  //if add form submitted
	  if(isset($_POST['add_submit'])){
	  	$brand = sanitize($_POST['brand']);
	  	$model = sanitize($_POST['model']);
	  	if($_POST['brand'] == ''){
	  		$errors[] .= "YOU MUST ENTER A BRAND!";
	  	}
	  	//check if brand already exists in database
	  	$sql1 = "SELECT * FROM brand WHERE brand = '$brand'";
	  	$result1 = mysqli_query($con,$sql1);
	  	$count = mysqli_num_rows($result1);
	  	if($count>0){
	  		$errors[] .= 'That Brand Already Exists';
	  	}
	  	//display errors
	  	if(!empty($errors)){
	  		echo display_errors($errors);
	  	}else{
	  		//Add brand to database
	  		$sql2 = "INSERT INTO brand (brand,model) VALUES ('$brand','$model')";
	  		$result2 = mysqli_query($con,$sql2);
	  		header('Location:brands.php');
	  	}
	  }
?>
<body>
<h2 class="text-center">Brands</h2><hr>
<!--Brand From -->
<div class="text-center">
	<form class="form-inline" action="brands.php" method="post">
		<div class="form-group">
			<label for="brand">Add a Brand:</label>
			<input type ="text" name="brand" id="brand" class="form-control" value="<?php echo ((isset($_POST['brand']))?$_POST['brand']:''); ?>">
			<label for="brand">Model:</label>
			<input type ="text" name="model" id="model" class="form-control" value="<?php echo ((isset($_POST['model']))?$_POST['model']:''); ?>">
			<input type="submit" name="add_submit" value="Add Brand" class="btn btn-lg btn-success">
		</div>
	</form><hr><br>
</div>
<table class="table table-bordered table-striped table-auto" style="width:auto;margin:0 auto">
	<thead>
		<th></th><th>Brand</th><th>Model</th><th></th>
	</thead>
	<tbody>
	<?php while($brands = mysqli_fetch_assoc($result)) : ?>
		<tr>

			<td><a href="brands.php?edit=<?php echo $brands["id"]; ?>" class="btn btn-xs btn-default"><img src="../images/edit.png" alt="" width="20px"></a></td>
			<td><?php echo $brands["brand"]; ?></td>
			<td><?php echo $brands["model"]; ?></td>
			<td><a href="brands.php?delete=<?php echo $brands["id"]; ?>" class="btn btn-xs btn-default"><img src="../images/del.png" alt="" width="20px"></a></td>
		</tr>
	<?php endwhile; ?>
	</tbody>
</table><hr><br>
<?php include 'includes/foot.php' ;	?>
</body>
</html>
			