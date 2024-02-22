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

<?php    
//таймер
  $expireTime = $_SESSION["expireTime"]; //время истечения акции
  $currentTime = new DateTime(date("Ymd H:i:s")); //текущее время
  $interval = $expireTime->diff($currentTime); //разница
?>

    Ваша персональная скидка 10% сгорит через <?= $interval->format(' %h '); ?> часов
    <?= $interval->format(' %i '); ?> минут <?= $interval->format(' %s '); ?> секунд!
    
<?php endif; ?>

  </body>
</html>