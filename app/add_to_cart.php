<?php
    include 'cart.php';

    $isbn = $_POST['isbn'];
    $quantity = $_POST['quantity'];
    
    add_item_to_cart($isbn, $quantity); 
?>
