<?php 
	
	$csql1 = "SELECT * FROM categories WHERE parent = 0";
	$categ1 = mysqli_query($con,$csql1);
?>
<div class="product">
			<div class="container">
				<div class="col-md-3 product-price">
					  
				<div class=" rsidebar span_1_of_left">
					<div class="of-left">
						<h3 class="cate">Categories</h3>
					</div>
		<ul class="menu">
		 	<?php while($parent1 = mysqli_fetch_assoc($categ1)) : ?>
		 	<?php 
				$parentID1 = $parent1['id'];
				$ssql1 = "SELECT * FROM categories WHERE parent = '$parentID1'";
				$sub_categ1 = mysqli_query($con,$ssql1);
		 	?>
			<li class="item1"><a href="#"><?= $parent1['category']; ?> </a>
				<ul class="cute">
					<?php while($child1 = mysqli_fetch_assoc($sub_categ1)) : ?>
					<li class="subitem1"><a href="products.php?cat=<?= $child1['id']; ?>"><?= $child1['category']; ?></a></li>
					<?php endwhile; ?>
				</ul>
			</li>
			<?php endwhile; ?>
		</ul>
				</div>
				<!--initiate accordion-->
		<script type="text/javascript">
			$(function() {
			    var menu_ul = $('.menu > li > ul'),
			           menu_a  = $('.menu > li > a');
			    menu_ul.hide();
			    menu_a.click(function(e) {
			        e.preventDefault();
			        if(!$(this).hasClass('active')) {
			            menu_a.removeClass('active');
			            menu_ul.filter(':visible').slideUp('normal');
			            $(this).addClass('active').next().stop(true,true).slideDown('normal');
			        } else {
			            $(this).removeClass('active');
			            $(this).next().stop(true,true).slideUp('normal');
			        }
			    });
			
			});
		</script>
<!---->
	<div class="sellers">
							<div class="of-left-in">
								<h3 class="tag">Tags</h3>
							</div>
								<div class="tags">
									<ul>
										<li><a href="#">design</a></li>
										<li><a href="#">fashion</a></li>
										<li><a href="#">dress</a></li>
										
										<div class="clearfix"> </div>
									</ul>
								
								</div>
								
		</div>
				</div>