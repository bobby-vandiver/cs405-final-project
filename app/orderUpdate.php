<?php
    include 'query.php';
	
	$orderId = $_POST['orderId'];
    $status = $_POST['status'];
	$quantity = $_POST['quantity'];
	
	update_order_status($orderId, $status);
	
?>
