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
?>