<?php
    include 'query.php';
    include 'user.php';
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $houseNumber = $_POST['houseNumber'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];

    // All newly registered users are assumed to be customers
    create_user($username, $password, ROLE_CUSTOMER, $houseNumber, $street, $city, $state, $zip);

    header('Location: sign-in.php');
    exit;
?>
