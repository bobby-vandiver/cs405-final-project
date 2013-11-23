<?php
    include 'query.php';
	
	$orderNum= $_POST['orderId'];
	$result = check_order_quantities($orderNum);
	echo $result;
?>