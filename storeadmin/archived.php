<?php
	require $_SERVER['DOCUMENT_ROOT'].'/ShopKart/storescripts/connect_to_mysql.php';
?>
<?php include 'includes/head.php' ;
	  include 'includes/nav.php' ;
	  
	  if(!is_logged_in()){
	  	login_error_redirect();
	  }

	  //get brands from database
	  $sql = "SELECT * FROM products WHERE deleted = 1";
	  $result = mysqli_query($con,$sql);

?>
<body>
	<h2 class="text-center">Deleted Products</h2>
	<table class="table table-bordered table-condensed table-striped">
		<thead><th>Product</th><th>Price</th><th>Category</th><th>Color</th><th>Brand</th><th>Featured</th><th>Deleted</th></thead>
		<tbody>
		<?php while($products = mysqli_fetch_assoc($result)) :
			$childID = $products['categories'];
			$brandID = $products['brand'];
			$bsql = "SELECT * FROM brand WHERE id='$brandID'";
			$bresult = mysqli_query($con,$bsql);
			$bbrand = mysqli_fetch_assoc($bresult);
			$brand = $bbrand['brand'];
			$catsql = "SELECT * FROM categories WHERE id='$childID'";
			$cresult = mysqli_query($con,$catsql);
			$cat = mysqli_fetch_assoc($cresult);
			$parentID = $cat['parent'];
			$psql = "SELECT * FROM categories WHERE id='$parentID'";
			$presult = mysqli_query($con,$psql);
			$parent=mysqli_fetch_assoc($presult);
			$category = $parent['category'].' -> '.$cat['category'];

		 ?>
		<tr>
			<td><?php echo $products["title"]; ?></td>
			<td><?php echo money($products["price"]); ?></td>
			<td><?php echo $category; ?></td>
			<td><?php echo $products["color"]; ?></td>
			<td><?php echo $brand ?></td>
			<td>0</td>
			<td>1</td>
		</tr>
		<?php  endwhile; ?>
		</tbody>
</table>
		<div class="clearfix" ></div>
<?php include 'includes/foot.php' ; ?>
</body>
</html>

			