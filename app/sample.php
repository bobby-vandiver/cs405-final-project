<?php
    include 'query.php';

//    $result = user_exists("bob");
//    $flag = ($result) ? 'true' : 'false';
//    echo "<p>bob exists: $flag</p>";

    create_user("bob", "foo", 0, 1342, "524 atlee dr", "turdsburg", "ky", "40330");

//    $result = user_exists("bob");
//    $flag = ($result) ? 'true' : 'false';
//    echo "<p>bob exists after create: $flag</p>";
?>
