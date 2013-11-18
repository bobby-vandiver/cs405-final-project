<?php
    include 'query.php';
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(user_exists($username) === TRUE) {
        if(valid_password($username, $password)) {
            $_SESSION['username'] = $username;
        }
    }

    header('Location: index.php');
    exit;
?>
