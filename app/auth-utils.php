<?php
    require_once 'user.php';

    function redirect_if_not_staff() {
        if(!logged_in_user_is_staff()) {
            header("HTTP/1.1 403 Forbidden");
            header("Location: index.php");
            exit;
        }
    }

    function redirect_if_not_admin() {
        if(!logged_in_user_is_admin()) {
            header("HTTP/1.1 403 Forbidden");
            header("Location: index.php");
            exit;
         }
    }
?>
