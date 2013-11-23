<?php
    include 'query.php';
	
	$isbn = $_POST['isbn'];
	$qty = $_POST['quantity'];
	
	decrement_inventory_qty($isbn, $qty)
	
?>
