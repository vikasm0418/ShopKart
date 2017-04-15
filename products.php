<?php
	require 'storescripts/connect_to_mysql.php';
?>
<?php include 'includes/head.php' ;
	  include 'includes/nav.php' ;	
	  if(isset($_GET['cat'])){
	  	$categoryID = $_GET['cat'];
	  	$prod = "SELECT * FROM products WHERE categories='$categoryID'";
		$rprod = mysqli_query($con,$prod);
	  } else{
	  	$prod = "SELECT * FROM products";
		$rprod = mysqli_query($con,$prod);
	  }

?>		
<body>
<?php include 'includes/category.php' ?>
				<div class="col-md-9 product1">
				<div class=" bottom-product">
					<?php while($products = mysqli_fetch_assoc($rprod)) : ?>
					<div class="col-md-4 bottom-cd simpleCart_shelfItem">
						<div class="product-at ">
							<a href="single.php?id=<?= $products['id']; ?>"><img class="img-responsive" src="<?= $products['image']; ?>" alt="">
							<div class="pro-grid">
										<span class="buy-in">Buy Now</span>
							</div>
						</a>	
						</div>
						<p class="tun">click on img to view</p>
						<a href="#" class="item_add"><p class="number item_price"><i> </i><?= $parent1['price']; ?></p></a>						
					</div>
					<?php endwhile; ?>
					<div class="clearfix"> </div>
				</div>
				</div>
		<div class="clearfix"> </div>
		<nav class="in">
				  <ul class="pagination">
					<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
					<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
					<li><a href="#">2 <span class="sr-only"></span></a></li>
					<li><a href="#">3 <span class="sr-only"></span></a></li>
					<li><a href="#">4 <span class="sr-only"></span></a></li>
					<li><a href="#">5 <span class="sr-only"></span></a></li>
					 <li> <a href="#" aria-label="Next"><span aria-hidden="true">»</span> </a> </li>
				  </ul>
				</nav>
		</div>
		
		</div>
<?php include 'includes/foot.php' ;	?>
</body>
</html>
			