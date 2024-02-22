<?php 
session_start();
require __DIR__ . '/functions.php';
$id = getUserId();

// проверка аутентификации. Если юзер залогинен - редирект на главную
if ($id !== null): 
    header("Location: index.php"); 
 else: ?>    

<html>
<body>
    <form action="auth.php" method="post">
        Вход в личный кабинет
        <input name="login" type="text" placeholder="Логин">
        <input name="password" type="password" placeholder="Пароль">
        <input name="submit" type="submit" value="Войти">
    </form>

<?php 
// Вытаскиваем ошибку заполнения полей из get-параметров для того, чтобы вывести текст ошибки на экран
// Для этого нужно взять текущий url
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// Проверить, есть ли в url параметр error
if (str_contains($url, 'error=')) {

    // Если есть - вытаскиваем его
    $parts = parse_url($url); 
    parse_str($parts['query'], $query); 
    
    // Тексты для ошибок заполнения полей
    switch ($query['error']) {
       case 1: echo ("Пожалуйста, заполните все поля"); break;
       case 2: echo ("Такого пользователя не существует"); break;
       case 3: echo ("Неправильный пароль"); break;
    }    
}
?>
</body>
</html>

<?php endif; ?>