<?php
	require $_SERVER['DOCUMENT_ROOT'].'/ShopKart/storescripts/connect_to_mysql.php';
	if(!is_logged_in()){
		login_error_redirect();
	}
?>
<?php
	include 'includes/head.php' ;
	$hashed = $user_data['password'];
	$old_password = trim((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
	$password = trim((isset($_POST['password']))?sanitize($_POST['password']):'');
	$confirm = trim((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
	$new_hashed = password_hash($password,PASSWORD_DEFAULT);
	$userID = $user_data['id'];
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
			if(empty($_POST['old_password']) || empty($_POST['password']) || empty($_POST['confirm'])){
			$errors[] = "Fill All Fields";
			}
			//password is more than 6 characters
			if(strlen($password)<6){
				$errors[] = "New Password must be atleast 6 characters!";
			}
			//if new password matches confirm
			if($password != $confirm){
				$errors[] = "The new Password and Confirm new Password doesn't match";
			}
			
	  		if(!password_verify($old_password,$hashed)){
	  			$errors[] = "the old password doesn't match!";
	  		}
			//check errors 
			if(!empty($errors)){
				echo display_errors($errors);
			}else{
			//Change password
			$sql9 = "UPDATE users SET password ='$hashed' WHERE id='$userID'";
	  		$user_query = mysqli_query($con,$sql9);
	  		$_SESSION['success_flash'] = 'Password has been changed successfully!';
	  		header('Location:index.php');
			}
		}
		?>
	</div>
	<h2 class="text-center">Change Password</h2><hr>
	<form action="change_password.php" method="POST">
		<div class="form-group">
			<label for="old_password">Old password:</label>
			<input type="password" name="old_password" id="old_password" class="form-control" value="<?= $old_password;?>">
		</div>
		<div class="form-group">
			<label for="password">New Password:</label>
			<input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
		</div>
		<div class="form-group">
			<label for="confirm">Confirm New Password:</label>
			<input type="password" name="confirm" id="confirm" class="form-control" value="<?=$confirm;?>">
		</div>
		<div class="form-group">
			<a href="index.php" class="btn btn-default">Cancel</a>
			<input type="submit" value="Login" class="btn btn-primary">
		</div>
	</form>
	<p class="text-right"><a href="/ShopKart/index.php" alt="home">Visit Site</p>
</div>
<?php include 'includes/foot.php' ;
?>