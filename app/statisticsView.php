<?php
include 'bootstrap.php';	
?>
<body>

<?php include 'navbar.php';
	$interval =  $_POST['interval'];
	$sort = $_POST['sort'];
	$results;

	if ($interval === "Week") {
		$results = find_sales_in_past_week($sort);
	} 
	else if ($interval === "Month") {
		$results = find_sales_in_past_month($sort); 
	}
	else {
		$results = find_sales_in_past_year($sort);
	}

	$inline_css = '<style>body { padding-top: 60px; } </style>';

	head("Chico's Toy Store", $inline_css);

?>
	<div class="container">
		<div class="row-fluid span12">
			<legend>Orders Display For The Previous <?php print $interval; ?></legend>
		</div>
		
		<table id="ordersTable" class="table table-striped">
			<?php 
			if ($results === "Orders not found.") {
				print("<h1>$results</h1>");
			}
			else {
				print "<thead>
					<tr>
					  <th>ISBN</th>
					  <th>Name</th>
					  <th>Quantity Sold</th>
					</tr>
				  </thead>
				  <tbody>";
				while($row = mysqli_fetch_assoc($results)){
					print "<tr>";
					foreach($row as $cname => $cvalue){
						if ($cname === "sum(ois.quantity)") {
							if (empty($cvalue)) {
								print"<td>0</td>";
							}
							else {
								print"<td>$cvalue</td>";
							}							
						}
						else {
							print"<td>$cvalue</td>";
						}						
					}
					print "</tr>";
				}
				print "</tbody>";
			}?>
		</table>
	</div>
	<?php include 'footer.php'; ?>
</body>
</html>