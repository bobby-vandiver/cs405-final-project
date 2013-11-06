<?php
    include 'database.php';

    function create_user($username, $password, $role, $houseNumber, $street, $city, $state, $zip) {
        $create_user_sql = "";
        execute_query($create_user_sql);
    }
    
    function user_exists($username) {
        $user_exists_sql = "";
        execute_query($create_user_sql);
    }

    function valid_password($username, $password) {
        $password_sql = "";
        execute_query($password_sql);
    }
?>
