<?php
require 'core/get_person_info.php';
session_start();
if (!$person) {
    header("Location: /");
}
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
    <link href="../css/person.css" rel="stylesheet">
    <link href="../css/index.css" rel="stylesheet">

    <script src="../js/main.js"></script>
</head>

<body>
<?php require 'partials/nav.php';?>
<div class="container main wrap col-md center" id="sections">

    <div class="my-content container table-container content-box center">
        <h2 class="heading">Страница пользователя</h2>
        <hr color="black" width="150">
        <hr class="my-4">

        <div class="container table-responsive">
            <div class="my-div p-2 pl-3 text-left">
                <label for="login">Логин:</label>
                <div><h5 class="blog-post-title"><?php echo $person['login']?></h5></div>
            </div>
            <div class="my-div p-2 pl-3 text-left">
                <label for="login">E-mail:</label>
                <div><h5 class="blog-post-title"><?php echo $person['email']?></h5></div>
            </div>
            <hr>
            <div class="my-div p-2 pl-3 text-left">
                <label for="login">Описание:</label>
                <div><h5 class="blog-post-title"><?php echo $person['description']?></h5></div>
            </div>
            <hr class="my-3">
        </div>
    </div>

</div>

<?php require 'partials/footer.php'?>
<script>console.log(<?php echo json_encode($person); ?>);</script>
</body>
</html>
