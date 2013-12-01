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

    <div class="container">
        <div class="row">
            <div class="span3" style="float: none; margin: 0 auto;">
                <table class="table table-bordered table-striped">
                    <tr><td>Name: <?php echo $item['name']; ?></td></tr>
                    <tr><td>Price: <?php echo effective_price($item['price'], $item['promotion']); ?></td></tr>
                    <?php
                        if(user_is_logged_in()) { ?>
                        <tr><td>Views: <?php echo $views; ?></td></tr>
                    <?php } ?>
                </table>
                <form class="form-inline" role="form" id="add_to_cart_form">
                    <div class="form-group">
                        <input type="number" class="form-control" id="quantity_to_add" min="1" value="1">
                    <?php
                        if(user_is_logged_in()) { ?>
                        <button type="button" class="btn btn-default" type="submit" id="add_button">Add to Cart</button>
                    <?php } ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>

    <script>
        $("#add_button").click(function() {
            var quantity = $("#quantity_to_add").val();
            var isbn = <?php echo "'$isbn'"; ?>;
            
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
