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
    <link rel="icon" href="favicon.ico">

    <title>Кулинарный форум</title>

    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">

    <script src="js/main.js"></script>
</head>

<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top site-header">
    <a class="navbar-brand" href="index.php" role="button">Кулинарный форум</a>

    <div class="mr-auto">
    </div>
    <?php
    if (!isset($_SESSION['email'])) {
        ?>
        <a id="btnSignin" class="btn btn-outline-success my-2 my-sm-0" href="sign_in/sign_in.html" role="button">Войти</a>
        <?php
    } else {
        ?>
        <form method="post" action="session_destroy.php">
            <button class="btn btn-outline-danger my-2 my-sm-0 btn-danger btn-block" type="submit">Выйти</button>
        </form>
        <?php
    }
    ?>
</nav>

<div class="container main wrap col-md center" id="sections">

  <div class="my-content container table-container content-box center">
    <h2 class="heading">Все темы</h2>
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
        <tr>
          <!--<th scope="row">1</th>-->
          <td>Как приготовить пироженку</td>
          <td class="text-center">Emerald</td>
          <td class="text-center">26</td>
          <td class="text-center">11 587</td>
          <td class="text-center">
            <div class="gray"><small>Вс, 19 авг 2018 20:31</small></div>
            от <a href="">xclubasex Wap</a>
          </td>
        </tr>
        <tr>
          <!--<th scope="row">2</th>-->
          <td>Как украсить стол на Пасху</td>
          <td class="text-center">Krutoy chuvak</td>
          <td class="text-center">23</td>
          <td class="text-center">453</td>
          <td class="text-center">
            <div class="gray"><small>Пн, 27 фев 2017 23:12</small></div>
            от <a href="">Emerald</a>
          </td>
        </tr>
        <tr>
          <!--<th scope="row">3</th>-->
          <td>Бекон с мороженкой VS Пицца с ананасами</td>
          <td class="text-center">Krutoy chuvak</td>
          <td class="text-center">0</td>
          <td class="text-center">12</td>
          <td class="text-center">
            <div class="gray"><small>Чт, 27 фев 2014 01:20</small></div>
            от <a href="">mia</a>
          </td>
        </tr>
        <tr>
          <!--<th scope="row">4</th>-->
          <td>Бекон с мороженкой VS Пицца с ананасами VS Говяжий доширак VS Мадагаскарские тараканы VS Инвайт просто добавь воды</td>
          <td class="text-center">Izumrud</td>
          <td class="text-center">0</td>
          <td class="text-center">12</td>
          <td class="text-center">
            <div class="gray"><small>Чт, 27 фев 2014 01:20</small></div>
            от <a href="">mia</a>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>

<footer class="my-footer py-3 bg-dark text-light card-footer">
    <div class="row">
        <div class="col-5">
          <div class="element">
            <h4>Кто на сайте</h4>
            Всего 149,
            гостей 147,
            зарегистрированных 2
          </div>
        </div>
        <div class="col">
        </div>
        <div class="col-5">
          <h4>Контакты</h4>
          <i class="glyphicon glyphicon-envelope"></i> <a href="mailto:kuharka%40mail.ru">kuharka@mail.ru</a>
          <i class="glyphicon glyphicon-earphone"></i> +7 (925) 509-49-35
        </div>
    </div>
</footer>

<script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<!--<script>-->
    <!--let getUrlParameter = function getUrlParameter(sParam) {-->
        <!--let sPageURL = decodeURIComponent(window.location.search.substring(1)),-->
            <!--sURLVariables = sPageURL.split('&'),-->
            <!--sParameterName,-->
            <!--i;-->

        <!--for (i = 0; i < sURLVariables.length; i++) {-->
            <!--sParameterName = sURLVariables[i].split('=');-->

            <!--if (sParameterName[0] === sParam) {-->
                <!--return sParameterName[1] === undefined ? true : sParameterName[1];-->
            <!--}-->
        <!--}-->
        <!--return 'false';-->
    <!--};-->

    <!--$(document).ready(function () {-->
        <!--let isAuth = getUrlParameter('is_auth');-->
        <!--if(isAuth === 'true') {-->
            <!--$("#btnSignin").replaceWith(-->
                <!--"<a id=\"btnSignout\" class=\"btn btn-outline-danger my-2 my-sm-0\" href=\"index.php\" role=\"button\" onclick=\"function a() { document.location.href = 'index.php' }\">Выйти</a>"-->
            <!--);-->

            <!--$("#sections").prepend(-->
                <!--"<div class=\"my-content container table-container content-box center\">\n" +-->
                <!--"    <h2 class=\"heading\">Мои темы</h2>\n" +-->
                <!--"    <hr color=\"black\" width=\"150\">\n" +-->
                <!--"\n" +-->
                <!--"    <div class=\"table-responsive\">\n" +-->
                <!--"      <table class=\"table table-hover\"> &lt;!&ndash; table-sm table-striped &ndash;&gt;\n" +-->
                <!--"      <thead>\n" +-->
                <!--"      <tr>\n" +-->
                <!--"        &lt;!&ndash;<th scope=\"col\">#</th>&ndash;&gt;\n" +-->
                <!--"        <th scope=\"col\">Название темы</th>\n" +-->
                <!--"        <th scope=\"col\" class=\"text-center\">Ответы</th>\n" +-->
                <!--"        <th scope=\"col\" class=\"text-center\">Просмотры</th>\n" +-->
                <!--"        <th scope=\"col\" class=\"text-center\">Последнее сообщение</th>\n" +-->
                <!--"      </tr>\n" +-->
                <!--"      </thead>\n" +-->
                <!--"      <tbody>\n" +-->
                <!--"      <tr>\n" +-->
                <!--"        &lt;!&ndash;<th scope=\"row\">1</th>&ndash;&gt;\n" +-->
                <!--"        <td>Как украсить стол на Пасху</td>\n" +-->
                <!--"        <td class=\"text-center\">23</td>\n" +-->
                <!--"        <td class=\"text-center\">453</td>\n" +-->
                <!--"        <td class=\"text-center\">\n" +-->
                <!--"          <div class=\"gray\"><small>Пн, 27 фев 2017 23:12</small></div>\n" +-->
                <!--"          от <a href=\"\">Emerald</a>\n" +-->
                <!--"        </td>\n" +-->
                <!--"      </tr>\n" +-->
                <!--"      <tr>\n" +-->
                <!--"        &lt;!&ndash;<th scope=\"row\">2</th>&ndash;&gt;\n" +-->
                <!--"        <td>Бекон с мороженкой VS Пицца с ананасами</td>\n" +-->
                <!--"        <td class=\"text-center\">0</td>\n" +-->
                <!--"        <td class=\"text-center\">12</td>\n" +-->
                <!--"        <td class=\"text-center\">\n" +-->
                <!--"          <div class=\"gray\"><small>Чт, 27 фев 2014 01:20</small></div>\n" +-->
                <!--"          от <a href=\"\">mia</a>\n" +-->
                <!--"        </td>\n" +-->
                <!--"      </tr>\n" +-->
                <!--"      </tbody>\n" +-->
                <!--"    </table>\n" +-->
                <!--"    </div>\n" +-->
                <!--"  </div>"-->
            <!--);-->
        <!--}-->
    <!--});-->
<!--</script>-->
</body>
</html>