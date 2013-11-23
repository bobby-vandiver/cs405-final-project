<?php
    include 'bootstrap.php';

   $inline_css = '<style>body { padding-top: 60px; } </style>';
 
    head("Items", $inline_css);

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
                    echo "  <td>" . $row['name'] . "</td>";
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
