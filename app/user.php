<?php
    // These map directly to what the role column in the Users table
    const ROLE_CUSTOMER = 0;
    const ROLE_STAFF = 1;
    const ROLE_ADMIN = 2;

    session_start();

    function get_logged_in_user() {

        if(isset($_SESSION['username'])) {
            return $_SESSION['username'];
        }
        else {
            return null;
        }
    }

    function user_is_logged_in() {
        return get_logged_in_user() != null;
    }

    function is_staff($role) {
        return $role == ROLE_STAFF;
    }

    function is_admin($role) {
        return $role == ROLE_ADMIN;
    }

    function logged_in_user_is_staff() {

        if(user_is_logged_in()) {
           $username = get_logged_in_user();

           $role = get_role($username);
           return is_staff($role) || is_admin($role);
        }
        else {
            return false;
        }
    }
?>
