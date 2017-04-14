<?php
	require $_SERVER['DOCUMENT_ROOT'].'/ShopKart/storescripts/connect_to_mysql.php';
?>
<?php include 'includes/head.php' ;
	  include 'includes/nav.php' ;
	  
	  if(!is_logged_in()){
	  	login_error_redirect();
	  }
	  
	  //get brands from database
	  $sql = "SELECT * FROM brand ORDER BY brand";
	  $result = mysqli_query($con,$sql);
	  $errors  = array();

	  //edit brand
	 if(isset($_GET['edit']) && !empty($_GET['edit'])){
	  	$edit_id = (int)$_GET['edit'];
	  	$edit_id = sanitize($edit_id);

	  	$sql4 = "SELECT * FROM brand WHERE id = '$edit_id'";
	  	$result4 = mysqli_query($con,$sql4);
	  	$e_brand = mysqli_fetch_assoc($result4);
	  } 

	  //Delete brand
	  if(isset($_GET['delete']) && !empty($_GET['delete'])){
	  	$delete_id = (int)$_GET['delete'];
	  	$delete_id = sanitize($delete_id);

	  	$sql3 = "DELETE FROM brand WHERE id = '$delete_id'";
	  	$result3 = mysqli_query($con,$sql3);
	  	header('Location:brands.php');	
	  }
	  //if add form submitted
	  if(isset($_POST['add_submit'])){
	  	$brand = sanitize($_POST['brand']);
	  	$model = sanitize($_POST['model']);
	  	if($_POST['brand'] == ''){
	  		$errors[] .= "YOU MUST ENTER A BRAND!";
	  	}
	  	//check if brand already exists in database
	  	$sql1 = "SELECT * FROM brand WHERE brand = '$brand'";
	  	if(isset($_GET['edit'])){
	  		$sql1 = "SELECT * FROM brand WHERE brand = '$brand' and model='$model' AND id != 'edit_id'";
	  	}
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
	  		if(isset($_GET['edit'])){
	  		$sql2 = "UPDATE brand SET brand = '$brand',model='$model' WHERE id='$edit_id'";
	  		}
	  		$result2 = mysqli_query($con,$sql2);
	  		header('Location:brands.php');
	  	}
	  }
?>
<body>
<h2 class="text-center">Brands</h2><hr>
<!--Brand From -->
<div class="text-center">
	<form class="form-inline" action="brands.php<?php echo ((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" method="post">
		<div class="form-group">
			<?php 
				if ((isset($_GET['edit']))) {
				$brand_value = $e_brand['brand'];
				$model_value = $e_brand['model'];
			}else{
				if((isset($_POST['brand']))){
					$brand_value = sanitize($_POST['brand']);
					$model_value = sanitize($_POST['model']);
				}
			} ?>
			<label for="brand"><?=((isset($_GET['edit']))?'Edit a':'Add a');?> Brand:</label>
			<input type ="text" name="brand" id="brand" class="form-control" value="<?php echo $brand_value; ?>">
			<label for="brand">Model:</label>
			<input type ="text" name="model" id="model" class="form-control" value="<?php echo $model_value; ?>">

			<?php if ((isset($_GET['edit']))) : ?>
				<a href="brands.php" class="btn btn-lg btn-default">Cancel</a>
			<?php endif; ?>
			<input type="submit" name="add_submit" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> Brand" class="btn btn-lg btn-success">
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
<?php include 'includes/foot.php' ; ?>
</body>
</html>

			