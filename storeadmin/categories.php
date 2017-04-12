<?php 
require $_SERVER['DOCUMENT_ROOT'].'/ShopKart/storescripts/connect_to_mysql.php';
?>
<?php include 'includes/head.php' ;
	  include 'includes/nav.php' ;

		$sql = "SELECT * FROM categories WHERE parent = 0";
		$result = mysqli_query($con,$sql);
		$errors  = array();
		$category = '';
		$post_parent='';
		 //edit branch
		if(isset($_GET['edit']) && !empty($_GET['edit'])){
	  	$edit_id = (int)$_GET['edit'];
	  	$edit_id = sanitize($edit_id);

	  	$sql4 = "SELECT * FROM categories WHERE id = '$edit_id'";
	  	$result4 = mysqli_query($con,$sql4);
	  	$category = mysqli_fetch_assoc($result4);
	  	}
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
	  	$post_parent = sanitize($_POST['parent']);
	  	$category = sanitize($_POST['category']);
	  	$sql3 = "SELECT * FROM categories WHERE category = '$category' AND parent='$post_parent'";
		if(isset($_GET['edit'])){
			$id = $category1['id'];
			$sql3 = "SELECT * FROM categories WHERE category = '$category' AND parent='$post_parent' AND id!='$id'";
		}
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
	  	$sql5 = "INSERT INTO categories (category,parent) VALUES ('$category','$post_parent')";
	  	if(isset($_GET['edit'])){
	  		$sql5 = "UPDATE categories SET category='$category' ,parent='$post_parent' WHERE id='$edit_id'";
	  	}
		$result5 = mysqli_query($con,$sql5);
		header('Location:categories.php');
	  }
	  }
	  $category_value = '';
	  $parent_value = '0';
	  if(isset($_GET['edit'])){
	  	$category_value = $category['category'];
	  	$parent_value = $category['parent'];
	  }else{
	  	if(isset($_POST['edit'])){
	  	$category_value = $category;
	  	$parent_value = $post_parent;
	  }
	  }
?>
<h2 class="text-center">Categories</h2><hr>
<div class="row">
	<div class="col-md-6">
	<!--form -->
	<form class="form" action="categories.php<?php echo ((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" method="post">
		<div class="form-group">
			<legend><?=((isset($_GET['edit']))?'Edit a ':'Add a ');?>Category</legend>
			<div id="errors"></div>
			<label for="parent">Parent</label>
			<select class="form-control" name="parent" id ="parent">
				<option value="0" <?=(($parent_value == 0)?'selected="selected"':'');?>>Parent</option>
				<?php while($parent = mysqli_fetch_assoc($result)): ?>
					<option value="<?=$parent['id'];?>" <?=(($parent_value == $parent['id'])?'selected="selected"':'');?>><?= $parent['category']; ?></option>
				<?php endwhile; ?>
			</select>
		<div class="form-group">
			<label for="category">Category</label>
			<input type="text" class="form-control" name="category" value="<?= $category_value ?>" id ="category">
		</div>
			<input type="submit" name="add_submit" value="<?=((isset($_GET['edit']))?'Edit a ':'Add a ');?>category" class="btn btn-lg btn-success">
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