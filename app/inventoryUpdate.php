<?php
    include 'query.php';
	
	$isbn = $_POST['isbn'];
    $qty = $_POST['qty'];
	$promo = $_POST['promotion'];
	
	update_inventory_item($isbn, $qty, $promo);
	
	
?>