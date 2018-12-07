<?php

require 'db_connect.php';

try {
    $db = new dbConnect();
    $themes = $db->getAllThemes();
} catch (Exception $exception) {

}