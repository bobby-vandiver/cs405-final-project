<?php
    $config = parse_ini_file("database.ini");

    // Get the connection params
    $username = $config['username'];
    $password = $config['password'];
    $database = $config['database'];
    $host = $config['host'];
    $port = $config['port'];

    $database_connection = mysqli_connect($host, $username, $password, $database, $port);
?>
