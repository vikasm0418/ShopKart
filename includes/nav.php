<?php 
	
	$csql = "SELECT * FROM categories WHERE parent = 0";
	$categ = mysqli_query($con,$csql);
?>
<div class="header">
	<div class="header-top">
		<div class="container">
			<div class="header-left">		
					<ul>
						<li ><a href="login.php"  >Login</a></li>
						<li><a  href="register.php"  >Register</a></li>
					</ul>
					<div class="cart box_1">
						<a href="checkout.php">
						<h3> <div class="total">
							<span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simplCart_quantity"></span> items)</div>
							<img src="images/cart.png" alt=""/></h3>
						</a>
					</div>
					<div class="clearfix"> </div>
			</div>
				<div class="clearfix"> </div>
		</div>
		</div>
		<div class="container">
			<div class="head-top">
				<div class="logo">
					<a href="index.php"><img src="images/logo.png" alt="" width="150px"></a>	
				</div>
		  <div class=" h_menu4">
				<ul class="memenu skyblue">
				<li class="active grid"><a class="color8" href="index.php">Home</a></li>
				<?php while($parent = mysqli_fetch_assoc($categ)) : ?>
				  <?php 
				  	$parentID = $parent['id'];
				  	$ssql = "SELECT * FROM categories WHERE parent = '$parentID'";
					$sub_categ = mysqli_query($con,$ssql);
				  ?> 	
				      <li><a class="color1" style="position:initial" href="#"><?= $parent['category']; ?></a>
				      	<div class="mepanel"  >
						<div class="row">
							<div class="col1" >
								<div class="h_nav" >
									<ul>
									<?php while($child = mysqli_fetch_assoc($sub_categ)) : ?>
										<li ><a href="products.php?cat=<?= $child['id']; ?>"><?= $child['category']; ?></a></li>
									<?php endwhile; ?>
									</ul>	
								</div>							
							</div>
						  </div>
						</div>
					  </li>
				<?php endwhile; ?>
				<li><a class="color4" href="products.php">Products</a></li>				
			  </ul> 
			</div>
				
				<div class="clearfix"> </div>
		</div>
		</div>

	</div>