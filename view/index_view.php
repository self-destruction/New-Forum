<?php
session_start();
require 'core/get_all_themes_info.php';
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

    <script src="../js/main.js"></script>
</head>

<body>
<?php require 'partials/nav.php'?>

<div class="container main wrap col-md center" id="sections">

    <div class="my-content container table-container content-box center">
        <div class="row">
            <div class="col"><h2 class="heading">Все темы</h2></div>
        </div>
        <hr color="black" width="150">

        <div class="table-responsive">
            <table class="table table-hover"> <!-- table-sm table-striped -->
                <thead>
                <tr>
                    <!--<th scope="col">#</th>-->
                    <th scope="col">Название темы</th>
                    <th scope="col" class="text-center">Автор темы</th>
                    <th scope="col" class="text-center">Ответы</th>
                    <th scope="col" class="text-center">Просмотры</th>
                    <th scope="col" class="text-center">Последнее сообщение</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($themes) {
                    foreach ($themes as $theme) {
                        ?>
                            <tr onclick="document.location='<?php echo "/theme?id={$theme['id']}"; ?>'" class="trClickable">
                                <!--<th scope="row">1</th>-->
                                <td><?php echo $theme['title'] ?></td>
                                <td class="text-center"><?php echo $theme['login'] ?></td>
                                <td class="text-center">26</td>
                                <td class="text-center">11 587</td>
                                <td class="text-center">
                                    <div class="gray"><small>Вс, 19 авг 2018 20:31</small></div>
                                    от xclubasex Wap
                                </td>
                            </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php require 'partials/footer.php'?>
<script>console.log(<?php echo json_encode($themes); ?>);</script>
<script>console.log(<?php echo json_encode($exception); ?>);</script>
</body>
</html>
