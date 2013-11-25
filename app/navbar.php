<?php
    // Ensure all pages can query the database
    include 'query.php';
    include 'user.php';

    function display_login_or_welcome() {
        
        if(user_is_logged_in()) {
            echo "<li><a href=\"#\">Welcome back, " . $_SESSION['username'] . "</a></li>";
            echo "<li><a href=\"logout.php\">Logout</a></li>";
        }
        else {
            echo "<li><a href=\"sign-in.php\">Login</a></li>";
        }
    }
	
	function display_customer_only_links() {
		if(logged_in_user_is_customer()) {
			echo "<li><a href=\"orders.php\">Orders</a></li>";
		    echo "<li><a href=\"purchase.php\">Checkout</a></li>";
        }
	}

    function display_staff_links() {
        if(logged_in_user_is_staff()) {
			echo "<li><a href=\"inventory.php\">Inventory</a></li>";
			echo "<li><a href=\"staff_orders.php\">Orders Lookup</a></li>";
        }
    }
	
	function display_admin_links() {
		if(logged_in_user_is_admin()) {
			echo "<li><a href=\"statistics.php\">Statistics</a></li>";
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
                    <?php display_customer_only_links(); ?>
                    <?php display_staff_links(); ?>
					<?php display_admin_links(); ?>
                    <?php display_login_or_welcome(); ?>
               </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>
