<?php

require 'core/Router.php';
$router = new Router();
require 'routes.php';
require $router->direct(trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));