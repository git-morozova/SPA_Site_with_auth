<?php 
  session_start();
  require __DIR__ . '/functions.php';
  $id = getUserId();
?>

<html>
  <head>
    <title>SPA Factory: Главная</title>
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
            <h1><a href="index.php">SPA&nbsp;Factory</a></h1>
            <span class = "toggle-btn">&#9776;</span>
          </div> 
          <ul class = "display-none-mobile">

              <?php if ($id === null): ?>
                <li><a href="login.php">Вход</a></li>
                <li><a href="reg.php">Регистрация</a></li>
              <?php else: ?>
                <li><a href="lk.php">Личный кабинет</a></li>
                <li><a href="logout.php">Выйти</a></li>          
              <?php  endif; ?>

          </ul>
        </header>
        <div class = "banner-wrapper-fixed">
          <div class = "foreground">
            <h1>ЦЕНТР ФЛОАТИНГА И&nbsp;СПА</h1>
          </div>
        </div>
        <div class = "wrapper">
        </div>
      </div>
    </div>
  <!-- /ТОП -->


    <?php if ($id !== null): 
        
    //таймер
      $expireTime = $_SESSION["expireTime"]; //время истечения акции
      $currentTime = new DateTime(date("Ymd H:i:s")); //текущее время
      $interval = $expireTime->diff($currentTime); //разница  

      if ($expireTime > $currentTime) {     //проверка, что срок акции еще не истек (diff не бывает отрицательным)
        $_SESSION["sale"] = 1; // пишем в $_SESSION, что положена скидка (10%)
    ?> 
    <div class = "L-tewelve red_row">
      <div class = "row">    
          <p>Ваша персональная <b>скидка 10%</b> сгорит через <?= $interval->format(' %h '); ?> часов
        <?= $interval->format(' %i '); ?> минут <?= $interval->format(' %s '); ?> секунд!</p>    
      </div>
    </div>
      
    <?php } endif; ?>


  <!-- УСЛУГИ -->
    <div class = "L-tewelve">
      <div class = "row">
        <div class = "section">
          <h1 class = "heading">Услуги салона</h1>
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

    <div class = "L-tewelve services">
      <div class = "row">
        <div class = "section center_width">
          <div class = "L-four T-tewelve S-tewelve">
            <div class = "box">
                <article class="card card--1">  
                      <div class="card__info">
                        <div class="card__popular"> &nbsp;</div>
                        <h2 class="card__title">СПА программы</h2>  
                        <div class="card__text"> 
                        Наши мастера разработали программы для&nbsp;оздоровления и&nbsp;максимального расслабления. 
                        </div> 
                        <div class="card__price"><?=getPrice("7500")?></div>                  
                      </div>
                </article>
            </div>
          </div>
          <div class = "L-four T-tewelve S-tewelve">
            <div class = "box">
                <article class="card card--1">                 
                      
                      <div class="card__info">
                        <div class="card__popular"> &nbsp;</div>
                        <h2 class="card__title">Для двоих</h2>  
                        <div class="card__text"> 
                        Прекрасный подарок к&nbsp;знаменательной дате, годовщине или просто знаком проявления заботы и любви.
                        </div> 
                        <div class="card__price"><?=getPrice("10000")?></div>                  
                      </div>
                </article>
            </div>
          </div>
          <div class = "L-four T-tewelve S-tewelve">
            <div class = "box">
                <article class="card card--1">                 
                        
                        <div class="card__info">
                          <div class="card__popular"> &nbsp;</div>
                          <h2 class="card__title">Фитобочка</h2>  
                          <div class="card__text"> 
                          Минисауна, сочетающая в&nbsp;себе разные подходы паровых процедур с&nbsp;использованием отваров трав и масел.
                          </div> 
                          <div class="card__price"><?=getPrice("2500")?></div>                  
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