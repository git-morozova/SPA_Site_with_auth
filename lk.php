<?php
    session_start();
    require __DIR__ . '/functions.php';
    $name = getCurrentUser();
?>

    Это личный кабинет<br>
    Здравствуйте, <?= $name ?><br>

<a href="index.php">главная</a><br>
<a href="logout.php">разлогиниться</a><br>
