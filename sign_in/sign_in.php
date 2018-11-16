<?php

if (empty($_SESSION['count'])) {
    $_SESSION['count'] = 1;
} else {
    $_SESSION['count'] = 100;
}

$email = $_POST["email"];
$password = $_POST["password"];

$_SESSION["email"] = $email;

//echo "<script>alert( 'Debug Objects: " . $_SESSION["email"] . "' );</script>";

header("Location: {$_SERVER["HTTP_ORIGIN"]}");