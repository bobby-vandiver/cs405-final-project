<?php
    // Ensure all pages can query the database
    include 'query.php';

    function display_login_or_welcome() {
        session_start();
        
        if(isset($_SESSION['username'])) {
            // TODO: Do this the right way
            echo "<li><a href=\"#\">Welcome back, " . $_SESSION['username'] . "</a></li>";
            echo "<li><a href=\"logout.php\">Logout</a></li>";
        }
        else {
            echo "<li><a href=\"sign-in.php\">Login</a></li>";
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
                    <?php display_login_or_welcome(); ?>
               </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>
