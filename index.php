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

  if ($expireTime > $currentTime) {     //проверка, что срок акции еще не истек (diff не бывает отрицательным)
    $_SESSION["sale"] = 1; // пишем в $_SESSION, что положена скидка (10%)
?> 

    Ваша персональная скидка 10% сгорит через <?= $interval->format(' %h '); ?> часов
    <?= $interval->format(' %i '); ?> минут <?= $interval->format(' %s '); ?> секунд!
    
<?php } endif; ?>

<?php 
  $price = 1000;
  $priceSale = $price;
  $birthDay = getBirthDay();
  $sale = getSale();

  if ($id !== null) {
    if ($birthDay == 1 && $sale == 1) {
      $priceSale = $price * 0.85; //обе скидки активны
    } elseif ($sale == 1) {
      $priceSale = $price * 0.9; //скидка 10% за вход
    } elseif ($birthDay == 1) {
      $priceSale = $price * 0.95; //скидка 5% на ДР
    }
  }

  if ($price == $priceSale) {  // если нет скидок - выводим одну цену ?>
    <div><?= $price ?></div>
<?php } else { // есть скидки - выводим две цены ?>
  <div><s><?= $price ?></s></div><div><?= $priceSale ?></div>
<?php } ?>

  </body>
</html>