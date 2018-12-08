<?php

require 'db_connect.php';

$query = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), '/');

parse_str($query, $output);

if (isset($output['id']) && $output['id'] !== '') {
    try {
        $db = new dbConnect();
        $theme = $db->getThemeById($output['id']);
    } catch (Exception $exception) {

    }
}