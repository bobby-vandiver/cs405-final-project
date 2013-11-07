<?php
    function create_connection() {
        $config = parse_ini_file("database.ini");
    
        // Get the connection params
        $username = $config['username'];
        $password = $config['password'];
        $database = $config['database'];
        $host = $config['host'];
        $port = $config['port'];
    
        return mysqli_connect($host, $username, $password, $database, $port);
    }

    // Utility function to perform a query so this is
    // the only script that talks to the database
    function execute_query($connection, $sql) {
        if($connection) {
            printf("sql: %s</br>", $sql);
            return mysqli_query($connection, $sql);
        }
    }
?>
