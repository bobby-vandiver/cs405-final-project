<?php
    include 'query.php';
	
	$newIsbn = $_POST['isbn'];
    $newQty = $_POST['qty'];
	$newType = $_POST['type'];
	$newPrice = $_POST['price'];
	$newName = $_POST['name'];
	$newPromo = $_POST['promo'];
	
	add_item_to_inventory($newIsbn, $newQty, $newType, $newPrice, $newName, $newPromo);
?>
<script>
	document.location = "inventory.php";
</script>