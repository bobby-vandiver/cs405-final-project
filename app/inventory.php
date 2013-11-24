<?php
    include 'bootstrap.php';
    head("Chico's Toy Store");
?>


<body>

	<?php 
		include 'navbar.php';
		if (logged_in_user_is_admin()) {
			$can_set_promotion = "contenteditable=\"true\" onblur=\"updateEvent(this)\"";
		}
		else {
			$can_set_promotion = "";
		}
	?>
	
	<div class="container">
		<div class="row-fluid span12">
				<legend>Inventory Display</legend>
				<a class="btn btn-success" href="newItem.php">Add item</a>
		</div>
		<table id="itemsTable" class="table table-striped">
			<?php 
			$results = get_all_items();
			print "<thead>
				<tr>
				  <th>ISBN</th>
				  <th>Quantity</th>
				  <th>Base Price</th>
				  <th>Type</th>
				  <th>Name</th>
				  <th>Promotional Rate</th>
				  <th>Current Price</th>
				</tr>
			  </thead>
			  <tbody>";
			$index = 0;
			$basePrice=0;
			$promotion = 1.0;
			while($row = mysqli_fetch_assoc($results)){
				print "<tr>";
				foreach($row as $cname => $cvalue){
					if ($cname === "isbn") {
						print "<td id=\"isbn$index\">$cvalue</td>";
					}
					elseif ($cname === "type") {
						if ($cvalue === "0") {
							print "<td>Toy</td>";
						}
						else {
							print "<td>Game</td>";
						}
					}
					elseif ($cname === "quantity") {
						print"<td contenteditable=\"true\" onblur=\"updateEvent(this)\">$cvalue</td>";
					}
					elseif ($cname === "price") {
						$price = money_format('$%i', $cvalue);
						$basePrice = $cvalue;
						print"<td>$price</td>";
					}
					elseif ($cname === "promotion") {
						$promotion = sprintf('%0.2f', $cvalue);
						$cell_contents = "<td $can_set_promotion >$promotion</td>";
						print "$cell_contents";
					}
					else {
						print "<td>$cvalue</td>";
					}
				}
				$currentPrice = money_format('$%i', $basePrice * $promotion);
				print "<td>$currentPrice</td>";
				print "</tr>";
				$index++;
			}
			print "</tbody>";
			?>
		</table>
		
	</div>
	
	<?php include 'footer.php'; ?>
	<script>
		//function to find and post updates
		function updateEvent(field) {
			var item = $(field).parent('tr').children('td');
			var id = item[0].innerHTML;
			var num = item[1].innerHTML;
			var promo = item[5].innerHTML.replace("<br>","");
			var baseprice = item[2].innerHTML.replace("$","");
			item[6].innerHTML = "$"+ (baseprice*promo).toFixed(2);
			
			$.post("inventoryUpdate.php", {isbn: id, qty: num, promotion: promo});
			alert("Item ISBN " + id +" was updated.");
		}
	</script>
</body>
</html>
