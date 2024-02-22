<?php
require __DIR__ . '/functions.php';

$login = $_POST['login'];
$password = $_POST['password'];

// Проверка на ошибки ввода данных в поля формы аутентификации 
if (!$login || !$password) {    
    header("Location: login.php?error=1");
} else if (existsUser($login) == 0) {
    header("Location: login.php?error=2");
} else if (checkPassword($login, $password) == 0) {
    header("Location: login.php?error=3");
} else {

    // Успех - начало сессии 
    session_start(); 

    // Записываем в суперглобальную переменную $_SESSION параметры пользователя
    for ($i = 0;$i < count($users);$i++) {        
        if ($login == $users[$i]['login']) {
            $_SESSION["id"] = $i;
            $_SESSION["name"] = $users[$i]['name'];
        } 
    }        

    // Перенаправление в личный кабинет 
    header("Location: lk.php");
}
?>