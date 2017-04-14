<?php
	function display_errors($errors){
		$dispaly = '<ul class="bg-danger">';
		foreach ($errors as $key => $error) {
			$display .='<li class="txt-danger">'.$error.'</li>';

		}
		$display .= '</ul>';
		return $display;
	}
	function sanitize($dirty){
		return htmlentities($dirty,ENT_QUOTES,"UTF-8");
	}

	function money($number){
		return number_format($number,2).' Rs';
	}

	function login($userID){
		$_SESSION['SBUser'] = $userID;
		$date = date("Y-m-d H:i:s");
		global $con;
		$sql7 = "UPDATE users SET last_login = '$date' WHERE id='$userID' ";
	  	$udb = mysqli_query($con,$sql7);
	  	$_SESSION['success_flash'] = 'You are now Logged In!';
	  	header('Location:index.php');
	}

	function is_logged_in(){
		if(isset($_SESSION['SBUser']) && $_SESSION['SBUser'] >0){
			return true;
		}
		return false;
	}

	function login_error_redirect($url = 'login.php'){
		$_SESSION['error_flash'] = "You Must Be Logged In ";
		header('Location: '.$url);
	}

	function permission_error_redirect($url = 'login.php'){
		$_SESSION['error_flash'] = "You Do Not have permissions to access this page ";
		header('Location: '.$url);
	}

	function has_permission($permission = 'admin'){
		global $user_data;
		$permissions = explode(',', $user_data['permissions']);
		if(in_array($permission, $permissions,true)){
			return true;
		}
		return false;
	}
	function pretty_date($date){
		return date("M d, Y h:i A",strtotime($date));
	}
?>