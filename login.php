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
                        <h1><a href="index.php">SPA&nbsp;Factory</a></h1>
                        <span class = "toggle-btn">&#9776;</span>
                    </div> 
                    <ul class = "display-none-mobile">
                            <li><a href="reg.php">Регистрация</a></li> 
                    </ul>
            </header>
           
            <div class = "banner-wrapper-fixed-login">
                    <div class = "foreground">                        
                            <div class="login">
                                <h1 class="log_h1">Вход</h1>
                                <form action="auth.php" method="post">
                                    <input type="text" name="login" placeholder="Логин" />
                                    <input type="password" name="password" placeholder="Пароль"/>
                                    <input name="submit" type="submit" class="btn btn-primary btn-block btn-large" value="Войти">
                                </form>        

                                <div class = "L-tewelve red_row">
                                    <div class = "row">  
                                        <?php showError() ?>
                                    </div>
                                </div>
                            </div>                        
                    </div>
                </div>
                <div class = "wrapper_reg">
                </div>

        </div>
    </body>
</html>