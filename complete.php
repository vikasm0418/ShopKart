<?php
	require $_SERVER['DOCUMENT_ROOT'].'/ShopKart/storescripts/connect_to_mysql.php';
?>
<?php include 'includes/head.php' ;
	  include 'includes/nav.php' ;	
	 	
	  $errors = array();
	  $pass='no';
	  if($_POST['submit']){
	  		$payment_currency = $_GET['sum'];
	  		$name = sanitize($_POST['name']);
	  		$email = sanitize($_POST['email']);
	  		$address = sanitize($_POST['address']);
	  		$city = sanitize($_POST['city']);
	  		$state = sanitize($_POST['state']);
	  		$zip = sanitize($_POST['zip']);
	  		$mobile = sanitize($_POST['mobile']);
	  		$card_number = sanitize($_POST['card_number']);
	  		$card_name = sanitize($_POST['card_name']);
	  		$cvc = sanitize($_POST['cvc']);
	  		$date = date("Y-m-d H:i:s");

			//form validation 
			if(empty($_POST['email']) || empty($_POST['address']) || empty($_POST['mobile'])|| empty($_POST['city'])|| empty($_POST['state'])|| empty($_POST['zip'])|| empty($_POST['name']) || empty($_POST['card_name']) || empty($_POST['card_number']) || empty($_POST['cvc']) ){
			$errors[] = "You Must Provide All The Details";
			}
			//validate email
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$errors[] = 'You Must enter a Valid Email';
			}

			//password is more than 6 characters
			if(strlen($mobile)!=10){
				
				$errors[] = "Enter a valid phone number!";
			}
			//complete order
			if(!empty($errors)){
				
				echo display_errors($errors);
			}else{
			//complete payment
	  			$psql = "INSERT INTO transactions (payer_email,full_name,payment_date,payment_currency,address_street,address_city,address_state,address_zip,card_name,cvc,card_number,mobile) VALUES ('$email','$name','$date','$payment_currency','$address','$city','$state','$zip','$card_name','$cvc','$card_number','$mobile')";
	  			$presult = mysqli_query($con,$psql);
	  			alert('Transaction Complete');
	  			header('Location:index.php');	
			}
			
		}
?>
<body>
<!--content-->
<div class=" container">
<div class=" register">
	<h1>Complete The Payment</h1>
		  	  <form action="complete.php" method="POST"> 
				 <div class="col-md-6 register-top-grid">
					<h3>Personal infomation</h3>
					 <div>
						<span>Full Name:</span>
						<input type="text" name="name"  >
					 </div>
					 <div>
						<span>Mobile No.</span>
						<input type="text" name="mobile" >
					 </div>
					 <div>
						 <span >Email:</span>
						 <input style="width:400px;height:40px" type="email" name="email" > 
					 </div>
					 <div>
						<span>Card Number:</span>
						<input type="number" name="card_number" >
					 </div>
					 <div>
						<span>CVC:</span>
						<input type="number" name="cvc" >
					 </div>
					 </div>
				     <div class="col-md-6 register-top-grid">
						<div>
						<span>Street Address:</span>
						<input type="text" name="address"> 
					 </div>
						 <div>
						<span>City:</span>
						<input type="text" name="city"  >
					 </div>
					 	<div>
						<span>State</span>
						<input type="text" name="state" > 
					 </div>
					 	<div>
						<span>ZIP Code:</span>
						<input type="number" name="zip" >
					 </div>
					 <div>
						<span>Card Name:</span>
						<input type="text" name="card_name" >
					 </div>
						 <input class="btn btn-primary" name="submit" type="submit" >
					 </div>
					 
				</form>
			</div>

</div>
<?php include  'includes/foot.php' ;	?>
</body>
</html>
			