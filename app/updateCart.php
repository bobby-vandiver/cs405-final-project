<?php
    include 'cart.php';
	
	$isbn = $_POST['isbn'];
	$qty = $_POST['qty'];
	$action = $_POST['action'];
	if (isset($action)) {
		if ($action === "removeItem") {
			remove_item_in_cart($isbn, $qty);
		}
		elseif ($action === "updateQuantity") {
			remove_item_in_cart($isbn, $qty);
		}
		elseif ($action === "dropCart") {
			remove_all_items_in_cart();
		}
	}
	else {print "Bad input";}
	
?>