<?php



$connection = mysqli_connect( 'mysql.cs.uky.edu', $username, $password, $username);

//Orders

//lookup query by username
$result; //result of a query
$userQuery; //the customer id that is being searched on

$result = mysqli_query($connection,"select Orders.UserName, Orders.OrderID, Orders.Status, Orders.Time, Orders.Total, OrderItems.ISBN, OrderItems.OPrice, OrderItems.Qty, Item.Name 
	from Orders AS o
	join OrderItems AS oi
	on o.OrderID = oi.OrderID
	join Item AS i
	on oi.ISBN = i.ISBN
	where o.UserName = $userQuery;");

//Staff

//lookup for all items and attributes
$result = mysqli_query($connection,"select Item.ISBN, Item.Name, Item.Type, Item.Qty, Item.Price, Item.Promo
		from Item;");

//for updating inventory quantities in Item table
$updateItemISBNs; //array of ISBNS to be updated
$updateItemQtys; //array of Item Qtys to be updated

for ($i = 0; $i < count($updateItemISBNs); $i++) {
	$update = mysqli_query($connection,"UPDATE Item
			SET Item.Qty = (Item.Qty - $updateItemQtys[$i])
			WHERE Item.ISBN = $updateISBN[$i];");

	if (mysqli_error($connection) != null) {
		echo "Error creating record: " . mysqli_error($connection) . "\n";
	}
}


//for inserting item into Item table
$newISBN;
$newName;
$newType;
$newQty;
$newPrice;
$newPromo;

$insert = mysqli_query($connection,"INSERT INTO Item
		VALUES ($newQty, $newPrice, $newISBN, $newType, $newName, $newPromo);");

//update order status to shipped
$updateStatus;
$updateOrderID;


$update = mysqli_query($connection,"UPDATE Order
	SET Order.Status = $updateStatus 
	WHERE Order.OrderID = $updateOrderID;");

//update Item Qtys when Order is shipped
$updateItemISBNs; //array of ISBNS to be updated
$updateItemQtys; //array of Item Qtys to be updated

for ($i = 0; $i < count($updateItemISBNs); $i++) {
	$update = mysqli_query($connection,"UPDATE Item
		SET Item.Qty = (Item.Qty - $updateItemQtys[$i]) 
		WHERE Item.ISBN = $updateItemISBNs[$i];");
	
	if (mysqli_error($connection) != null) {
		echo "Error creating record: " . mysqli_error($connection) . "\n";
	}
}

//Manager

//set promotions
$updateItemISBNs; //array of ISBNS to be updated
$updatePromos; //array of Promos to set

for ($i = 0; $i < count($updateItemISBNs); $i++) {
	$update = mysqli_query($connection,"UPDATE Item
			SET Item.Promo = $updatePromos;
			WHERE Item.ISBN = $updateItemISBNs[$i];");

	if (mysqli_error($connection) != null) {
		echo "Error creating record: " . mysqli_error($connection) . "\n";
	}
}

//look up on order item qty

$result = mysqli_query($connection,"select oi.ISBN, oi.OPrice, oi.Qty, i.Name
		FROM OrderItems AS oi
		JOIN Item AS i
		ON oi.ISBN = i.ISBN
		ORDER BY oi.Qty;");


//look up on order item price
$result = mysqli_query($connection,"SELECT oi.ISBN, oi.OPrice, oi.Qty, i.Name
		FROM OrderItems AS oi
		JOIN Item AS i
		ON oi.ISBN = i.ISBN
		ORDER BY oi.OPrice;");

//select orders by date
$beginDate;
$endDate;

$result = mysqli_query($connection,"SELECT o.OrderID, o.Time, o.Status, o.Total
		FROM Order AS o
		WHERE  o.Time >=$beginDate
		AND o.Time <= $endDate;");

?>