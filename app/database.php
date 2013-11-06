<?php
    $config = parse_ini_file("database.ini");

    // Get the connection params
    $username = $config['username'];
    $password = $config['password'];
    $database = $config['database'];
    $host = $config['host'];
    $port = $config['port'];

    $database_connection = mysqli_connect($host, $username, $password, $database, $port);

    // Utility function to perform a query so this is
    // the only script that talks to the database
    function execute_query($sql) {
        if($database_connection) {
            return mysqli_query($database_connection, $sql);
        }
    }
?>
