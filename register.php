<?php
	require 'storescripts/connect_to_mysql.php';
?>
<?php include 'includes/head.php' ;
	  include 'includes/nav.php' ;		
?>
<body>
<!--content-->
<div class=" container">
<div class=" register">
	<h1>Register</h1>
		  	  <form> 
				 <div class="col-md-6 register-top-grid">
					<h3>Personal infomation</h3>
					 <div>
						<span>First Name</span>
						<input type="text"> 
					 </div>
					 <div>
						<span>Last Name</span>
						<input type="text"> 
					 </div>
					 <div>
						 <span>Email Address</span>
						 <input type="text"> 
					 </div>
					   <a class="news-letter" href="#">
						 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i>Sign Up for Newsletter</label>
					   </a>
					 </div>
				     <div class="col-md-6 register-bottom-grid">
						    <h3>Login information</h3>
							 <div>
								<span>Password</span>
								<input type="password">
							 </div>
							 <div>
								<span>Confirm Password</span>
								<input type="password">
							 </div>
							 <input type="submit" value="submit">
							
					 </div>
					 <div class="clearfix"> </div>
				</form>
			</div>
</div>
<?php include 'includes/foot.php' ;	?>
</body>
</html>
			