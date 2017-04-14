<div class="footer">
				<div class="container">
			<div class="footer-top-at">
			
				<div class="col-md-4 amet-sed">
				<h4>MORE INFO</h4>
				<ul class="nav-bottom">
						<li><a href="#">How to order</a></li>
						<li><a href="#">FAQ</a></li>
						<li><a href="contact.php">Location</a></li>
						<li><a href="#">Shipping</a></li>
						<li><a href="#">Membership</a></li>	
					</ul>	
				</div>
				<div class="col-md-4 amet-sed ">
				<h4>CONTACT US</h4>
				
					<p>
Contrary to popular belief</p>
					<p>Hall 5</p>
					<p>office:  +123456789</p>
					<ul class="social">
						<li><a href="#"><i> </i></a></li>						
						<li><a href="#"><i class="twitter"> </i></a></li>
						<li><a href="#"><i class="rss"> </i></a></li>
						<li><a href="#"><i class="gmail"> </i></a></li>
						
					</ul>
				</div>
				<div class="col-md-4 amet-sed">
					<h4>Newsletter</h4>
					<p>Sign Up to get all news update
and promo</p>
					<form>
						<input type="text" value="" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='';}">
						<input type="submit" value="Sign up">
					</form>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="footer-class">
		<p >© 2017 ShopKart All Rights Reserved</p>
		</div>
		</div>
<script>
function updateSizes(){
	var sizeString ='';
	for(var i=1;i<=12;i++){
		if(jQuery('#size'+i).val()!=''){
			sizeString += jQuery('#size'+i).val()+':'+jQuery('#qty'+i).val()+',';
		}
	}
	jQuery('#sizes').val(sizeString);
}

function get_child_options(){
	var parentID = jQuery('#parent').val();
	jQuery.ajax({
		url: '/ShopKart/storeadmin/parser/child_categories.php',
		type:'POST',
		data:{parentID:parentID},
		success:function(data){
			jQuery('#child').html(data);
		},
		error:function(){alert("Something went wrong with the child options.")},
	});
}
jQuery('select[name="parent"]').change(get_child_options);
</script>