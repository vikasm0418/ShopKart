<?php
	require $_SERVER['DOCUMENT_ROOT'].'/ShopKart/storescripts/connect_to_mysql.php';
?>
<?php include 'includes/head.php' ;
	  include 'includes/nav.php' ;	
	  include 'category.php';
if(isset($_GET['add'])){
	$product_id = $_GET['add'];
}

?>
<body>
<div class="container">
	<div class="check">	 
			 <h1 class="text-center" style="font-size:50px">Add product to cart </h1>
		 <div class="col-md-12 cart-items">

			 <div class="cart-header">
				 <div class="close1"> </div>
				 <div class="cart-sec simpleCart_shelfItem">
						<div class="cart-item cyc">
							 <img src="images/pic1.jpg" class="img-responsive" alt=""/>
						</div>
					   <div class="cart-item-info">
						<h3><a href="#">Mountain Hopper(XS R034)</a><span>Model No: 3578</span></h3>
						<form action="cart.php?add=<?=$product_id ?>" method="POST">
						<ul class="qty">
							
							<li><p>Size :</p>
								<input type="text" name="size" id="size"></li>
							<li><p>Qty : </p>
								<input type="text" name="size" id="size">
							</li>
						</ul>
						</form>
							 <div class="delivery">
							 <p>Service Charges : Rs.100.00</p>
							 <span>Delivered in 2-3 bussiness days</span>
							 <div class="clearfix"></div>
				        </div>	
					   </div>
					   <div class="clearfix"></div>
											
				  </div>
			 </div>
	 </div>
	</div>
</div>
<?php include 'includes/foot.php' ;	?>
</body>
</html>
			