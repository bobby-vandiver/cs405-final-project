<?php
include 'bootstrap.php';

$inline_css = '<style>body { padding-top: 60px; } </style>';

    head("Chico's Toy Store", $inline_css);

?>


<body>

	<?php include 'navbar.php' ?>
	<div class="container">
		<legend>Inventory Display</legend>
		
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
				</tr>
			  </thead>
			  <tbody>";
			$index = 0;
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
						print"<td>$price</td>";
					}
					elseif ($cname === "promotion") {
						printf("<td contenteditable=\"true\" onblur=\"updateEvent(this)\">%1.2f</td>", $cvalue);
					}
					else {
						print "<td>$cvalue</td>";
					}
				}
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
			var promo = item[5].innerHTML;
			
			$.post("inventoryUpdate.php", {isbn: id, qty: num, promotion: promo});
			alert("Item ISBN " + id +" was updated.");
		}
	</script>
</body>
</html>