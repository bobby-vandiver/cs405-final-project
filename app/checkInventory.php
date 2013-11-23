<?php
    include 'query.php';
	
	$orderNum= $_POST['orderId'];
	
	$result = check_order_quantities($orderId);
	
	echo $result;
	
?>