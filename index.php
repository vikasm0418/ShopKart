<?php
	require 'storescripts/connect_to_mysql.php';
?>
<?php include 'includes/head.php' ;
	  include 'includes/nav.php' ;		
?>
<body>
<!--header-->


	<div class="banner">
		<div class="container">
			  <script src="js/responsiveslides.min.js"></script>
  <script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	nav: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
     //event listener for product details   
  </script>
			<div  id="top" class="callbacks_container">
			<ul class="rslides" id="slider">
			    <li>
					
						<div class="banner-text">
							<h3>Welcome to ShopKart  </h3>
						<p>We bring to you a vast ocean of products to dive in..</p>
						</div>
				</li>
				<li>
					
						<div class="banner-text">
							<h3>New Releases  </h3>
						<p>New products now just a click away</p>
						</div>
					
				</li>
				<li>
						<div class="banner-text">
							<h3>Most secured Payment Method</h3>
						<p>Our highest priority is users security and hence we use paypal- the most secured way for payment</p>
						</div>
					
				</li>
			</ul>
		</div>

	</div>
	</div>
<?php
	$sql = "SELECT * FROM products WHERE featured = 1";
	$featured = mysqli_query($con,$sql);
?>

<!--content-->
<div class="content">
	<div class="container">
	<div class="content-top">
		<h1>NEW RELEASED</h1>
		<div class="grid-in">
			<?php while($product = mysqli_fetch_assoc($featured)) : ?>
			<div class="col-md-4 grid-top" id="product" onclick="details(<?php echo $product["id"]; ?>)">
				<a href="single.php?id=<?php echo $product['id'] ?>" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="<?php echo $product["image"]; ?>" alt="">
							<div class="b-wrapper">
									<h3 class="b-animate b-from-left    b-delay03 ">
										<span><?php echo $product["title"]; ?></span>	
									</h3>
								</div>
				</a>
		

			<h1><a href="single.php"><?php echo $product["price"]; ?></a></h1>
			</div>
			<?php endwhile; ?>
					<div class="clearfix"> </div>
		</div>
	</div>
	<!----->
	
	<div class="content-top-bottom">
		<h2>Featured Collections</h2>
		<div class="col-md-6 men">
			<a href="single.php" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="images/t1.jpg" alt="">
				<div class="b-wrapper">
									<h3 class="b-animate b-from-top top-in   b-delay03 ">
										<span>Lorem</span>	
									</h3>
								</div>
			</a>
			
			
		</div>
		<div class="col-md-6">
			<div class="col-md1 ">
				<a href="single.php" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="images/t2.jpg" alt="">
					<div class="b-wrapper">
									<h3 class="b-animate b-from-top top-in1   b-delay03 ">
										<span>Lorem</span>	
									</h3>
								</div>
				</a>
				
			</div>
			<div class="col-md2">
				<div class="col-md-6 men1">
					<a href="single.php" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="images/t3.jpg" alt="">
							<div class="b-wrapper">
									<h3 class="b-animate b-from-top top-in2   b-delay03 ">
										<span>Lorem</span>	
									</h3>
								</div>
					</a>
					
				</div>
				<div class="col-md-6 men2">
					<a href="single.php" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="images/t4.jpg" alt="">
							<div class="b-wrapper">
									<h3 class="b-animate b-from-top top-in2   b-delay03 ">
										<span>Lorem</span>	
									</h3>
								</div>
					</a>
					
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
	</div>
	<!---->
	<div class="content-bottom">
		<ul>
			<li><a href="#"><img class="img-responsive" src="images/lo.png" alt=""></a></li>
			<li><a href="#"><img class="img-responsive" src="images/lo1.png" alt=""></a></li>
			<li><a href="#"><img class="img-responsive" src="images/lo2.png" alt=""></a></li>
			<li><a href="#"><img class="img-responsive" src="images/lo3.png" alt=""></a></li>
			<li><a href="#"><img class="img-responsive" src="images/lo4.png" alt=""></a></li>
			<li><a href="#"><img class="img-responsive" src="images/lo5.png" alt=""></a></li>
		<div class="clearfix"> </div>
		</ul>
	</div>
</div>
<?php include 'includes/foot.php' ;	?>
</body>
</html>
			