<?php
    include 'bootstrap.php';
    head("Item");
?>

<body>
    <?php
        include 'navbar.php';
    
        $isbn = $_GET['isbn'];
        $item = get_item($isbn);

        $views = 0;

        // Update the user's browsing history if they're logged in
        if(user_is_logged_in()) {
            $username = get_logged_in_user();
            update_browsing_history($username, $isbn);
            $views = item_views($username, $isbn);
        }

        function effective_price($price, $promotion) {
            $total = $price * $promotion;
            return number_format($total, 2, '.', ',');
        }
    ?>

    <div class="container" style="text-align:center">
        <div class="row">
            <div>Name: <?php echo $item['name']; ?></div>
            <div>Price: <?php echo effective_price($item['price'], $item['promotion']); ?></div>
            <div>Views: <?php echo $views; ?></div>
        </div>
        <form class="form-inline" role="form" id="add_to_cart_form">
            <div class="form-group">
                <input type="number" class="form-control" id="quantity_to_add" min="1" value="1">
                <button type="button" class="btn btn-default" type="submit" id="add_button">Add to Cart</button>
            </div>
        </form>
    </div>
    
    <?php include 'footer.php'; ?>

    <script>
        $("#add_button").click(function() {
            var quantity = $("#quantity_to_add").val();
            var isbn = <?php echo $isbn; ?>;
            
            $.post("add_to_cart.php", { 'isbn': isbn, 'quantity': quantity })
                .done(function() {
                    alert ("Added " + quantity + " to your cart");
                })
                .fail(function() {
                    alert("An error occurred.");
                });
        });
    </script>

</body>
</html>
