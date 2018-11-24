<?php

require_once 'core/db_connect.php';

session_start();

$login = $_POST["login"];
$email = $_POST["email"];
$password = $_POST["password"];

try {
    $db = new dbConnect();
    $db->insertUser($email, $login, $password);
} catch (PDOException $exception) {
    echo json_encode(['isSuccess' => false, 'errorCode' => 1]);
    return;
} catch (Exception $exception) {
    echo json_encode(['isSuccess' => false, 'errorCode' => $exception->getCode()]);
    return;
}

$_SESSION['email'] = $email;
echo json_encode(['isSuccess' => true, 'errorCode' => null]);