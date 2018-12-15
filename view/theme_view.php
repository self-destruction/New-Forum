<?php
require 'core/get_date.php';
require 'core/get_theme.php';
session_start();
if (!$theme) {
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

    <title>Тема</title>

    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/index.css" rel="stylesheet">

    <script src="../js/main.js"></script>
</head>

<body>
<?php require 'partials/nav.php'?>

<div class="container main wrap col-md center" id="sections">

  <div class="my-content container table-container content-box center">
    <h2 class="heading"><?php echo $theme['title'];?></h2>
    <hr color="black" width="150">

    <div class="table-responsive">
      <table class="tableTheme table table"> <!-- table-sm table-striped -->
        <thead>
        <tr class="d-flex">
          <td class="col-3 text-center">
            <a href="/person<?php echo "?login={$theme['login']}"; ?>"><?php echo $theme['login']?></a><br>
              <small><?php echo getBeautifulDate($theme['createdAt']);?></small>
          </td>
          <td class="col">
            <div class="align-text-top text-left">
              <?php echo $theme['description'];?>
            </div>
          </td>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($messages) {
          foreach ($messages as $message) { ?>
            <tr class="d-flex">
              <td class="col-3 text-center">
                <a href="/person<?php echo "?login={$message['user']['login']}"; ?>"><?php echo $message['user']['login'] ?></a><br>
                  <small><?php echo getBeautifulDate($message['createdAt']); ?></small>
                </td>
                <td class="col">
                  <div class="align-top text-left">
                    <?php echo $message['text']; ?>
                  </div>
              </td>
            </tr>
            <?php
          }
        }
        ?>

        </tbody>
      </table>
      <?php
        if (isset($_SESSION['login'])) {
        ?>
      <div class="mx-2">
        <div class="mb-3">
          <label for="messageArea">Текст вашего сообщения</label>
          <textarea class="form-control" id="messageArea" rows="3" placeholder="Введите текст" required autofocus minlength="1" maxlength="1000"></textarea>
          <div class="mt-1 text-right">
            <button id="submit" type="submit" class="btn btn-success">Отправить</button>
          </div>
        </div>
      </div>
      <?php
        }
      ?>
    </div>
  </div>

</div>
<?php require 'partials/footer.php'?>
<script>console.log(<?php echo json_encode($theme); ?>);</script>
<script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="../dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/message_submit.js"></script>
</body>
</html>
