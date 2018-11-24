<?php

session_start();

$email = $_SESSION['email'];

if (isset($email)) {
    echo json_encode(['isSuccess' => true, 'data' => ['email' => '123@123.ru', 'login' => 'login_test'], 'errorCode' => null]);
} else {
    echo json_encode(['isSuccess' => false, 'data' => [], 'errorCode' => 1]);
}