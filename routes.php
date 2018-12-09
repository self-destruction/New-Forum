<?php

//require 'core';

$router->define([
    ''                  => 'controller/index.php',
    'sign_in'           => 'controller/sign_in.php',
    'sign_in_post'      => 'controller/sign_in_post.php',
    'registration'      => 'controller/register.php',
    'register_post'     => 'controller/register_post.php',
    'person'            => 'controller/person.php',
    'create_theme'      => 'controller/create_theme.php',
    'create_theme_post' => 'controller/create_theme_post.php',
    'theme'             => 'controller/theme.php',
    'message_post'      => 'controller/message_post.php',
]);