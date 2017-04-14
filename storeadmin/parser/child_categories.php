<?php
	require $_SERVER['DOCUMENT_ROOT'].'/ShopKart/storescripts/connect_to_mysql.php';
$parentID=(int)$_POST['parentID'];
$sql4 = "SELECT * FROM categories WHERE parent='$parentID' ORDER BY category";
$child_query = mysqli_query($con,$sql4);
ob_start(); 
?>
	<option value=""></option>
	<?php while($child = mysqli_fetch_assoc($child_query)): ?>

	<option value="<?= $child['id'];?>"><?= $child['category'];?></option>
	<?php endwhile; ?>
<?php echo ob_get_clean();?>
