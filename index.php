<?php 
  session_start();
  require __DIR__ . '/functions.php';
  $id = getUserId();
?>

<html>
  <head>
    <title>Главная страница</title>
  </head>
  <body>

<?php if ($id === null): ?>
  <a href="login.php">залогиниться</a><br>
  <a href="reg.php">регистрация</a>
<?php else: ?>
  <?= $_SESSION["name"] ?><br>
    <a href="lk.php">Личный кабинет</a><br>
    <a href="logout.php">разлогиниться</a><br>
    Ваша персональная скидка 10% сгорит через ... часов ... минут ... секунд!
    <?= $_SESSION["entryTime"] ?><br>
<?php endif; ?>

  </body>
</html>