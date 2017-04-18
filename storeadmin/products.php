<?php
	require $_SERVER['DOCUMENT_ROOT'].'/ShopKart/storescripts/connect_to_mysql.php';
?>
<?php include 'includes/head.php' ;
	  include 'includes/nav.php' ;

	  //delete product
	  if(isset($_GET['delete'])){
	  	$d_id = sanitize($_GET['delete']);
	  	$dsql = "UPDATE products SET deleted = 1 WHERE id = '$d_id'";
	  	$dquery = mysqli_query($con,$dsql);
	  	header('Location:products.php');
	  }

	  if(isset($_GET['add'])){
	  	$sql2 = "SELECT * FROM brand ORDER BY brand";
	  	$brand_query = mysqli_query($con,$sql2);
	  	$sql3 = "SELECT * FROM categories WHERE parent=0 ORDER BY category";
	  	$parent_query = mysqli_query($con,$sql3);
	  	
	  if($_POST){
	  	$title = sanitize($_POST['title']);
	  	$brand = sanitize($_POST['brand']);
	  	$categories = sanitize($_POST['child']);
	  	$price = sanitize($_POST['price']);
	  	$description = sanitize($_POST['description']);
	  	$dbpath = '';
	  	$color = sanitize($_POST['color']);;
	  	$sizes = sanitize($_POST['sizes']);
	  	$required = array('title','price','brand','parent','sizes','child');
	  	$errors = array();
	  	foreach ($required as $key => $field) {
	  		if($_POST[$field]=='')
	  		{
	  			$errors[] = 'All Fileds with * are required!';
	  			break;
	  		}	
	  	}
	  	if(!empty($_FILES)){
	  		//validate photo
	  		
	  		$photo = $_FILES['photo'];
	  		
	  		$name = $photo['name'];
	  		$nameArray = explode('.', $name);
	  		$filename = $nameArray[0];
	  		$fileExt =$nameArray[1];
	  		$mime = explode('/', $photo['type']);
	  		$mimeType = $mime[0];
	  		$mimeExt = $mime[1];
	  		$tmpLoc = $photo['tmp_name'];
	  		$fileSize = $photo['size'];
	  		$allowed = array('png','jpg','jpeg','gif');
	  		$uploadName = md5(microtime()).'.'.$fileExt;
	  		$uploadLoc = BASEURL.'/images'.$uploadName;
	  		$dbpath = 'images/'.$uploadName;
	  		if ($mimeType !='image') {
	  			$errors[] = 'The File must be an image.';
	  		}
	  		if(!in_array($fileExt,$allowed)){
	  			$errors[] = 'The photo must be an png,jpg,jpeg or gif!';
	  		}
	  		if($fileExt != $mimeExt && ($mimeExt =='jpeg' && $fileExt != 'jpg')){
	  			$errors[] = 'File extension does not match the file.';
	  		}
	  		if($fileSize > 1000000){
	  		$errors[] ='The file must be under 15MB';
	  		}
	  		//image2
	  		$photo2 = $_FILES['photo2'];
	  		$name = $photo2['name'];
	  		$nameArray = explode('.', $name);
	  		$filename = $nameArray[0];
	  		$fileExt =$nameArray[1];
	  		$mime = explode('/', $photo2['type']);
	  		$mimeType = $mime[0];
	  		$mimeExt = $mime[1];
	  		$tmpLoc = $photo2['tmp_name'];
	  		$fileSize = $photo2['size'];
	  		$allowed = array('png','jpg','jpeg','gif');
	  		$uploadName = md5(microtime()).'.'.$fileExt;
	  		$uploadLoc = BASEURL.'/images'.$uploadName;
	  		$dbpath2 = 'images/'.$uploadName;
	  		if ($mimeType !='image') {
	  			$errors[] = 'The File must be an image.';
	  		}
	  		if(!in_array($fileExt,$allowed)){
	  			$errors[] = 'The photo must be an png,jpg,jpeg or gif!';
	  		}
	  		if($fileExt != $mimeExt && ($mimeExt =='jpeg' && $fileExt != 'jpg')){
	  			$errors[] = 'File extension does not match the file.';
	  		}
	  		if($fileSize > 1000000){
	  		$errors[] ='The file must be under 15MB';
	  		}
	  		//image 3
	  		$photo3 = $_FILES['photo3'];
	  		$name = $photo3['name'];
	  		$nameArray = explode('.', $name);
	  		$filename = $nameArray[0];
	  		$fileExt =$nameArray[1];
	  		$mime = explode('/', $photo3['type']);
	  		$mimeType = $mime[0];
	  		$mimeExt = $mime[1];
	  		$tmpLoc = $photo3['tmp_name'];
	  		$fileSize = $photo3['size'];
	  		$allowed = array('png','jpg','jpeg','gif');
	  		$uploadName = md5(microtime()).'.'.$fileExt;
	  		$uploadLoc = BASEURL.'/images'.$uploadName;
	  		$dbpath3 = 'images/'.$uploadName;
	  		if ($mimeType !='image') {
	  			$errors[] = 'The File must be an image.';
	  		}
	  		if(!in_array($fileExt,$allowed)){
	  			$errors[] = 'The photo must be an png,jpg,jpeg or gif!';
	  		}
	  		if($fileExt != $mimeExt && ($mimeExt =='jpeg' && $fileExt != 'jpg')){
	  			$errors[] = 'File extension does not match the file.';
	  		}
	  		if($fileSize > 1000000){
	  		$errors[] ='The file must be under 15MB';
	  		}
	  	}
	  	if(!empty($errors)){
	  		echo display_errors($errors);
	  	}else{
	  		//upload files and insert into database
	  		move_uploaded_file($tmpLoc, $uploadLoc);
	  		$insertSql = "INSERT INTO products (title,price,brand,categories,image,description,featured,sizes,img2,img3,color,deleted,seller) VALUES ('$title','$price','$brand','$categories','$dbpath','$description',0,'$sizes','$dbpath2','$dbpath3','$color',0,1)";
	  		$query = mysqli_query($con,$insertSql);
	  		header('Location:products.php');
	  	}
	  }
	  	?>
	  	<h2 class="text-center">ADD A New Product</h2><hr>
	  	<form action="products.php?add=1" method="POST" enctype="multipart/form-data">
	  		<div class="form-group col-md-3">
	  		<label for="title">Title*:</label>
	  		<input type="text" name="title" class="form-control" id="title" value="<?= ((isset($_POST['title']))?sanitize($_POST['title']):'');?>">
	  	</div>
	  	<div class="form-group col-md-3">
	  		<label for="brand">Brand*:</label>
	  		<select class="form-control" id="brand" name="brand">
	  			<option value="" <?= ((isset($_POST['brand']) && $_POST['brand']=='')?'selected' :'');?>></option>
	  			<?php while($brands =mysqli_fetch_assoc($brand_query)): ?>
	  			<option value="<?= $brands['id']; ?>"<?= ((isset($_POST['brand']) && $_POST['brand']==$brands['id'])?'selected' :'');?>><?=$brands['brand']?></option>
	  			<?php endwhile; ?>
	  		</select>
	  	</div>
	  	<div class="form-group col-md-3">
	  		<label for="parent">Parent Category*:</label>
	  		<select class="form-control" id="parent" name="parent">
	  			<option value="" <?= ((isset($_POST['parent']) && $_POST['parent']=='')?'selected' :'');?>></option>
	  			<?php while($parents = mysqli_fetch_assoc($parent_query)): ?>
	  			<option value="<?= $parents['id']; ?>"<?= ((isset($_POST['parent']) && $_POST['parent']==$parents['id'])?'selected' :'');?>><?=$parents['category']?></option>
	  			<?php endwhile; ?>
	  		</select>
	  	</div>
	  	<div class="form-group col-md-3">
	  		<label for="child">Child Category*:</label>
	  		<select class="form-control" id="child" name="child">
	  		</select>
	  	</div>
	  	<div class="form-group col-md-3">
	  		<label for="price">Price*:</label>
	  		<input type="text" class="form-control" id="price" name="price" value="<?=((isset($_POST['price']))?$_POST['price']:'');?>">
	  		</input>
	  	</div>
	  	<div class="form-group col-md-3">
	  		<label>Quantity & Sizes*</label>
	  		<button type="button" class="btn btn-default form-control" data-toggle="modal" data-target="#sizesModal" onclick="jQuery('#sizesModal').modal('toggle');return false">Quantity & Sizes</button>  
	  	</div>
	  	<div class="form-group col-md-3">
	  		<label for="sizes">Sizes & Qty Preview</label>
	  		<input type="text" name="sizes" id="sizes" value="<?=((isset($_POST['sizes']))?$_POST['sizes']:''); ?>" class="form-control" readonly></input>
	  	</div>
	  	<div class="form-group col-md-3">
	  		<label for="color">Color</label>
	  		<input type="text" name="color" id="color" value="<?=((isset($_POST['color']))?$_POST['color']:''); ?>" class="form-control"></input>
	  	</div>
	  	<div class="form-group col-md-4">
	  		<label for="photo">Product Photo1:</label>
	  		<input type="file" id="photo" name="photo" class="form-control">
	  	</div>
	  	<div class="form-group col-md-4">
	  		<label for="photo2">Product Photo2:</label>
	  		<input type="file" id="photo2" name="photo2" class="form-control">
	  	</div>
	  	<div class="form-group col-md-4">
	  		<label for="photo3">Product Photo3:</label>
	  		<input type="file" id="photo3" name="photo3" class="form-control">
	  	</div>
	  	<div class="form-group col-md-6">
	  		<label for="description">Description:</label>
	  		<textarea id="description" name="description" class="form-control" rows="6"><?=((isset($_POST['description']))?sanitize($_POST['description']):'');?></textarea>
	  	</div>
	  	<div class="form-group col-md-3" style="margin-top:50px;margin-bot:50px">
	  	<input style="padding:25px 0px 55px 0px;font-size:30px"type="submit" value="Add Product" class="form-control btn btn-success pull-right">
	  </div>
	  	</form>
	  	<!-- Modal -->
		<div class="modal fade " id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="sizesModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="sizesModalLabel">Size and Quantity</h4>
		      </div>
		      <div class="modal-body">
		      	<div class="container-fluid">
		        <?php for ($i=1; $i <=12 ; $i++): ?>
		        <div class="form-group col-md-4">
		        	<label for="size<?=$i; ?>">Size:</label>
		        	<input type="text" name="size<?=$i;?>" id="size<?=$i;?>" value="" class="form-control">
		        </div>
		        <div class="form-group col-md-2">
		        	<label for="qty<?=$i; ?>">Quantity:</label>
		        	<input type="number" name="qty<?=$i;?>" id="qty<?=$i;?>" value="" class="form-control">
		        </div>
		    	<?php endfor; ?>
		      </div>
		  </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sizesModal" onclick="updateSizes();jQuery('#sizesModal').modal('toggle');return false;">Save changes</button>
		      </div>
		    </div>
		  </div>
		</div>
	  	<?php }else{
	  $sql = "SELECT * FROM products WHERE deleted=0";
	  $result = mysqli_query($con,$sql);
	  if(isset($_GET['featured'])){
	  	$id = (int)$_GET['id'];
	  	$featured = (int)$_GET['featured'];
	  	$fsql = "UPDATE products SET featured = '$featured' WHERE id='$id'";
	  	$fresult = mysqli_query($con,$fsql);
	  	header('Location:products.php');
	  }
?>
<body>
	<h2 class="text-center">Products</h2>
	<a href="products.php?add=1" class="btn btn-success pull-right" id="add-product-btn" style="margin:0px 175px 0px 0px;padding:10px">Add Product</a><div class="clearfix"></div><hr>
	<table class="table table-bordered table-condensed table-striped">
		<thead><th></th><th>Product</th><th>Price</th><th>Category</th><th>Color</th><th>Brand</th><th>Featured</th><th>Sold</th></thead>
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
			<td><a href="products.php?edit=<?php echo $products["id"]; ?>" class="btn btn-xs btn-default"><img src="../images/edit.png" alt="" width="20px"></a><a href="products.php?delete=<?php echo $products["id"]; ?>" class="btn btn-xs btn-default"><img src="../images/del.png" alt="" width="20px"></a></td>
			<td><?php echo $products["title"]; ?></td>
			<td><?php echo money($products["price"]); ?></td>
			<td><?php echo $category; ?></td>
			<td><?php echo $products["color"]; ?></td>
			<td><?php echo $brand ?></td>
			<td><a href="products.php?featured=<?=(($products['featured'] == 0)?'1':'0');?>&id=<?= $products['id'];?>" class="btn btn-xs btn-default "><span class="glyphicon glyphicon-<?= (($products['featured']==1)?'minus':'plus');?>"></span></a>
				&nbsp <?=(($products['featured']==1)?'Featured Product':'');?>
			</td>
			<td>0</td>
		</tr>
		<?php  endwhile; ?>
		<?php } ?>
		</tbody>
</table>
		<div class="clearfix" ></div>
<?php include 'includes/foot.php' ; ?>
</body>
</html>
