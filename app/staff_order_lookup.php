<?php
    include 'bootstrap.php';	
	head("Chico's Toy Store");
?>
<body>

<?php
    include 'navbar.php';
    require 'auth-utils.php';

    redirect_if_not_staff();

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
?>
	<div class="container">
		<div class="row-fluid span12">
			<legend>Orders Display</legend>
		</div>
		
		<table id="ordersTable" class="table table-striped">
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
					  <th>Change shipped status</th>
					</tr>
				  </thead>
				  <tbody>";
				$index = 0;
				while($row = mysqli_fetch_assoc($results)){
					print "<tr>";
					foreach($row as $cname => $cvalue){
						if ($cname === "status") {
							if ($cvalue === '1') {
								print"<td>Shipped</td>";
							}
							else {
								print"<td>Pending</td>";
							}							
						}
						elseif ($cname === "orderId") {
								print"<td class=\"order\" id=\"order$index\">$cvalue</td>";
						}
						elseif ($cname === "total") {
							$val = money_format('$%i', $cvalue);
							print"<td>$val</td>";
						}
						elseif ($cname === "salePrice") {
							$val = money_format('$%i', $cvalue);
							print"<td>$val</td>";
						}
						else {
							print"<td>$cvalue</td>";
						}
					}
					print "<td><a class=\"btn btn-success\" onclick=\"toggleShipped(this)\">Toggle Shipped</a></td>";
					print "</tr>";
					$index++;
				}
				print "</tbody>";
			}?>
		</table>
	</div>
	<script>
		function toggleShipped(field) {
			var item = $(field).parent('td').parent('tr').children('td');
			var orderNum = item[1].innerHTML;
			var isbnNum = item[5].innerHTML;
			var qty = item[8].innerHTML;
			var inventoryExists = 'false';
			
			if (item[2].innerHTML == "Pending") {
				$.ajax({
					type: "POST",
					url: "checkInventory.php",
					dataType: "text",
					data: {orderId : orderNum},
					async: false,
				}).done(function ( data ) {
						inventoryExists = data;
				});
				if (inventoryExists == 'false') {
					alert("Insufficient inventory to complete this order.");
					return;
				}
				$.post("orderUpdate.php", {orderId: orderNum, status: '1'});
				$('#ordersTable>tbody>tr>td:nth-child(1)').each( function(){
				   if ($(this).parent('tr').children('td')[1].innerHTML == item[1].innerHTML) {
						$(this).parent('tr').children('td')[2].innerHTML = "Shipped";
						var thisISBN = $(this).parent('tr').children('td')[5].innerHTML;
						var thisQty = $(this).parent('tr').children('td')[8].innerHTML;
						$.post("decrementInventory.php", {isbn: thisISBN, quantity: thisQty});
				   }       
				});
				item[2].innerHTML = "Shipped";
			}
			else {
				$.post("orderUpdate.php", {orderId: orderNum, status: '0'});
				$('#ordersTable>tbody>tr>td:nth-child(1)').each( function(){
				   if ($(this).parent('tr').children('td')[1].innerHTML == item[1].innerHTML) {
						$(this).parent('tr').children('td')[2].innerHTML = "Pending";
						var thisISBN = $(this).parent('tr').children('td')[5].innerHTML;
						var thisQty = $(this).parent('tr').children('td')[8].innerHTML;
						$.post("incrementInventory.php", {isbn: thisISBN, quantity: thisQty});
				   }       
				});
				item[2].innerHTML = "Pending";
			}
		}
	
	</script>
	<?php include 'footer.php'; ?>
</body>
</html>
