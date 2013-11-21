<?php
include 'bootstrap.php';

$inline_css = '<style>body { padding-top: 60px; } </style>';

    head("Chico's Toy Store", $inline_css);

?>


<body>

	<?php include 'navbar.php' ?>
	<div class="container">
		<legend>Inventory Display</legend>
		
		<table class="table table-striped">
			<?php 
			$results = get_all_items();
			print "<thead>
				<tr>
				  <th>ISBN</th>
				  <th>Quantity</th>
				  <th>Price</th>
				  <th>Type</th>
				  <th>Name</th>
				  <th>Promotional Rate</th>
				</tr>
			  </thead>
			  <tbody>";
			while($row = mysqli_fetch_assoc($results)){
				print "<tr>";
				foreach($row as $cname => $cvalue){
					if ($cname === "type") {
						if ($cvalue === "0") {
							print "<td>Toy</td>";
						}
						else {
							print "<td>Game</td>";
						}
					}
					elseif ($cname === "quantity") {
						print"<td contenteditable=\"true\">$cvalue</td>";
					}
					elseif ($cname === "price") {
						$price = money_format('$%i', $cvalue);
						print"<td>$price</td>";
					}
					elseif ($cname === "promotion") {
						printf("<td contenteditable=\"true\">%1.2f</td>", $cvalue);
					}
					else {
						print "<td>$cvalue</td>";
					}
				}
				print "</tr>";
			}
			print "</tbody>";
			?>
		</table>
	</div>
	<?php include 'footer.php'; ?>
</body>
</html>