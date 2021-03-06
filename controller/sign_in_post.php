<?php

require_once 'core/db_connect.php';

session_start();

$email = $_POST["email"];
$password = $_POST["password"];

try {
    $db = new dbConnect();
    $login = $db->selectLogin($email, $password);
} catch (PDOException $exception) {
    echo json_encode(['isSuccess' => false, 'errorCode' => 1]);
    return;
} catch (Exception $exception) {
    echo json_encode(['isSuccess' => false, 'errorCode' => $exception->getCode()]);
    return;
}

$_SESSION['login'] = $login;
echo json_encode(['isSuccess' => true, 'errorCode' => null]);