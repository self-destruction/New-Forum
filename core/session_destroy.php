<?php

session_start();

unset($_SESSION['email']);

header("Location: {$_SERVER["HTTP_ORIGIN"]}");