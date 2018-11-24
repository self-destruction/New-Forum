<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../static/favicon.ico">

    <title>Вход в учётную запись</title>

    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../sign_inPage/sign_in.css" rel="stylesheet">

    <script src="../js/main.js"></script>
</head>

<body class="text-center">
<?php require 'partials/sign_register/nav.php'?>

<div class="my-content container table-container content-box center">
    <div id="signinAction" class="form-signin">
        <h1 class="h3 mb-3 py-3 font-weight-normal" id="signinText">Вход в учётную запись</h1>
        <label for="email" class="sr-only">Электронная почта</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Электронная почта" required autofocus>
        <label for="password" class="sr-only">Пароль</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Пароль" required/>
        <button class="btn btn-lg btn-primary btn-block" id="submit" type="submit">Вход</button>
        <div class="py-1">
            <label>Впервые здесь?</label>
            <a href="/registration">Зарегистрируйся</a>
        </div>
        <p id="copyright_year" class="mt-5 mb-3 text-muted"></p>
    </div>
</div>

<script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../sign_inPage/sign_in.js"></script>
</body>
</html>
