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
        $in_stock_sql = "";
        execute_query($connection, $in_stock_sql);
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

        $get_item_sql = "";
        execute_query($connection, $get_item_sql);
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

    function create_order_item($orderId, $isbn, $quantity, $price) {
        $connection = create_connection();

        $create_order_item_sql = "";
        $execute_query($connection, $create_order_item_sql);
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

        $update_status_sql = "";
        execute_query($connection, $update_status_sql);
    }

    function find_all_orders_by_username($username) {
        $connection = create_connection();

        $find_all_orders_by_username_sql = "select Orders.UserName, Orders.OrderID, Orders.Status, Orders.Time, Orders.Total, OrderItems.ISBN, OrderItems.OPrice, OrderItems.Qty, Item.Name 
		from Orders AS o
		join OrderItems AS oi
		on o.OrderID = oi.OrderID
		join Item AS i
		on oi.ISBN = i.ISBN
		where o.UserName = $username;";
        $rows = execute_query($connection, $find_all_orders_by_username_sql);
		if (mysqli_num_rows($rows) > 0) {
			return $rows;
		}
		else {
			return "Orders not found.";
		}
    }

    function add_item_to_inventory($isbn, $quantity, $price, $type, $name, $promotion) {
        $connection = create_connection();

        $add_item_sql = "";
        execute_query($connection, $add_item_sql);
    }
	
	function find_all_orders_by_status($status) {
        $connection = create_connection();
		$status != 'All' ?: $status = "*"; 
		
        $get_order_status_sql = "select Orders.UserName, Orders.OrderID, Orders.Status, Orders.Time, Orders.Total, OrderItems.ISBN, OrderItems.OPrice, OrderItems.Qty, Item.Name 
		from Orders AS o
		join OrderItems AS oi
		on o.OrderID = oi.OrderID
		join Item AS i
		on oi.ISBN = i.ISBN
		where o.Status = $status;";
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

        $find_all_by_date_sql = "select Orders.UserName, Orders.OrderID, Orders.Status, Orders.Time, Orders.Total, OrderItems.ISBN, OrderItems.OPrice, OrderItems.Qty, Item.Name 
		from Orders AS o
		join OrderItems AS oi
		on o.OrderID = oi.OrderID
		join Item AS i
		on oi.ISBN = i.ISBN
		where o.Time BETWEEN to_date($date1, \'mm/dd/yyyy\') AND to_date($date2, \'mm/dd/yyyy\');";
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

        $find_all_by_order_id_sql = "select Orders.UserName, Orders.OrderID, Orders.Status, Orders.Time, Orders.Total, OrderItems.ISBN, OrderItems.OPrice, OrderItems.Qty, Item.Name 
		from Orders AS o
		join OrderItems AS oi
		on o.OrderID = oi.OrderID
		join Item AS i
		on oi.ISBN = i.ISBN
		where o.OrderID = $orderId;";
        $rows = execute_query($connection, $find_all_by_order_id_sql);
		if (mysqli_num_rows($rows) > 0) {
			return $rows;
		}
		else {
			return "Orders not found.";
		}
    }
?>