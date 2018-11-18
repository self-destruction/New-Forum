<?php

require_once '../db_functions/db_connect.php';

session_start();

$email = $_POST["email"];
$password = $_POST["password"];

try {
    $db = new dbConnect();
    $db->selectUser($email, $password);
} catch (Exception $exception) {
    echo json_encode(['isSuccess' => false, 'errorCode' => $exception->getCode()]);
    return;
}

//if ($success) {
    $_SESSION['email'] = $email;
echo json_encode(['isSuccess' => true, 'errorCode' => null]);
//    header("Location: {$_SERVER["HTTP_ORIGIN"]}");
//} else {
//    $loc = $_SERVER["HTTP_ORIGIN"] . '/sign_in/sign_in.html';
//    header("Location: {$loc}");
////    echo "<script>alert('Неверный email или пароль!');</script>";
//}

//header("Location: {$_SERVER["HTTP_ORIGIN"]}");