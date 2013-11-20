<?php
    include 'query.php';
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $redirect;

    if(user_exists($username) === TRUE) {
        if(valid_password($username, $password)) {
            $_SESSION['username'] = $username;
            $redirect = 'index.php';
        }
        else {
            // Return to sign in page and report errors
            $redirect = 'sign-in.php?error=true';
        }
    }
    else {
        $redirect = 'register.php';
    }

    header("Location: ${redirect}");
    exit;
?>
