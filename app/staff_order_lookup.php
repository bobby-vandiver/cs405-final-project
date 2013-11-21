<?php

include 'bootstrap.php';	
$orderNumber =  $_POST['orderID'];
$orderStatus = $_POST['status'];
$customer = $_POST['customer'];
$date1 = $_POST['startDate'];
$date2 = $_POST['endDate'];

if (!empty($orderNumber)) {
	print "Got order.";
	//$results = find_all_order_items_by_order_id($orderNumber);
} 
else if (!empty($customer)) {
print "GotCustomer";
	//$results = find_all_orders_by_username($customer); 
}
elseif (!empty($date1) AND !empty($date2)){
	print "Got date.";
	//$results = find_all_orders_by_date($date1, $date2);
}
elseif (!empty($orderStatus)) {
	//$results = find_all_orders_by_status($orderStatus);
	print "Got Orderstatus.";
}

$inline_css = '<style>body { padding-top: 60px; } </style>';

    head("Chico's Toy Store", $inline_css);

?>


<body>

	<?php include 'navbar.php' ?>

	<legend>Orders Display</legend>

	<table class="table table-striped">
		<?php print "$customer \n $orderNumber \n $orderStatus \n $date1 \n $date2"; //output rows using for each 
		?>
	</table>
	<?php include 'footer.php'; ?>
</body>
</html>