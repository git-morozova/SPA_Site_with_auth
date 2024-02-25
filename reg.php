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
            <title>SPA Factory: Регистрация</title>
            <link rel="stylesheet" href="css/styles.css">
            <link rel="stylesheet" href="css/dop.css">            
            <link rel="stylesheet" href="css/gallery.css">
            <link rel="stylesheet" href="css/cards.css">
            <script src="js/script.js"></script>
    </head>
    <body>        

        <!-- ТОП -->
        <div class = "L-tewelve"> 
            <div class = "row">   
                <header class = "header">
                    <div class = "logo-container">
                        <h1>SPA&nbsp;Factory</h1>
                        <span class = "toggle-btn">&#9776;</span>
                    </div> 
                    <ul class = "display-none-mobile">
                            <li><a href="login.php">Вход</a></li>
                            <li><a href="index.php">Главная</a></li>  
                    </ul>
                </header>
                <div class = "banner-wrapper-fixed">
                    <div class = "foreground">                        
                            <div class="reg">
                                <h1 class="reg_h1">Регистрация</h1>
                                <form action="process.php" method="post">
                                    <input name="login" type="text" placeholder="Логин">
                                    <input name="password" type="password" placeholder="Пароль">
                                    <input name="name" type="name" placeholder="Имя">
                                    <br><span style="color:#fff">Дата рождения (не обязательно)</span>
                                    <input name="birthDate" type="date" placeholder="Дата рождения">
                                    <input name="submit" type="submit" class="btn btn-primary btn-block btn-large" value="Зарегистрироваться">
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
                        case 2: echo ("Такой пользователь уже существует"); break;      
                        }    
                    }
                ?>

                                    </div>
                                </div>
                            </div>                        
                    </div>
                </div>
                <div class = "wrapper_reg">
                </div>
            </div>
        </div>
    <!-- /ТОП -->

    
  <!-- УСЛУГИ -->
  <div class = "L-tewelve">
      <div class = "row">
        <div class = "section">
          <h1 class = "heading">Популярные услуги</h1>
        </div> 
      </div>  
    </div>

    <div class = "L-tewelve services">
      <div class = "row">
        <div class = "section center_width">
          <div class = "L-four T-tewelve S-tewelve">
            <div class = "box">
                <article class="card card--1">  
                      <div class="card__info">
                        <div class="card__popular"> HOT!</div>
                        <h2 class="card__title">Флоатинг</h2>  
                        <div class="card__text"> 
                          Cреда с нулевой гравитацией, которая позволяет телу и сознанию глубоко отдохнуть. 
                        </div> 
                        <div class="card__price">
                          <?=getPrice("3000")?>
                        </div>                  
                      </div>
                </article>
            </div>
          </div>
          <div class = "L-four T-tewelve S-tewelve">
            <div class = "box">
                <article class="card card--1"> 
                      <div class="card__info">
                        <div class="card__popular"> HOT!</div>
                        <h2 class="card__title">Спа массаж</h2>  
                        <div class="card__text"> 
                        Настоящий турецкий хаммам, сделанный с&nbsp;учетом национальных правил и традиций.
                        </div> 
                        <div class="card__price"><?=getPrice("4000")?></div>                  
                      </div>
                </article>
            </div>
          </div>
          <div class = "L-four T-tewelve S-tewelve">
            <div class = "box">
                <article class="card card--1">  
                        <div class="card__info">
                          <div class="card__popular"> HOT!</div>
                          <h2 class="card__title">Хаммам</h2>  
                          <div class="card__text"> 
                          Приведет Вас в отличное настроение, вернет здоровый сон или придаст бодрости.
                          </div> 
                          <div class="card__price"><?=getPrice("3500")?></div>                  
                        </div>
                  </article>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- /УСЛУГИ -->

    <!-- ГАЛЕРЕЯ -->
    <div class = "L-tewelve">
      <div class = "row"> 
        <div class = "section dark">
          <h1 class = "heading">Фото салона</h1>
        </div>
        <div class="section center_width">       
                <div id="carousel">
                  <figure id="spinner">
                    <img src="img/1.jpg" alt>
                    <img src="img/2.jpg" alt>
                    <img src="img/3.jpg" alt>
                    <img src="img/4.jpg" alt>
                    <img src="img/5.jpg" alt>
                    <img src="img/6.jpg" alt>
                    <img src="img/7.jpg" alt>
                    <img src="img/8.jpg" alt>
                  </figure>
                </div>
                <span style="float:left" class="ss-icon" onclick="galleryspin('-')">&lt;</span>
                <span style="float:right" class="ss-icon" onclick="galleryspin('')">&gt;</span>       
        </div>
    </div>
    </div>
    <!-- /ГАЛЕРЕЯ -->

    <!-- АКЦИИ -->
    <div class = "L-tewelve">
      <div class = "row">
        <div class = "section">
          <h1 class = "heading">Акции</h1>
        </div> 
      </div>  
    </div>

    <div class = "L-tewelve services">
      <div class = "row">
        <div class = "section center_width">
          <div class = "L-six T-tewelve S-tewelve">
            <div class = "box">
                <article class="card card--1">      
                      <div class="card__info">
                        <div class="card__popular"> -5%</div>
                        <h2 class="card__title">Скидка в день рождения</h2>                                   
                      </div>
                </article>
            </div>
          </div>     
          <div class = "L-six T-tewelve S-tewelve">
            <div class = "box">
                <article class="card card--1">   
                        <div class="card__info">
                          <div class="card__popular"> -10%</div>
                          <h2 class="card__title">Скидка за посещение сайта</h2>                 
                        </div>
                  </article>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /АКЦИИ -->

    <!-- ФУТЕР -->
    <div class = "L-tewelve">
      <div class = "row">
        <footer>
          <p>SPA Factory - 2024</p>
        </footer>
      </div>
    </div>
    <!-- /ФУТЕР -->

    </body>
</html>