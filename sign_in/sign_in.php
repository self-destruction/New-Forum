<?php

require_once '../db_functions/db_connect.php';

session_start();

$email = $_POST["email"];
$password = $_POST["password"];

$db = new dbConnect();
$success = $db->selectUser($email, $password);

if ($success) {
    $_SESSION['email'] = $email;
    header("Location: {$_SERVER["HTTP_ORIGIN"]}");
} else {
    $loc = $_SERVER["HTTP_ORIGIN"] . '/sign_in/sign_in.html';
    header("Location: {$loc}");
//    echo "<script>alert('Неверный email или пароль!');</script>";
}

//header("Location: {$_SERVER["HTTP_ORIGIN"]}");