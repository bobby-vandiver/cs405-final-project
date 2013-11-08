<?php
    include 'query.php';

//    $result = user_exists("bob");
//    $flag = ($result) ? 'true' : 'false';
//    echo "<p>bob exists: $flag</p>";

    create_user("bob", "foo", 0, 1342, "524 atlee dr", "turdsburg", "ky", "40330");

    $invalid = valid_password("bob", "bar");
    printf("bar: %s</br>", ($invalid) ? 'true' : 'false');
    
    $valid = valid_password("bob", "foo");
    printf("foo: %s</br>", ($valid) ? 'true' : 'false');
 

    $role = get_role("bob");
    printf("role: %s</br>", $role);


//    $result = user_exists("bob");
//    $flag = ($result) ? 'true' : 'false';
//    echo "<p>bob exists after create: $flag</p>";
?>
