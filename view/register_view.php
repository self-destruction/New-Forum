<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../static/favicon.ico">

    <title>Регистрация учётной записи</title>

    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/register.css" rel="stylesheet">

    <script src="../js/main.js"></script>
</head>

<body class="text-center">
<?php require 'partials/sign_register/nav.php'?>

<div class="my-content container table-container content-box center">
    <div id="registrationAction" class="form-signin">
        <h1 class="h3 mb-3 py-3 font-weight-normal" id="registrationText">Регистрация</h1>
        <div class="form-group text-left">
            <label for="login">Логин</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="login" id="login" placeholder="Введите Ваш логин" required autofocus/>
            </div>
        </div>
        <div class="form-group text-left">
            <label for="email">Адрес электронной почты</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="email" id="email" placeholder="Введите Вашу электронную почту" required autofocus/>
            </div>
        </div>
        <div class="form-group has-danger text-left">
            <label for="password">Пароль</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                <input type="password" class="form-control" name="password" id="password" onchange="validatePassword()" placeholder="Введите пароль" required/>
            </div>
        </div>
        <div class="form-group text-left">
            <label for="confirm">Подтверждение пароля</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                <input type="password" class="form-control" name="confirm" id="confirm" onkeyup="validatePassword()" placeholder="Подтвердите пароль"/>
            </div>
        </div>
        <button class="mt-5 mb-3 btn btn-lg btn-success btn-block" id="submit" type="submit">Зарегистрировать</button>
    </div>
</div>

<script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="../dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/register.js"></script>
</body>
</html>
