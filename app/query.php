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
        $in_stock_sql = "";
        execute_query($in_stock_sql);
    }

    function item_views($username, $isbn) {
        $item_views_sql = "";
        execute_query($item_views_sql);
    }

    function update_browsing_history($username, $isbn) {
        $views = item_views($username, $isbn);
        
        if($views > 0) {
            $increment_item_view_sql = "";
            execute_query($increment_item_view_sql);
        }
        else {
            $create_item_view_sql = "";
            execute_query($create_item_view_sql);
        }
    }

    function get_item($isbn) {
        $get_item_sql = "";
        execute_query($get_item_sql);
    }

    function get_all_items() {
        $get_all_items_sql = "";
        execute_query($get_all_items_sql);
    }

    // =====================
    // Order related queries
    // =====================

    function create_order($orderId, $status, $time, $total, $username) {
        $create_order_sql = "";
        execute_query($create_order_sql);
    }

    function create_order_item($orderId, $isbn, $quantity, $price) {
        $create_order_item_sql = "";
        $execute_query($create_order_item_sql);
    }

    function update_order_item_quantity($orderId, $isbn, $quantity) {
        $update_quantity_sql = "";
        execute_query($update_quantity_sql);
    }

    function get_order_status($orderId) {
        $get_order_status_sql = "";
        execute_query($get_order_status_sql);
    }

    function update_order_status($orderId, $status) {
        $update_status_sql = "";
        execute_query($update_status_sql);
    }

    function find_all_orders_by_username($username) {
        $find_all_orders_sql = "";
        execute_query($find_all_orders_sql);
    }

    function add_item_to_inventory($isbn, $quantity, $price, $type, $name, $promotion) {
        $add_item_sql = "";
        execute_query($add_item_sql);
    }

    function find_all_orders_by_date($date) {
        $find_all_by_date_sql = "";
        execute_query($find_all_by_date_sql);
    }

    function find_all_order_items_by_order_id($orderId) {
        $find_all_by_order_id_sql = "";
        execute_query($find_all_by_order_id_sql);
    }
?>
