<?php
  include 'bootstrap.php';
  head("BJ's Toys and Games");
?>

<body>

    <?php
        include 'navbar.php';
        require_once 'item-utils.php';

        const RECOMMENDED_ITEMS_COUNT = 5;
        
        function get_recommended_items($username) {
            $average_price = (average_price_of_viewed_items($username) + average_price_of_ordered_items($username)) / 2;

            $toys_count = (toys_viewed($username) + ordered_toys_count($username));
            $games_count = (games_viewed($username) + ordered_games_count($username));

            $type = ($toys_count > $games_count) ? TOY : GAME;

            return top_items_at_or_below_price($average_price, $type, RECOMMENDED_ITEMS_COUNT);
        }
    ?>

    <div class="container">

        <h1>Welcome to BJ's Toys and Games</h1>

        <p>Inside you'll find a selection of premium toys and games created in our overseas factories. You can buy with confidence knowing that all of our items are kid safe and kid friendly. All of our items are built by kids. For kids.</p>

        <?php
            if(user_is_logged_in() && logged_in_user_is_customer()) {
                $username = get_logged_in_user();
                $recommended_items = get_recommended_items($username);

                if(count($recommended_items) > 0) {
                    echo "<h3>Recommended Items for You, $username.</h3>";
        ?>

                <div class="row">
                    <div class="span3" style="float: none; margin: 0 auto;">
                      <table class="table table-striped table-bordered">
                          <thead>
                              <tr>
                              <th>Name</th>
                              <th>Price</th>
                              <th>Type</th>
                              </tr>
                          </thead>
                          <tbody>
        <?php
                    
                    while($next = mysqli_fetch_array($recommended_items)) {
                        $item = get_item($next['isbn']);
                        
                        echo "<tr>";
                        echo "  <td><a href=\"item.php?isbn=" . $item['isbn'] . "\">" . $item['name'] . "</a></td>";
                        echo "  <td>" . $item['price'] . "</td>";
                        echo "  <td>" . type_to_string($item['type']) . "</td>";
                        echo "</tr>";
                    }
        ?>
                        </tbody>
                    </table>
                  </div>
                </div>
         <?php
                }
            }
        ?>
    </div>

    <?php include 'footer.php'; ?>

  </body>
</html>
