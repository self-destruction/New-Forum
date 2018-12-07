<nav class="navbar navbar-expand-md navbar-dark fixed-top site-header">
    <a class="navbar-brand" href="/" role="button">Кулинарный форум</a>

    <div class="mr-auto">
    </div>
    <?php
    if (!isset($_SESSION['login'])) {
        ?>
        <a id="btnSignin" class="btn btn-outline-success my-2 my-sm-0" href="/sign_in" role="button">Войти</a>
        <?php
    } else {
        ?>
        <div>
            <a id="btnCreateTheme" class="btn my-2 my-sm-0 btn-primary btn-block" href="/create_theme" role="button">+ Создать тему</a>
        </div>
        <div class="mx-sm-1">
            <a id="personPage" class="btn btn-outline-light my-2 my-sm-0 btn-light btn-block" href="/person<?php echo "?login={$_SESSION['login']}"; ?>" role="button">Мой аккаунт</a>
        </div>
        <form method="post" action="../core/session_destroy.php">
            <button class="btn btn-outline-danger my-2 my-sm-0 btn-danger btn-block" type="submit">Выйти</button>
        </form>
        <?php
    }
    ?>
</nav>