<?php

require_once '../db_functions/db_connect.php';

session_start();

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

//$db = new db_connect();
//$db->insert_user($name, $email, $username, $password);
$_SESSION['email'] = $email;

header("Location: {$_SERVER["HTTP_ORIGIN"]}");