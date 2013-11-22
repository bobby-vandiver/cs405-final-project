<?php
	const CART_SESSION_NAME = "cart";
	const ONE_DAY_SECONDS = 86400;

    session_start();

	function add_item_to_cart($isbn, $quantity = 1) {
		$cart_items = get_items_from_session();

		if(array_key_exists($isbn, $cart_items)) {
			$cart_items[$isbn] += $quantity;
		}
		else {
			$cart_items += array($isbn => $quantity);
		}

		save_cart_to_session($cart_items);
	}

	function remove_item_in_cart($isbn, $quantity = 1) {
		$cart_items = get_items_from_session();

		if(array_key_exists($isbn, $cart_items)) {
			if($cart_items[$isbn] > 0) {
				$cart_items[$isbn] -= $quantity;
			}
			else {
				unset($cart_items[$isbn]);
			}
		}

		save_cart_to_session($cart_items);
	}

	// Returns an associative array containing the isbn
	// and quantity of each item in cart:
	// 
	// array( $isbn => $quantity, ...)
	function get_all_items_in_cart() {
		return get_items_from_session();
	}

	function remove_all_items_in_cart() {
		if(cart_exists())
			destroy_cart();
	}

	// =============================================================
	// Utility functions for checking session.
	// These should NOT be used outside this script.
	// =============================================================

	function cart_exists() {
		return isset($_SESSION[CART_SESSION_NAME]);
	}

	function get_items_from_session() {
		if(cart_exists())
			return unserialize($_SESSION[CART_SESSION_NAME]);
		else
			return array();
	}

	function save_cart_to_session($items) {
        $_SESSION[CART_SESSION_NAME] = serialize($items);
	}

	function destroy_cart() {
		unset($_SESSION[CART_SESSION_NAME]);
	}
?>
