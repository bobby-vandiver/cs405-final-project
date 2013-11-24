<?php


	include 'bootstrap.php';
	include 'cart.php';
	include 'navbar.php';

	$inline_css = '<style>body { padding-top: 60px; } </style>';

    head("Chico's Toy Store", $inline_css);

	$items = get_all_items_in_cart();
	$isLoggedIn = user_is_logged_in();
	
	if (!$isLoggedIn) {
		header("Location: 'sign-in.php'");
	}
	
?>

	<div class="container">
		<div class="row-fluid span12">
			<legend>Finalize Purchase</legend>
		</div>
		
		<table id="purchasesTable" class="table table-striped">
			<?php 
				print "<thead>
					<tr>
					  <th>ISBN</th>
					  <th>Item Name</th>
					  <th>Quantity</th>
					  <th>Sale Price</th>
					</tr>
				  </thead>
				  <tbody>";
				foreach ($items as $isbn => $qty) {
						$itemData = get_item($isbn);
						print "<tr>";
						print "<td>" . $itemData['isbn'] . "</td>";
						print "<td>" . $itemData['name'] . "</td>";
						print "<td contenteditable=\"true\" onblur=\"changeQuantity(this)\">" . $qty . "</td>";
						print "<td>" . money_format('$%i', ($itemData['price'] * $itemData['promotion'])) . "</td>";
						print "<td><a class=\"btn btn-danger\" onclick=\"deleteItem(this)\">Remove Item</a></td>";
						print "</tr>";
				}
				print "</tbody>";
			?>
		</table>
	</div>
	
<script>
	function deleteItem(field) {
		var item = $(field).parent('td').parent('tr').children('td');
		var thisIsbn = item[0].innerHTML;
		var thisQty = item[2].innerHTML;
		$.post("updateCart.php", {isbn: thisIsbn, qty: thisQty, action: "removeItem"});
	}
	
	function changeQuantity(field) {
		var item = $(field).parent('td').parent('tr').children('td');
		var thisIsbn = item[0].innerHTML;
		var thisQty = item[2].innerHTML;
		$.post("updateCart.php", {isbn: thisIsbn, qty: thisQty, action: "updateQuantity"});
	}
	
	function dropCart(field) {
		$.post("updateCart.php", {isbn: thisIsbn, qty: thisQty, action: "dropCart"});
		document.location = "index.php";
	}
</script>