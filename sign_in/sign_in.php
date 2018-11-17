<?php

session_start();

$email = $_POST["email"];
$password = $_POST["password"];

$_SESSION['email'] = $email;

header("Location: {$_SERVER["HTTP_ORIGIN"]}");