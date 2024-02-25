<?php 
    session_start();
    require __DIR__ . '/functions.php';
    $id = getUserId();

    // проверка аутентификации. Если юзер залогинен - редирект на главную
    if ($id !== null) {
        header("Location: index.php");
    }  
?>

<html>
    <head>
            <title>SPA Factory: Вход</title>
            <link rel="stylesheet" href="css/styles.css">
            <link rel="stylesheet" href="css/dop.css">
    </head>
    <body>        
        <div class="form_back">
            <header class = "header">
                    <div class = "logo-container">
                        <h1>&nbsp;</h1>
                        <span class = "toggle-btn">&#9776;</span>
                    </div> 
                    <ul class = "display-none-mobile">
                            <li><a href="reg.php">Регистрация</a></li>
                            <li><a href="index.php">Главная</a></li>  
                    </ul>
            </header>
            <div class="login">
                <h1>Вход</h1>
                <form action="auth.php" method="post">
                    <input type="text" name="login" placeholder="Логин" />
                    <input type="password" name="password" placeholder="Пароль"/>
                    <input name="submit" type="submit" class="btn btn-primary btn-block btn-large" value="Войти">
                </form>        

                <div class = "L-tewelve red_row">
                    <div class = "row">  

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

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>