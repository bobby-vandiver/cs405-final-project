<?php
    include 'cart.php';
	include 'user.php';
	include 'query.php';
	
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
		elseif ($action === "purchaseCart") {
			$items = get_all_items_in_cart();
			$username = get_logged_in_user();
			$orderId = lookup_max_orderId() + 1;
			$total = '0';
			create_order($orderId, '0', $total, $username);
			foreach ($items as $isbn => $qty) {
				$itemData = get_item($isbn);
				$price = ($itemData['price'] * $itemData['promotion']);
				$total += $price * $qty;
				create_order_item($orderId, $isbn, $qty, $price);
			}
			update_order_total($orderId, $total);
			remove_all_items_in_cart();
		}
	}
	else {print "Bad input";}
	
?>