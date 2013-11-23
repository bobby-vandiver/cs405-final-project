<?php
    include 'query.php';
	include 'cart.php';	

//    $result = user_exists("bob");
//    $flag = ($result) ? 'true' : 'false';
//    echo "<p>bob exists: $flag</p>";

//    create_user("bob", "foo", 0, 1342, "524 atlee dr", "turdsburg", "ky", "40330");
//
//    $invalid = valid_password("bob", "bar");
//    printf("bar: %s</br>", ($invalid) ? 'true' : 'false');
//    
//    $valid = valid_password("bob", "foo");
//    printf("foo: %s</br>", ($valid) ? 'true' : 'false');
// 
//
//    $role = get_role("bob");
//    printf("role: %s</br>", $role);

	$isbn = '95';
	$item = get_item($isbn);
    var_dump($item);

    echo "</br></br>";

    $in_stock = item_in_stock($isbn);
    var_dump($in_stock);

//	add_item_to_cart($isbn, 13);

//    remove_item_in_cart($isbn);

//	var_dump($item);	
//	remove_all_items_in_cart();

//	printf("\rcookie:");
//	var_dump(get_all_items_in_cart());

//    $result = user_exists("bob");
//    $flag = ($result) ? 'true' : 'false';
//    echo "<p>bob exists after create: $flag</p>";
?>
