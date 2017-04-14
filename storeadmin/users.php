<?php
	require $_SERVER['DOCUMENT_ROOT'].'/ShopKart/storescripts/connect_to_mysql.php';
?>
<?php include 'includes/head.php' ;
	  include 'includes/nav.php' ;
	  if(!is_logged_in()){
	  	login_error_redirect();
	  }
	  if(!has_permission('admin')){
	  	permission_error_redirect('brands.php');
	  }

	  if(isset($_GET['delete'])){
	  	$deleteID = sanitize($_GET['delete']);
	  	$sql11 = "DELETE FROM users WHERE id = '$deleteID'";
	  	$delete_query = mysqli_query($con,$sql11);
	  	$_SESSION['succes_flash'] = "User has been Deleted!";
	  		
	  }
	  if(isset($_GET['add'])){
	  	$name = ((isset($_POST['name']))?sanitize($_POST['name']):'');
	  	$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
	  	$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
	  	$confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
	  	$permissions = ((isset($_POST['permissions']))?sanitize($_POST['permissions']):'');
	  	$join_date = date("Y-m-d H:i:s");
	  	$last_login = date("Y-m-d H:i:s");
	  	$errors = array();
	  	if($_POST){
	  		$emailQuery =  "SELECT * FROM users WHERE email = '$email'";
	  		$email_query = mysqli_query($con,$emailQuery);
	  		$emailCount = mysqli_num_rows($email_query);
	  		if($userCount >1){
	  			$errors[] ="That Email Already Exists!";
	  		}
	  		$required = array('name','email','password','confirm','permissions');
	  			foreach ($required as $key => $f) {
	  				if(empty($_POST[$f])){
	  					$errors[] = "You Must Fill Out All Fields!";
	  					break;
	  				}
	  			}
	  		//password is more than 6 characters
			if(strlen($password)<6){
				$errors[] = "Password must be atleast 6 characters!";
			}
			//if new password matches confirm
			if($password != $confirm){
				$errors[] = "The Password and Confirm Password doesn't match";
			}

			//validate email
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$errors[] = 'You Must enter a Valid Email';
			}

	  		if(!empty($errors)){
	  			echo display_errors($errors);
	  		}else{
	  			//add user
	  			$hashed = password_hash($password,PASSWORD_DEFAULT);
	  			$sql12 =  "INSERT INTO users (full_name,email,password,join_date,last_login,permissions) VALUES ('$full_name','$email','$hashed','$join_date','$last_login','$permissions')";
	  			$email_query = mysqli_query($con,$sql12);
	  			$_SESSION['success_flash'] = "User Created!";
	  			header('Location:users.php');
	  		}
	  	}
	  	?>
	  	<h2 class="text-center">Add A New User</h2><hr>
	  	<form action="users.php?add=1" method="post">
	  		<div class="form-group col-md-6">
	  			<label for="name">Full Name:</label>
	  			<input type="text" name="name" id="name" class="form-control" value="<?=$name;?>">
	  		</div>
	  		<div class="form-group col-md-6">
	  			<label for="email">Email:</label>
	  			<input type="email" name="email" id="email" class="form-control" value="<?=$email;?>">
	  		</div>
	  		<div class="form-group col-md-6">
	  			<label for="password">Password:</label>
	  			<input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
	  		</div>
	  		<div class="form-group col-md-6">
	  			<label for="confirm">Confirm Password:</label>
	  			<input type="password" name="confirm" id="confirm" class="form-control" value="<?=$confirm;?>">
	  		</div>
	  		<div class="form-group col-md-6">
	  			<label for="permissions">Permissions:</label>
	  			<select class="form-control" name="permissions">
	  			<option value=""<?=(($permissions == '')?'selected':'');?>></option>
	  			<option value="editor"<?=(($permissions == 'editor')?'selected':'');?>>Editor</option>
	  			<option value="admin"<?=(($permissions == 'admin,editor')?'selected':'');?>>Admin</option>
	  			</select>
	  		</div>
	  		<div class="form-group col-md-2 text-right">
	  			<a href="users.php" class="btn btn-default">Cancel</a>
	  			<input type="submit" value="Add User" class="btn btn-primary">
	  		</div>
	  		<div class="clearfix"></div>
	  	</form>
	 <?php }  else{
	  $sql10 = "SELECT * FROM users ORDER BY full_name";
	  $users_query = mysqli_query($con,$sql10);
?>
<body>
	<h2>Users</h2><hr>
	<a href="users.php?add=1" class="btn btn-success pull-right" style="margin-bottom:25px;margin-right:70px;padding:15px" id="add_product_btn">Add New User</a>
	<table class="table table-bordered table-striped table-condensed">
		<thead><th></th><th>Name</th><th>Email</th><th>Join Date</th><th>Last Login</th><th>Permissions</th></thead>
		<tbody>
			<?php while($user = mysqli_fetch_assoc($users_query)): ?>
			<tr>
				<td>
					<?php if($user['id'] != $user_data['id']): ?>
					<a href="users.php?delete=<?=$user['id'];?>" class="btn btn-default btn-xs"><img src="../images/del.png" alt="" width="20px"></a>
					<?php endif; ?>
				</td>
				<td><?=$user['full_name']; ?></td>
				<td><?=$user['email']; ?></td>
				<td><?=pretty_date($user['join_date']); ?></td>
				<td><?=pretty_date($user['last_login']); ?></td>
				<td><?=$user['permissions']; ?></td>
			</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
<?php } include 'includes/foot.php' ;	?>

</body>
</html>