<?php
    include 'query.php';
	
	$isbn = $_POST['isbn'];
	$qty = $_POST['quantity'];
	
	increment_inventory_qty($isbn, $qty)
	
?>
