<?php
include 'bootstrap.php';	
?>
<body>

<?php include 'navbar.php';
	$orderNumber =  $_POST['orderID'];
	$orderStatus = $_POST['status'];
	$customer = $_POST['customer'];
	$date1 = $_POST['startDate'];
	$date2 = $_POST['endDate'];
	$results;

	if (!empty($orderNumber)) {
		$results = find_all_order_items_by_order_id($orderNumber);
	} 
	else if (!empty($customer)) {
		$results = find_all_orders_by_username($customer); 
	}
	elseif (!empty($date1) AND !empty($date2)){
		$results = find_all_orders_by_date($date1, $date2);
	}
	elseif (isset($orderStatus)) {
		$results = find_all_orders_by_status($orderStatus);
	}

	$inline_css = '<style>body { padding-top: 60px; } </style>';

	head("Chico's Toy Store", $inline_css);

?>
	<div class="container">
		<div class="row-fluid span12">
			<legend>Orders Display</legend>
		</div>
		
		<table class="table table-striped">
			<?php 
			if ($results === "Orders not found.") {
				print("<h1>$results</h1>");
			}
			else {
				print "<thead>
					<tr>
					  <th>UserName</th>
					  <th>OrderID</th>
					  <th>Status</th>
					  <th>Time</th>
					  <th>Order Total</th>
					  <th>ISBN</th>
					  <th>Item Name</th>
					  <th>Sale Price</th>
					  <th>Quantity</th>
					</tr>
				  </thead>
				  <tbody>";
				$index = 0;
				while($row = mysqli_fetch_assoc($results)){
					print "<tr>";
					foreach($row as $cname => $cvalue){
						print "<td>$cvalue</td>";
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