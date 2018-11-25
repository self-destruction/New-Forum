<?php

require 'db_connect.php';

$query = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), '/');

parse_str($query, $output);

if (isset($output['login']) && $output['login'] !== '') {
    try {
        $db = new dbConnect();
        $person = $db->getPersonByLogin($output['login']);
    } catch (Exception $exception) {

    }
}