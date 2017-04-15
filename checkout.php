<?php
	require $_SERVER['DOCUMENT_ROOT'].'/ShopKart/storescripts/connect_to_mysql.php';
?>
<?php include 'includes/head.php' ;
	  include 'includes/nav.php' ;	
	  include 'category.php';

	  if(isset($_GET['del']))
	  {
	  	$product_id = $_GET['del'];
	  	$product1 = "UPDATE cart SET deleted = 1 WHERE product_id = '$product_id'";
	  	$del_result = mysqli_query($con,$product1);
	  	header('Location:checkout.php');
	  }
	  $sql = "SELECT * FROM cart WHERE deleted=0";
	  $result = mysqli_query($con,$sql);
?>
<body>
<div class="container">
	<div class="check">	 
			 <h1>Products in your cart </h1>
		 <div class="col-md-9 cart-items">
			
				<script>$(document).ready(function(c) {
					$('.close1').on('click', function(c){
						$('.cart-header').fadeOut('slow', function(c){
							$('.cart-header').remove();
						});
						});	  
					});
			   </script>

			  <?php while($cart_products = mysqli_fetch_assoc($result)) : ?> 

			  <?php 
			  $product_id = $cart_products['product_id']; 
			  $p_sql ="SELECT * FROM products WHERE id='$product_id'";
			  $p_result = mysqli_query($con,$p_sql);
			  $product = mysqli_fetch_assoc($p_result);
			  $sum += $product['price'];
			   ?>
			 <div class="cart-header">
				 <a href="checkout.php?del=<?php echo $product["id"]; ?>" class="btn btn-xs btn-default "><img src="images/del.png" alt="" width="20px"></a>
				 
				 
				 <div class="cart-sec simpleCart_shelfItem">
						<div class="cart-item cyc">
							 <img src="<?= $product['image'] ?>" class="img-responsive" alt=""/>
						</div>
					   <div class="cart-item-info">
						<h3><a href="#"><?= $product['title'] ?></a><span><?= $product['price'] ?></span></h3>
						<ul class="qty">
							<li><p>Size : S</p></li>
							<li><p>Qty : 1</p></li>
						</ul>
						
							 <div class="delivery">
							 <p>Service Charges : Rs.100.00</p>
							 <span>Delivered in 2-3 bussiness days</span>
							 <div class="clearfix"></div>
				        </div>	
					   </div>

					   <div class="clearfix"></div>
					
											
				  </div>

			 </div>
			 <?php endwhile; ?>	
			</div>
		  <div class="col-md-3 cart-total">
			 <a class="continue" href="index.php">Continue to basket</a>
			 <div class="price-details">
				 <h3>Price Details</h3>
				 <span>Total</span>
				 <span class="total1"><?= $sum ?> RS</span>
				 <span>Discount</span>
				 <span class="total1">---</span>
				 <span>Delivery Charges</span>
				 <span class="total1">150.00</span>
				 <div class="clearfix"></div>				 
			 </div>	
			 <ul class="total_price">
			   <li class="last_price"> <h4>TOTAL</h4></li>	
			   <li class="last_price"><span><?= $sum +150 ?></span></li>
			   <div class="clearfix"> </div>
			 </ul>
			
			 
			 <div class="clearfix"></div>
			 <a class="order" href="complete.php?sum=<?= $sum ?>">Place Order</a>
			 <div class="total-item">
				 <h3>OPTIONS</h3>
				 <h4>COUPONS</h4>
				 <a class="cpns" href="#">Apply Coupons</a>
				 <p><a href="#">Log In</a> to use accounts - linked coupons</p>
			 </div>
			</div>
		
			<div class="clearfix"> </div>
	 </div>
	 </div>
<?php include 'includes/foot.php' ;	?>
</body>
</html>
			