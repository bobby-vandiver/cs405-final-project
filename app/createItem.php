<?php
    include 'query.php';
	
	$newIsbn = $_POST['isbn'];
    $newQty = $_POST['qty'];
	$newType = $_POST['type'];
	$newPrice = $_POST['price'];
	$newName = $_POST['name'];
	$newPromo = $_POST['promo'];
	
	create_order_item($newIsbn, $newQty, $newType, $newPrice, $newName, $newPromo);
?>
<script>
	document.location = "inventory.php";
</script>