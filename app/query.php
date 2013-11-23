<?php
    include 'database.php';
    /*
       This file contains all of the
       interactions with the database.
    */

    // ====================
    // User related queries
    // ====================

    function create_user($username, $password, $role, $houseNumber, $street, $city, $state, $zip) {
        if(!user_exists($username)) {

            $connection = create_connection();

            $username = mysqli_real_escape_string($connection, $username);
            $password = mysqli_real_escape_string($connection, $password);
            $role = mysqli_real_escape_string($connection, $role);
            $houseNumber = mysqli_real_escape_string($connection, $houseNumber);
            $city = mysqli_real_escape_string($connection, $city);
            $state = mysqli_real_escape_string($connection, $state);
            $zip = mysqli_real_escape_string($connection, $zip); 

            $create_user_sql =
                "INSERT INTO Users(username, password, role, houseNumber, street, city, state, zip)
                 VALUES ('$username', '$password', $role, $houseNumber, '$street', '$city', '$state', '$zip')";

            execute_query($connection, $create_user_sql);
        }
    }
    
    function user_exists($username) {
        $connection = create_connection();
        $username = mysqli_real_escape_string($connection, $username);

        $user_exists_sql = "SELECT * FROM Users WHERE username = '$username'";
        $rows = execute_query($connection, $user_exists_sql);
        return mysqli_num_rows($rows) > 0;
    }

    function valid_password($username, $password) {
        $connection = create_connection();
        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);

        $password_sql = "SELECT * FROM Users WHERE username = '$username' AND password = '$password'";
        $rows = execute_query($connection, $password_sql);
        return mysqli_num_rows($rows) == 1;
    }

    function get_role($username) {
        $connection = create_connection();
        $username = mysqli_real_escape_string($connection, $username);

        $get_role_sql = "SELECT role FROM Users WHERE username = '$username'";
        $result = execute_query($connection, $get_role_sql);

        $row = mysqli_fetch_array($result);
        return $row['role'];
    }

    // =========================
    // Inventory related queries
    // =========================

    function item_in_stock($isbn, $requestedQty) {
        $connection = create_connection();
		
		$rows = mysqli_fetch_assoc(execute_query($connection, "select quantity from Items where isbn = $isbn;"));
		$inStockQty = $rows['quantity'];
		if ($inStockQty >= $requestedQty) {
			return true;
		}
		else {
			return false
		}
    }

    function item_views($username, $isbn) {
        $connection = create_connection();
        $item_views_sql = "";
        execute_query($connection, $item_views_sql);
    }

    function update_browsing_history($username, $isbn) {
        $connection = create_connection();
        $views = item_views($username, $isbn);
        
        if($views > 0) {
            $increment_item_view_sql = "";
            execute_query($connection, $increment_item_view_sql);
        }
        else {
            $create_item_view_sql = "";
            execute_query($connection, $create_item_view_sql);
        }
    }

    function get_item($isbn) {
        $connection = create_connection();
		$isbn = mysqli_real_escape_string($connection, $isbn);

        $get_item_sql = "SELECT * FROM Items Where isbn = $isbn";
        return mysqli_fetch_assoc(execute_query($connection, $get_item_sql));
    }
	
	function update_inventory_item($isbn, $qty, $promotion) {
		$connection = create_connection();

        $update_inventory_item_sql = "UPDATE Items
			SET Items.quantity = $qty, Items.promotion = $promotion
			WHERE Items.isbn = $isbn;";
		execute_query($connection, $update_inventory_item_sql);
		return;
	}
	
	function decrement_inventory_qty($isbn, $qty) {
		$connection = create_connection();
		
		$rows = mysqli_fetch_assoc(execute_query($connection, "select quantity from Items where isbn = $isbn;"));
		$startingQty = $rows['quantity'];
		$endingQty = $startingQty - $qty;

        $update_inventory_item_sql = "UPDATE Items
			SET Items.quantity = $endingQty
			WHERE Items.isbn = $isbn;";
		execute_query($connection, $update_inventory_item_sql);
		return;
	}
	
	function increment_inventory_qty($isbn, $qty) {
		$connection = create_connection();
		
		$rows = mysqli_fetch_assoc(execute_query($connection, "select quantity from Items where isbn = $isbn;"));
		$startingQty = $rows['quantity'];
		$endingQty = $startingQty + $qty;

        $update_inventory_item_sql = "UPDATE Items
			SET Items.quantity = $endingQty
			WHERE Items.isbn = $isbn;";
		execute_query($connection, $update_inventory_item_sql);
		return;
	}

    function get_all_items() {
        $connection = create_connection();

        $get_all_items_sql = "select * from Items;";
        $rows = execute_query($connection, $get_all_items_sql);
		if (mysqli_num_rows($rows) > 0) {
			return $rows;
		}
		else {
			return "Items not found.";
		}
    }

    // =====================
    // Order related queries
    // =====================

    function create_order($orderId, $status, $time, $total, $username) {
        $connection = create_connection();

        $create_order_sql = "";
        execute_query($connection, $create_order_sql);
    }
	
	function create_order_item($isbn, $qty, $type, $price, $name, $promo) {
        $connection = create_connection();

        $create_order_item_sql = "";
        execute_query($connection, $create_order_item_sql);
    }
	
	function lookup_max_isbn() {
		$connection = create_connection();

        $lookup_max_isbn_sql = "select max(isbn) from Items;";
        $rows = mysqli_fetch_assoc(execute_query($connection, $lookup_max_isbn_sql));
		$isbn = $rows['max(isbn)'];
		return $isbn;
	}

    function update_order_item_quantity($orderId, $isbn, $quantity) {
        $connection = create_connection();

        $update_quantity_sql = "";
        execute_query($connection, $update_quantity_sql);
    }

    function get_order_status($orderId) {
        $connection = create_connection();

        $get_order_status_sql = "";
        execute_query($connection, $get_order_status_sql);
    }

    function update_order_status($orderId, $status) {
        $connection = create_connection();

        $update_status_sql = "UPDATE Orders
			SET Orders.status = $status
			WHERE Orders.orderId = $orderId;";
        execute_query($connection, $update_status_sql);
		return;
    }
	
	function check_order_quantities($orderId) {
		$connection = create_connection();

        $get_isbns_qty_in_order_sql = "select oi.isbn, i.quantity, oi.quantity
		from OrderItems AS oi, Items AS i
		where oi.isbn = i.isbn and o.orderId = '$orderId';";
        $results = execute_query($connection, $get_isbns_qty_in_order_sql);
		while($row = mysqli_fetch_assoc($results)){
			if ($row['i.quantity'] < $row['oi.quantity']) {
				return false;
			}
		}
		return true;
	}

    function find_all_orders_by_username($username) {
        $connection = create_connection();

        $find_all_orders_by_username_sql = "select o.username, o.orderId, o.status, o.time, o.total, oi.isbn, i.name, oi.salePrice, oi.quantity 
		from Orders AS o, OrderItems AS oi, Items AS i
		where o.orderId = oi.orderId and oi.isbn = i.isbn and o.username = '$username';";
        $rows = execute_query($connection, $find_all_orders_by_username_sql);
		if (mysqli_error($connection) != null) {
			echo $find_all_orders_by_username_sql . "\n";
			echo "Error creating record: " . mysqli_error($connection) . "\n";
		}
		if (mysqli_num_rows($rows) > 0) {
			return $rows;
		}
		else {
			return "Orders not found.";
		}
    }
	
	 function add_item_to_inventory($isbn, $qty, $type, $price, $name, $promo) {
        $connection = create_connection();

        $add_item_to_inventory_sql = "INSERT INTO Items
		VALUES ($isbn, $qty, $price, $type, '$name', $promo);";
        execute_query($connection, $add_item_to_inventory_sql);
		if (mysqli_error($connection) != null) {
			echo $create_order_item_sql . "\n";
			echo "Error creating record: " . mysqli_error($connection) . "\n";
		}
		return;
    }
	
	function find_all_orders_by_status($status) {
        $connection = create_connection();
		if ($status === '0') {
			$whereClause = "and o.status = 0;";
		}
		elseif ($status === '1') {
			$whereClause = "and o.status = 1;"; 
		}
		else {
			$whereClause = ";";
		}
        $get_order_status_sql = "select o.username, o.orderId, o.status, o.time, o.total, oi.isbn, i.name, oi.salePrice, oi.quantity 
		from Orders AS o, OrderItems AS oi, Items AS i
		where o.orderId = oi.orderId and oi.isbn = i.isbn $whereClause";
        $rows = execute_query($connection, $get_order_status_sql);
		if (mysqli_num_rows($rows) > 0) {
			return $rows;
		}
		else {
			return "Orders not found.";
		}
    }

    function find_all_orders_by_date($date1, $date2) {
        $connection = create_connection();

        $find_all_by_date_sql = "select o.username, o.orderId, o.status, o.time, o.total, oi.isbn, i.name, oi.salePrice, oi.quantity 
		from Orders AS o, OrderItems AS oi, Items AS i
		where o.orderId = oi.orderId and oi.isbn = i.isbn and date(o.Time) > $date1 AND date(o.Time) < $date2;";
        $rows = execute_query($connection, $find_all_by_date_sql);
		if (mysqli_num_rows($rows) > 0) {
			return $rows;
		}
		else {
			return "Orders not found.";
		}
    }

    function find_all_order_items_by_order_id($orderId) {
        $connection = create_connection();

        $find_all_by_order_id_sql = "select o.username, o.orderId, o.status, o.time, o.total, oi.isbn, i.name, oi.salePrice, oi.quantity 
		from Orders AS o, OrderItems AS oi, Items AS i
		where o.orderId = oi.orderId and oi.isbn = i.isbn and o.orderId = '$orderId';";
        $rows = execute_query($connection, $find_all_by_order_id_sql);
		if (mysqli_num_rows($rows) > 0) {
			return $rows;
		}
		else {
			return "Orders not found.";
		}
    }
?>
