<?php 
require $_SERVER['DOCUMENT_ROOT'].'/ShopKart/storescripts/connect_to_mysql.php';
?>
<?php include 'includes/head.php' ;
	  include 'includes/nav.php' ;

		$sql = "SELECT * FROM categories WHERE parent = 0";
		$result = mysqli_query($con,$sql);
		 $errors  = array();
		 //edit branch

		 //delete categories
		if(isset($_GET['delete']) && !empty($_GET['delete'])){
		$delete_id = (int)$_GET['delete'];
	  	$delete_id = sanitize($delete_id);

	  	$sql8 = "SELECT * FROM categories WHERE id='$delete_id'";
	  	$result8 = mysqli_query($con,$sql8);
	  	$category1 = mysqli_fetch_assoc($result8);
	  	if($category1['parent'] == 0){
	  		$sql7 = "DELETE FROM categories WHERE parent='$delete_id'";
	  		$result7 = mysqli_query($con,$sql7);
	  	}
	  	$sql6 = "DELETE FROM categories WHERE id = '$delete_id'";
	  	$result6 = mysqli_query($con,$sql6);
	  	header('Location:categories.php');
	 	 }

		//process form
		if(isset($_POST) && !empty($_POST)){;
	  	$parent = sanitize($_POST['parent']);
	  	$category = sanitize($_POST['category']);
	  	$sql3 = "SELECT * FROM categories WHERE category = '$category' AND parent='$parent'";
		$result3 = mysqli_query($con,$sql3);
		$count = mysqli_num_rows($result3);

	  	//if category is empty
	  	if($category == ''){
	  		$errors[] .= "category cannot be left blank.";
	  	}
	  	if($count>0){
	  		$errors[] .= $category.' Already Exists';
	  	}
	  //display errors
	  if(!empty($errors)){
	  	$display = display_errors($errors);?>
	  <script>
	  jQuery('document').ready(function(){
	  	jQuery('#errors').html('<?=$display;?>');
	  });
	  </script>
	  <?php }else
	  {
	  	//update database
	  	$sql5 = "INSERT INTO categories (category,parent) VALUES ('$category','$parent')";
		$result5 = mysqli_query($con,$sql5);
		header('Location:categories.php');
	  }
	  }
?>
<h2 class="text-center">Categories</h2><hr>
<div class="row">
	<div class="col-md-6">
	<!--form -->
	<form class="form" action="categories.php" method="post">
		<div class="form-group">
			<legend>Add a Category</legend>
			<div id="errors"></div>
			<label for="parent">Parent</label>
			<select class="form-control" name="parent" id ="parent">
				<option value="0">Parent</option>
				<?php while($parent = mysqli_fetch_assoc($result)): ?>
					<option value="<?=$parent['id'];?>"><?= $parent['category']; ?></option>
				<?php endwhile; ?>
			</select>
		<div class="form-group">
			<label for="category">Category</label>
			<input type="text" class="form-control" name="category" id ="category">
		</div>
			<input type="submit" name="add_submit" value="Add category" class="btn btn-lg btn-success">
		</div>
	</form><hr><br>
	</div>
	<div class="col-md-6">
	<table class="table table-bordered">
	<thead>
		<th>Category</th><th>Parent</th><th></th>
	</thead>
	<tbody>
		<?php 
		$sql4 = "SELECT * FROM categories WHERE parent = '0'";
		$result4 = mysqli_query($con,$sql4);
		while($parent = mysqli_fetch_assoc($result4)) : 
		$parent_id = (int)$parent['id'];
		$sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
		$result2 = mysqli_query($con,$sql2);
		?>
		<tr class="bg-primary">
			<td><?php echo $parent['category']; ?></td>
			<td>Parent</td>
			<td>
				<a href="categories.php?edit=<?php echo $parent['id']; ?>" class="btn btn-xs btn-default"><img src="../images/edit.png" alt="" width="20px"></a>
				<a href="categories.php?delete=<?php echo $parent['id']; ?>" class="btn btn-xs btn-default"><img src="../images/del.png" alt="" width="20px"></a>
			</td>
		</tr>
		<?php while($child = mysqli_fetch_assoc($result2)): ?>
		<tr class="bg-info">
			<td><?php echo $child['category'] ?></td>
			<td><?php echo $parent['category'] ?></td>
			<td>
				<a href="categories.php?edit=<?php echo $child['id']; ?>" class="btn btn-xs btn-default"><img src="../images/edit.png" alt="" width="20px"></a>
				<a href="categories.php?delete=<?php echo $child['id']; ?>" class="btn btn-xs btn-default"><img src="../images/del.png" alt="" width="20px"></a>
			</td>
		</tr>
		<?php endwhile; ?>
	<?php endwhile; ?>
	</tbody>
</table>
</div>
</div>
<?php include 'include/foot.php'; ?>