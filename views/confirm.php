<?php

if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = base64_decode($_GET['email']);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    $token = $_GET['token'];
    $user->confirmEmail($token, $email);

    header('Location:./login');
} else {
    header("Location:./login");
    exit;
}
