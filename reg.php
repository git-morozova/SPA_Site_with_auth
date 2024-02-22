<?php 
    session_start();
    //залогинен - редирект на главную
    //не залогинен - вывод формы
?>

<html>
<body>
    
    <form action="process.php" method="post">
        Регистрация
        <input name="login" type="text" placeholder="Логин">
        <input name="password" type="password" placeholder="Пароль">
        <input name="name" type="name" placeholder="Имя">
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
        case 2: echo ("Такой пользователь уже существует"); break;      
        }    
    }
?>
</body>
</html>