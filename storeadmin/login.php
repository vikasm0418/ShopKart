<?php
	require $_SERVER['DOCUMENT_ROOT'].'/ShopKart/storescripts/connect_to_mysql.php';
?>
<?php
	include 'includes/head.php' ;
	$email = trim((isset($_POST['email']))?sanitize($_POST['email']):'');
	$password = trim((isset($_POST['password']))?sanitize($_POST['password']):'');
	$errors = array();
?>
<style >
	body{
		background-image: url("/ShopKart/images/back.jpeg");
		background-size: 100vw 100vh;
		background-attachment: fixed;
	}
</style>
<div id="login-form" style="width: 50%;height: 60%;border: 2px solid #000;box-shadow:7px 7px 15px rgba(0,0,0,6);margin: 8% auto;padding:15px;border-radius:15px;background-color:#fff;margin:7% auto">
	<div>
		<?php
			if($_POST){
			//form validation 
			if(empty($_POST['email']) || empty($_POST['password'])){
			$errors[] = "You Must Provide Email and password.";
			}
			//validate email
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$errors[] = 'You Must enter a Valid Email';
			}
			//password is more than 6 characters
			if(strlen($password)<6){
				$errors[] = "Password must be atleast 6 characters!";
			}
			//user doesn't exists
			$sql = "SELECT * FROM users WHERE email = '$email'";
	  		$user_query = mysqli_query($con,$sql);
	  		$user = mysqli_fetch_assoc($user_query);
	  		$userCount = mysqli_num_rows($user_query);
	  		if($userCount <1){
	  			$errors[] ="That Email Doesn't exists!";
	  		}

	  		if(!password_verify($password,$user['password'])){
	  			$errors[] = "the password doesn't match!";
	  		}
			//check errors 
			if(!empty($errors)){
				echo display_errors($errors);
			}else{
			//log user in
			$userID = $user['id'];
			login($userID);
			}
		}
		?>
	</div>
	<h2 class="text-center">Login</h2><hr>
	<form action="login.php" method="POST">
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" name="email" id="email" class="form-control" value="<?= $email;?>">
		</div>
		<div class="form-group">
			<label for="password">Password:</label>
			<input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
		</div>
		<div class="form-group">
			<input type="submit" value="Login" class="btn btn-primary">
		</div>
	</form>
	<p class="text-right"><a href="/ShopKart/index.php" alt="home">Visit Site</p>
</div>
<?php include 'includes/foot.php' ;
?>