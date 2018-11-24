<nav class="navbar navbar-expand-md navbar-dark fixed-top site-header">
    <a class="navbar-brand" href="/" role="button">Кулинарный форум</a>

    <div class="mr-auto">
    </div>
    <?php
    if (!isset($_SESSION['email'])) {
        ?>
        <a id="btnSignin" class="btn btn-outline-success my-2 my-sm-0" href="/sign_in" role="button">Войти</a>
        <?php
    } else {
        ?>
        <div>
            <a id="personPage" class="btn btn-outline-light my-2 my-sm-0 btn-light btn-block" href="/person" role="button">Мой аккаунт</a>
        </div>
        <form method="post" action="../core/session_destroy.php">
            <button class="btn btn-outline-danger my-2 my-sm-0 btn-danger btn-block" type="submit">Выйти</button>
        </form>
        <?php
    }
    ?>
</nav>