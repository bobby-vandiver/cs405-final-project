<?php
    include 'cart.php';
	
	$isbn = $_POST['isbn'];
	$qty = $_POST['qty']
	$action = $_POST['action'];
	
	if ($action === "removeItem") {
		remove_item_in_cart($isbn, $qty);
	}
	elseif ($action === "updateQuantity") {
	
	}
	elseif ($action === "dropCart") {
		remove_all_items_in_cart()
	}
	
?>