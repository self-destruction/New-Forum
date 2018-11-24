<?php

//require 'core';

$router->define([
    '' => 'controller/index.php',
    'sign_in' => 'controller/sign_in.php',
    'sign_in_post' => 'controller/sign_in_post.php',
    'registration' => 'controller/register.php',
    'register_post' => 'controller/register_post.php',
    'person' => 'controller/person.php',
]);