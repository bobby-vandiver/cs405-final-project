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

    function log_query($sql) {
        // Just dump to standard error log in case we need it later.
        // In a real world application, you would scrub the queries
        // to remove the user's password (or store an encoded password
        // instead of plain text as we have done). This would be overkill
        // for this simple assignment.
        error_log($sql);
    }

    // Utility function to perform a query so this is
    // the only script that talks to the database
    function execute_query($connection, $sql) {
        if($connection) {
            log_query($sql);
            return mysqli_query($connection, $sql);
        }
    }
?>
