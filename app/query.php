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

   function item_in_stock($isbn) {
        $connection = create_connection();
        $isbn = mysqli_real_escape_string($connection, $isbn);

        $in_stock_sql = "SELECT quantity FROM Items WHERE isbn = '$isbn'";
        $result = execute_query($connection, $in_stock_sql);

        $row = mysqli_fetch_array($result);
        return $row['quantity'] > 0;
    }

    function item_views($username, $isbn) {
        $connection = create_connection();

        $username = mysqli_real_escape_string($connection, $username);
        $isbn = mysqli_real_escape_string($connection, $isbn);

        $item_views_sql = "SELECT views FROM BrowsingHistory WHERE username = '$username' AND isbn = '$isbn'";
        $result = execute_query($connection, $item_views_sql);

        $row = mysqli_fetch_array($result);
        $views = $row['views'];

        if($views === NULL)
            $views = 0;

        return $views;
    }

    function update_browsing_history($username, $isbn) {
        $connection = create_connection();

        $username = mysqli_real_escape_string($connection, $username);
        $isbn = mysqli_real_escape_string($connection, $isbn);

        $views = item_views($username, $isbn);
        
        if($views > 0) {
            $views++;
            $increment_item_view_sql = "UPDATE BrowsingHistory SET views=$views WHERE username = '$username' AND isbn = '$isbn'";
            execute_query($connection, $increment_item_view_sql);
        }
        else {
            $views = 1;
            $create_item_view_sql = "INSERT INTO BrowsingHistory (username, isbn, views) VALUES ('$username', '$isbn', $views)";
            execute_query($connection, $create_item_view_sql);
        }
    }

    function get_item($isbn) {
        $connection = create_connection();
		$isbn = mysqli_real_escape_string($connection, $isbn);

        $get_item_sql = "SELECT * FROM Items Where isbn = '$isbn'";
        return mysqli_fetch_assoc(execute_query($connection, $get_item_sql));
    }
	
	function update_inventory_item($isbn, $qty, $promotion) {
		$connection = create_connection();

		$isbn = mysqli_real_escape_string($connection, $isbn);
		$qty = mysqli_real_escape_string($connection, $qty);
		$promotion = mysqli_real_escape_string($connection, $promotion);

        $update_inventory_item_sql = "UPDATE Items
			SET Items.quantity = $qty, Items.promotion = $promotion
			WHERE Items.isbn = '$isbn';";
		execute_query($connection, $update_inventory_item_sql);
		return;
	}
	
	function decrement_inventory_qty($isbn, $qty) {
		$connection = create_connection();
		$isbn = mysqli_real_escape_string($connection, $isbn);
		
		$rows = mysqli_fetch_assoc(execute_query($connection, "select quantity from Items where isbn = '$isbn';"));
		$startingQty = $rows['quantity'];
		$endingQty = $startingQty - $qty;

        $update_inventory_item_sql = "UPDATE Items
			SET Items.quantity = $endingQty
			WHERE Items.isbn = '$isbn';";
		execute_query($connection, $update_inventory_item_sql);
		return;
	}
	
	function increment_inventory_qty($isbn, $qty) {
		$connection = create_connection();
		$isbn = mysqli_real_escape_string($connection, $isbn);
		
		$rows = mysqli_fetch_assoc(execute_query($connection, "select quantity from Items where isbn = '$isbn';"));
		$startingQty = $rows['quantity'];
		$endingQty = $startingQty + $qty;

        $update_inventory_item_sql = "UPDATE Items
			SET Items.quantity = $endingQty
			WHERE Items.isbn = '$isbn';";
		execute_query($connection, $update_inventory_item_sql);
		return;
	}

    function get_all_items_in_stock() {
        $connection = create_connection();

        $get_items_in_stock_sql = "SELECT * FROM Items WHERE quantity > 0";
        return execute_query($connection, $get_items_in_stock_sql);
    }

    function get_all_items() {
        $connection = create_connection();

        $get_all_items_sql = "select * from Items  order by cast(isbn as unsigned) asc;";
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

		$orderId = mysqli_real_escape_string($connection, $orderId);
		$status = mysqli_real_escape_string($connection, $status);
		$time = mysqli_real_escape_string($connection, $time);
		$total = mysqli_real_escape_string($connection, $total);
		$username = mysqli_real_escape_string($connection, $username);

        $create_order_sql = "INSERT INTO Orders (orderId, status, time, total, username) VALUES ($orderId, $status, $time, $total, '$username')";
        execute_query($connection, $create_order_sql);
    }
	
	function create_order_item($orderId, $isbn, $qty, $salePrice) {
        $connection = create_connection();

		$orderId = mysqli_real_escape_string($connection, $orderId);
		$isbn = mysqli_real_escape_string($connection, $isbn);
		$qty = mysqli_real_escape_string($connection, $qty);
		$salePrice = mysqli_real_escape_string($connection, $salePrice);

        $create_order_item_sql = "INSERT INTO OrderItems (orderId, isbn, quantity, salePrice) VALUES ($orderId, '$isbn', $qty, $salePrice)";
        execute_query($connection, $create_order_item_sql);
    }

    function find_all_order_summaries_by_username($username) {
        $connection = create_connection();
        $username = mysqli_real_escape_string($connection, $username);
        $find_all_orders_sql = "SELECT * FROM Orders WHERE username = '$username'";
        return execute_query($connection, $find_all_orders_sql);
    }

    function get_order_items($orderId) {
        $connection = create_connection();
		$orderId = mysqli_real_escape_string($connection, $orderId);

        $get_order_items_sql = "SELECT * FROM OrderItems WHERE orderId = $orderId";
        return execute_query($connection, $get_order_items_sql);
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
		$orderId = mysqli_real_escape_string($connection, $orderId);

        $get_order_status_sql = "SELECT status FROM Orders WHERE orderId = $orderId";
        $result = execute_query($connection, $get_order_status_sql);

        $row =  mysqli_fetch_array($result);
        return $row['status'];
    }

    function update_order_status($orderId, $status) {
        $connection = create_connection();

		$orderId = mysqli_real_escape_string($connection, $orderId);
		$status = mysqli_real_escape_string($connection, $status);

        $update_status_sql = "UPDATE Orders
			SET Orders.status = $status
			WHERE Orders.orderId = $orderId;";
        execute_query($connection, $update_status_sql);
		return;
    }
	
	function check_order_quantities($orderId) {
		$connection = create_connection();
		$orderId = mysqli_real_escape_string($connection, $orderId);

        $get_isbns_qty_in_order_sql = "select oi.isbn, i.quantity AS qty, oi.quantity 
		from OrderItems AS oi, Items AS i 
		where oi.isbn = i.isbn and oi.orderId = $orderId;";
        $results = execute_query($connection, $get_isbns_qty_in_order_sql);
		while($row = mysqli_fetch_assoc($results)){
			if ($row['qty'] < $row['quantity']) {
				return 'false';
			}
		}
		if (mysqli_error($connection) != null) {
			return $get_isbns_qty_in_order_sql . mysqli_error($connection);
		}
		else {
			return 'true';
		}
	}

    function user_has_orders($username) {
        $connection = create_connection();
		$username = mysqli_real_escape_string($connection, $username);

        $find_orders_sql = "SELECT * FROM Orders WHERE username = '$username'";
        $rows = execute_query($connection, $find_orders_sql);
        return mysqli_num_rows($rows) > 0;
    }

    function find_all_orders_by_username($username) {
        $connection = create_connection();
		$username = mysqli_real_escape_string($connection, $username);

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

		$isbn = mysqli_real_escape_string($connection, $isbn);
		$qty = mysqli_real_escape_string($connection, $qty);
		$type = mysqli_real_escape_string($connection, $type);
		$price = mysqli_real_escape_string($connection, $price);
		$name = mysqli_real_escape_string($connection, $name);
		$promo = mysqli_real_escape_string($connection, $promo);

        $add_item_to_inventory_sql = "INSERT INTO Items
		VALUES ('$isbn', $qty, $price, $type, '$name', $promo);";
        execute_query($connection, $add_item_to_inventory_sql);
		if (mysqli_error($connection) != null) {
			echo $create_order_item_sql . "\n";
			echo "Error creating record: " . mysqli_error($connection) . "\n";
		}
		return;
    }
	
	function find_all_orders_by_status($status) {
        $connection = create_connection();
		$status = mysqli_real_escape_string($connection, $status);

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

		$date1 = mysqli_real_escape_string($connection, $date1);
		$date2 = mysqli_real_escape_string($connection, $date2);

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
		$orderId = mysqli_real_escape_string($connection, $orderId);

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
	
	 // =====================
    // Statistics related queries
    // =====================
	
	function find_sales_in_past_week($sort) {
        $connection = create_connection();
		$sort = mysqli_real_escape_string($connection, $sort);
		
        $find_sales_in_past_week_sql = "select distinct(Items.isbn), Items.name, sum(ois.quantity) from Items left join (select OrderItems.isbn, OrderItems.quantity from OrderItems join Orders on OrderItems.orderId = Orders.orderId where Orders.time >= date_sub(CURDATE(), INTERVAL 7 DAY)) as ois on ois.isbn = Items.isbn group by Items.isbn order by cast($sort;";
		$rows = execute_query($connection, $find_sales_in_past_week_sql);
		if (mysqli_num_rows($rows) > 0) {
			return $rows;
		}
		else {
			return "Orders not found.";
		}
    }
	
	function find_sales_in_past_month($sort) {
        $connection = create_connection();
		$sort = mysqli_real_escape_string($connection, $sort);

        $find_sales_in_past_month_sql = "select distinct(Items.isbn), Items.name, sum(ois.quantity) from Items left join (select OrderItems.isbn, OrderItems.quantity from OrderItems join Orders on OrderItems.orderId = Orders.orderId where Orders.time >= date_sub(CURDATE(), INTERVAL 30 DAY)) as ois on ois.isbn = Items.isbn group by Items.isbn order by cast($sort;";
		$rows = execute_query($connection, $find_sales_in_past_month_sql);
		if (mysqli_num_rows($rows) > 0) {
			return $rows;
		}
		else {
			return "Orders not found.";
		}
    }
	
	function find_sales_in_past_year($sort) {
        $connection = create_connection();
		$sort = mysqli_real_escape_string($connection, $sort);

        $find_sales_in_past_year_sql = "select distinct(Items.isbn), Items.name, sum(ois.quantity) from Items left join (select OrderItems.isbn, OrderItems.quantity from OrderItems join Orders on OrderItems.orderId = Orders.orderId where Orders.time >= date_sub(CURDATE(), INTERVAL 365 DAY)) as ois on ois.isbn = Items.isbn group by Items.isbn order by cast($sort;";
		$rows = execute_query($connection, $find_sales_in_past_year_sql);
		if (mysqli_num_rows($rows) > 0) {
			return $rows;
		}
		else {
			return "Orders not found.";
		}
    }
?>
