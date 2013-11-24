<?php
    include 'bootstrap.php';
    head("Items");

    const TOY = 0;
    const GAME = 1;

    function type_to_string($type) {
        if($type == TOY) {
            return "Toy";
        }
        else {
            return "Game";
        }
    }
 ?>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <table id="items_table" class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $items = get_all_items_in_stock();

                while($row = mysqli_fetch_array($items)){
                    echo "<tr>";
                    echo "  <td><a href=\"item.php?isbn=" . $row['isbn'] ."\">" . $row['name'] . "</a></td>";
                    echo "  <td>" . $row['price'] . "</td>";
                    echo "  <td>" . type_to_string($row['type']) . "</td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
    </div>

</body>
</html>
