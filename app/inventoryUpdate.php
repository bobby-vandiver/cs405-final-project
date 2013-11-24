<?php
    require_once 'query.php';
    require_once 'auth-utils.php';

    redirect_if_not_staff();
	
	$isbn = $_POST['isbn'];
    $qty = $_POST['qty'];
	$promo = $_POST['promotion'];
	
	update_inventory_item($isbn, $qty, $promo);
?>

