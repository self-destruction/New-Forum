<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../static/favicon.ico">

    <title>Создание темы</title>

    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/register.css" rel="stylesheet">

    <script src="../js/main.js"></script>
</head>

<body class="text-center">
<?php require 'partials/nav.php'?>

<div class="my-content container table-container content-box center">
    <div id="registrationAction" class="form-signin">
        <h1 class="h3 mb-3 py-3 font-weight-normal" id="createThemeText">Создание темы</h1>
        <div class="form-group text-left">
            <label for="theme_title">Название темы</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="theme_title" id="theme_title" placeholder="Название темы" required autofocus/>
            </div>
        </div>
        <button class="mt-5 mb-3 btn btn-lg btn-success btn-block" id="submit" type="submit">Создать</button>
    </div>
</div>

<script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="../dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/create_theme.js"></script>
</body>
</html>
