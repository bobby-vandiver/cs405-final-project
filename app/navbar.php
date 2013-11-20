<?php
    // Ensure all pages can query the database
    include 'query.php';
    include 'consts.php';

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

    function display_login_or_welcome() {
        
        if(user_is_logged_in()) {
            // TODO: Do this the right way
            echo "<li><a href=\"#\">Welcome back, " . $_SESSION['username'] . "</a></li>";
            echo "<li><a href=\"logout.php\">Logout</a></li>";
        }
        else {
            echo "<li><a href=\"sign-in.php\">Login</a></li>";
        }
    }

    function display_staff_links() {
        if(logged_in_user_is_staff()) {
            echo "<li><a href=\"staff.php\">Staff Stuff</a></li>";
        }
    }
?>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="brand" href="index.php">BJ's Toys and Games</a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="items.php">Items</a></li>
                    <li><a href="orders.php">Orders</a></li>
                    <?php display_staff_links(); ?>
                    <?php display_login_or_welcome(); ?>
               </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>
