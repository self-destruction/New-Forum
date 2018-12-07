<?php

require_once 'core/db_connect.php';

session_start();

$theme_title = $_POST["theme_title"];
$login = $_SESSION['login'];

try {
    $db = new dbConnect();
    $person = $db->getPersonByLogin($login);
    $db->insertThemeByPerson($theme_title, $person);
} catch (PDOException $exception) {
    echo json_encode(['isSuccess' => false, 'errorCode' => 1]);
    return;
} catch (Exception $exception) {
    echo json_encode(['isSuccess' => false, 'errorCode' => $exception->getCode()]);
    return;
}

echo json_encode(['isSuccess' => true, 'errorCode' => null]);