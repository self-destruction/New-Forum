<?php

require_once '../db_functions/db_connect.php';

session_start();

$login = $_POST["login"];
$email = $_POST["email"];
$password = $_POST["password"];


$db = new dbConnect();
$success = $db->insertUser($email, $login, $password);

if ($success) {
    $_SESSION['email'] = $email;
    header("Location: {$_SERVER["HTTP_ORIGIN"]}");
} else {
    $loc = $_SERVER["HTTP_ORIGIN"] . '/register/register.html';
//    echo "<script>console.log('Не удалось зарегистрировать!');</script>";
    header("Location: {$loc}");
}

//header("Location: {$_SERVER["HTTP_ORIGIN"]}");