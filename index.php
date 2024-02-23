<?php 
  session_start();
  require __DIR__ . '/functions.php';
  $id = getUserId();
  $name = getCurrentUser();
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
  <?= $name ?><br>
    <a href="lk.php">Личный кабинет</a><br>
    <a href="logout.php">разлогиниться</a><br>

<?php    
//таймер
  $expireTime = $_SESSION["expireTime"]; //время истечения акции
  $currentTime = new DateTime(date("Ymd H:i:s")); //текущее время
  $interval = $expireTime->diff($currentTime); //разница  

  if ($expireTime > $currentTime) {     //проверка, что срок акции еще не истек 
?> 

    Ваша персональная скидка 10% сгорит через <?= $interval->format(' %h '); ?> часов
    <?= $interval->format(' %i '); ?> минут <?= $interval->format(' %s '); ?> секунд!
    
<?php } endif; ?>

  </body>
</html>