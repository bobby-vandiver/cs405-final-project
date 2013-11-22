<?php
    include 'query.php';
	
	$orderId = $_POST['orderId'];
    $status = $_POST['status'];
	
	update_order_status($orderId, $status);
	
	
?>

<script>
	document.location = "staff_orders.php";
</script>