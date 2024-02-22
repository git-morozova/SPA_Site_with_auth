<?php
require __DIR__ . '/functions.php';

$login = $_POST['login'];
$password = $_POST['password'];
$name = $_POST['name'];

// Проверка на ошибки ввода данных в поля формы регистрации 
if (!$login || !$password || !$name) {    
    header("Location: reg.php?error=1");
} else if (existsUser($login) == 1) {
    header("Location: reg.php?error=2");
} else {

    // Успех - начало сессии 
    session_start(); 

    // Записываем в суперглобальную переменную $_SESSION параметры пользователя    
    $_SESSION["id"] = count($users);
    $_SESSION["name"] = $name;
    $_SESSION["login"] = $login;
    $_SESSION["password"] = $password;

    // Добавляем нового юзера в файл json
    $json = file_get_contents('users.json');
    $data = json_decode($json, true);
    $newUser = array(
    'id' => count($users),
    'name' => $name,
    'login' => $login,
    'password' => $password
    );
    array_push($data, $newUser);
    $json = json_encode($data);
    file_put_contents('users.json', $json);         

    // Перенаправление в личный кабинет 
    //header("Location: lk.php");
}
?>