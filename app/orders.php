<?php
    require_once 'bootstrap.php';
    head("Orders");

    const PENDING = 0;
    const SHIPPED = 1;

    function status_to_string($status) {
        if($status == PENDING) {
            return "Pending";
        }
        else {
            return "Shipped";
        }
    }
 ?>

<body>
    <?php
        require_once 'navbar.php';
        require_once 'auth-utils.php';

        redirect_if_not_customer();
    ?>
    <div class="container">

    <?php
        $username = get_logged_in_user();
        
        if(!user_has_orders($username)) {
    ?>
            <h2>No orders</h2>
    <?php }
        else {
            $orders = find_all_order_summaries_by_username($username);
   
            echo "<div class=\"row\">";

            while($order = mysqli_fetch_array($orders)) {

                $order_id = $order['orderId'];
                $items = get_order_items($order_id);
                
                echo "<div class=\"span3\" style=\"float: none; margin: 0 auto;\">";
                
                echo "<table id=\"order-$order_id-header\" class=\"table table-striped table-bordered\">";
                echo "  <thead>";
                echo "      <tr>";
                echo "          <th>Order #" . $order_id . "</th>";
                echo "          <th>Status: " . status_to_string($order['status']) . "</th>";
                echo "          <th>Total: $" . $order['total'] . "</th>";
                echo "      </tr>";
                echo "  </thead>";
                echo "</table>";

                echo "<table id=\"order-$order_id-details\" class=\"table table-striped table-bordered\">";
                echo "  <caption>Order #$order_id Details</caption>";
                echo "  <thead>";
                echo "      <tr>";
                echo "          <th>ISBN</th><th>Quantity</th><th>Sale Price</th>";
                echo "      </tr>";
                echo "  </thead>";
                echo "  <tbody>";

                while($item = mysqli_fetch_array($items)) {
                    echo "      <tr>";
                    echo "          <td>" . $item['isbn'] . "</td>";
                    echo "          <td>" . $item['quantity'] . "</td>";
                    echo "          <td>" . $item['salePrice'] . "</td>";
                    echo "      </tr>";
                }

                echo "  </tbody>";
                echo "</table>";
                echo "</div>";
            }
            echo "</div>";
        }
    ?>    

   </div>

</body>
</html>
