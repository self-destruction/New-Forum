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

    <title>Кулинарный форум</title>

    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/index.css" rel="stylesheet">
    <link href="../css/person.css" rel="stylesheet">

    <script src="../js/main.js"></script>
</head>

<body>
<?php require 'partials/nav.php'?>

<div class="container main wrap col-md center" id="sections">

    <div class="my-content container table-container content-box center">
        <h2 class="heading">Страница пользователя</h2>
        <hr color="black" width="150">

        <div class="table-responsive">
            <h2 class="blog-post-title"><a href="#">Ahdrey344</a></h2>
            <p class="blog-post-meta">Andree1979@gmail.com</p>
            <p class="blog-post-meta">January 1, 2014</p>
            <hr>
            <p >Я начинающий кулинар.</p>
            <hr>
        </div>
    </div>

</div>

<?php require 'partials/footer.php'?>
</body>
</html>
