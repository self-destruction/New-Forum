<?php

require_once 'core/db_connect.php';
require_once 'core/get_date.php';

session_start();

$message = $_POST["message"];
$theme_id = $_POST["theme_id"];
$login = $_SESSION['login'];

$query = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), '/');

try {
    $db = new dbConnect();
    $person = $db->getPersonByLogin($login);
    $msg = $db->insertMessageByPerson($message, $theme_id, $person);

} catch (PDOException $exception) {
    echo json_encode(['isSuccess' => false, 'errorCode' => 1]);
    return;
} catch (Exception $exception) {
    echo json_encode(['isSuccess' => false, 'errorCode' => $exception->getCode()]);
    return;
}

//echo json_encode(['message from ' . __FILE__ => ['message' => $message, 'login' => $login, 'theme' => $_SERVER['REQUEST_URI']]], true);
//echo json_encode(['$msg' => $msg]);
echo json_encode(['isSuccess' => true, 'errorCode' => null, 'person' => $person, 'message_date' => getBeautifulDate($msg['createdAt'])]);