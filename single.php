<?php
	require 'storescripts/connect_to_mysql.php';
?>
<?php include 'includes/head.php' ;
	  include 'includes/nav.php' ;
	  if(isset($_GET['id'])){	
		  $product_id = $_GET['id'];
		}
	  if(isset($_GET['add'])){
	  	  $product_id = $_GET['add'];	
	  }	
	  if($_POST['submit']){

	  	//Add brand to database
	  	$csql = "INSERT INTO cart (user_id,paid,product_id) VALUES (3,0,'$product_id')";
	  	$cresult = mysqli_query($con,$csql);
	  	header('Location:index.php');
	  }	
?>

<body>
		<?php include 'includes/category.php'; ?>
<?php
	$sql = "SELECT * FROM products WHERE id = $product_id";
	$product_query = mysqli_query($con,$sql);
	$product = mysqli_fetch_assoc($product_query);
	$brand_id = $product['brand'];
	$sql1 ="SELECT * FROM brand WHERE id = $brand_id";
	$brand_query = mysqli_query($con,$sql1);
	$brand = mysqli_fetch_assoc($brand_query);
	$sizes = $product['sizes'];	
	$size_array = explode(',',$sizes);
	$color = $product['color'];
	$color_array = explode(',',$color);
	$r_sql = "SELECT * FROM review WHERE product_id = $product_id";
	$review_query = mysqli_query($con,$r_sql);
	$reviewCount = mysqli_num_rows($review_query);
	$squery = "SELECT * FROM seller WHERE product_id = '$product_id'";
	$seller_query = mysqli_query($con,$squery);
?>
<?php 
	
?>

	<div class="col-md-9 product-price1">
		<div class="col-md-5 single-top">		
		<div class="flexslider">
  <ul class="slides">
    <li data-thumb="<?php echo $product["image"]; ?>">
      <img src="<?php echo $product["image"]; ?>" />
    </li>
    <li data-thumb="<?php echo $product["img2"]; ?>">
      <img src="<?php echo $product["img2"]; ?>" />
    </li>
    <li data-thumb="<?php echo $product["img3"]; ?>">
      <img src="<?php echo $product["img3"]; ?>" />
    </li>
    <li data-thumb="<?php echo $product["image"]; ?>">
      <img src="<?php echo $product["image"]; ?>" />
    </li>
  </ul>
</div>
<!-- FlexSlider -->
  <script defer src="js/jquery.flexslider.js"></script>
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />

<script>
// Can also be used with $(document).ready()
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",
    controlNav: "thumbnails"
  });
});
</script>
					</div>	
					<div class="col-md-7 single-top-in simpleCart_shelfItem">
						<div class="single-para ">
						<h4><?php echo $product["title"]; ?></h4>
						<?php while ($review1 = mysqli_fetch_assoc($review_query)) : ?>
						<?php $sum += $review1['stars'];?>
						<?php endwhile; ?>
						<?php $avg = (intval($sum/$reviewCount ));?>
							<div class="star-on">
								<ul class="star-footer">
									<?php while($avg): ?>
									<?php $avg -= 1; ?>
									<li><a href="#"><i> </i></a></li>
									<?php endwhile; ?>
								</ul>
								<div class="review">
									<a href="#"> <?= $reviewCount ?> customer review </a>
									
								</div>
							<div class="clearfix"> </div>
							</div>
							
							<h5 class="item_price"><?php echo $product['price']; ?></h5>
							<form action="single.php?add=<?=$product_id?>"  method="POST"><form action="single.php?add=<?=$product_id?>"  method="POST">
							<div class="available">
								<ul>
									<li>Color<select>
									<?php foreach ($color_array as $key => $string) {								
									echo "<option>".$string."</option>";
								}?>
									</select></li>
							
								<li class="size-in" >Size<select>
									<?php foreach ($size_array as $key => $string) {
									$string_array = explode(':', $string);
									$size = $string_array[0];
									$quantity = $string_array[1];
								
									echo "<option>".$size." ( ".$quantity." available )</option>";
								}
									?>
								</select></li>
								<div class="clearfix"> </div>
							</ul>
						</div>
							<ul class="tag-men">
								<li><span>BRAND</span>
								<span class="women1"> : <?php echo $brand["brand"]; ?></span></li>
								<li><span>MODEL</span>
								<span class="women1"> : <?php echo $brand["model"]; ?> </span></li>
								<li><span>Seller</span><?php while($seller = mysqli_fetch_assoc($seller_query)) : ?>
								<span class="women1"> : <?php
															$userID = $seller['user_id'];
															$sname = "SELECT * FROM users WHERE id = '$userID'";
															$seller_name = mysqli_query($con,$sname);
															$user = mysqli_fetch_assoc($seller_name);
															echo $user['full_name'];
														?> </span>
															<?php endwhile; ?>
													</li>
								
							</ul>
							<?php
								if(isset($_GET['id'])){
							 		$product_id = $_GET['id'];
								 }
							 	?>
								
								<input class="btn btn-default" style="background-color:#f2680c;margin:5px 0px 5px 10px;padding:10px" type="submit" name="submit" value="ADD TO CART" >
								</form>
							
						</div>
					</div>
				<div class="clearfix"> </div>
			<!---->
					<div class="cd-tabs">
			<nav>
				<ul class="cd-tabs-navigation">
					<li><a data-content="fashion"  href="#0">Description </a></li>
					<li><a data-content="cinema" href="#0" >Addtional Informatioan</a></li>
					<li><a data-content="television" href="#0" class="selected ">Reviews (<?= $reviewCount ?>)</a></li>
					
				</ul> 
			</nav>
	<ul class="cd-tabs-content">
		<li data-content="fashion" >
		<div class="facts">
			<p ><?php echo $product["description"]; ?></p>         
		</div>

</li>
<li data-content="cinema" >
		<div class="facts1">
					
						<div class="color"><p>Color</p>
							<span ><?php foreach ($color_array as $key => $string) {								
									echo " ".$string." ";
								}?></span>
							<div class="clearfix"></div>
						</div>
						<div class="color">
							<p>Size</p>
							<span ><?php foreach ($size_array as $key => $string) {
									$string_array = explode(':', $string);
									$size = $string_array[0];
									$quantity = $string_array[1];
								
									echo " ".$size." ( ".$quantity." available ), ";
								}
									?></span>
							<div class="clearfix"></div>
						</div>
					        
			 </div>

</li>
<li data-content="television" class="selected">
	<div class="comments-top-top">
				$r_sql = "SELECT * FROM products WHERE product_id = $product_id";
					$review_query = mysqli_query($con,$r_sql);
					<?php while ($review = mysqli_fetch_assoc($review_query)) : ?>
				<div class="top-comment-left">
				<img class="img-responsive" src="images/co.png" alt="">
				</div>
				<div class="top-comment-right">
					<h6><a href="#"><?= $review['user'] ?></a> </h6>
					<ul class="star-footer">
							<?php while($review['stars']): ?>
							<?php $review['stars'] -= 1; ?>
								<li><a href="#"><i> </i></a></li>
							<?php endwhile; ?>			
					</ul>
					<p><?= $review['review'] ?></p>
				</div>
				<?php endwhile; ?>
				<div class="clearfix"> </div>
				<a class="add-re" href="review.php?id=<?= $product['id'] ?>">ADD REVIEW</a>
			</div>

</li>
<div class="clearfix"></div>
	</ul> 
</div> 
		<div class=" bottom-product">
					<div class="col-md-4 bottom-cd simpleCart_shelfItem">
						<div class="product-at ">
							<a href="#"><img class="img-responsive" src="images/pi3.jpg" alt="">
							<div class="pro-grid">
										<span class="buy-in">Buy Now</span>
							</div>
						</a>	
						</div>
						<p class="tun">click to view</p>
						<a href="#" class="item_add"><p class="number item_price"><i> </i>$500.00</p></a>						
					</div>
					<div class="col-md-4 bottom-cd simpleCart_shelfItem">
						<div class="product-at ">
							<a href="#"><img class="img-responsive" src="images/pi1.jpg" alt="">
							<div class="pro-grid">
										<span class="buy-in">Buy Now</span>
							</div>
						</a>	
						</div>
						<p class="tun">click to view</p>
<a href="#" class="item_add"><p class="number item_price"><i> </i>$500.00</p></a>					</div>
					<div class="col-md-4 bottom-cd simpleCart_shelfItem">
						<div class="product-at ">
							<a href="#"><img class="img-responsive" src="images/pi4.jpg" alt="">
							<div class="pro-grid">
										<span class="buy-in">Buy Now</span>
							</div>
						</a>	
						</div>
						<p class="tun">click to view</p>
<a href="#" class="item_add"><p class="number item_price"><i> </i>$500.00</p></a>					</div>
					<div class="clearfix"> </div>
				</div>
</div>

		<div class="clearfix"> </div>
		</div>
		</div>
		<?php include 'includes/foot.php' ;	?>
</body>
</html>
			
