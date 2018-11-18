<?php

require_once '../db_functions/db_connect.php';

session_start();

$email = $_POST["email"];
$password = $_POST["password"];

try {
    $db = new dbConnect();
    $db->selectUser($email, $password);
} catch (PDOException $exception) {
    echo json_encode(['isSuccess' => false, 'errorCode' => 1]);
    return;
} catch (Exception $exception) {
    echo json_encode(['isSuccess' => false, 'errorCode' => $exception->getCode()]);
    return;
}

$_SESSION['email'] = $email;
echo json_encode(['isSuccess' => true, 'errorCode' => null]);