<?php
    session_start();
    require __DIR__ . '/functions.php';
    $id = getUserId();
    $name = getCurrentUser();

    // проверка аутентификации. Если юзер не залогинен - редирект на главную
    if ($id === null) {
        header("Location: index.php");
    }
?>

<html>
  <head>
    <title>SPA Factory: Личный кабинет</title>
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
                <li><a href="index.php">Главная</a></li>
                <li><a href="logout.php">Выйти</a></li>  
          </ul>
        </header>
        <div class = "banner-wrapper-fixed">
          <div class = "foreground">
            <h1>
                    Это личный кабинет<br>
                    Здравствуйте, <?= $name ?><br>
            </h1>
          </div>
        </div>
        <div class = "wrapper">
        </div>
      </div>
    </div>
  <!-- /ТОП -->

  <!-- ДЕНЬ РОЖДЕНИЯ -->
  <div class = "L-tewelve red_row">
      <div class = "row ">  
        <p>

  <?php   
// Дата рождения - задана в базе. Проверки ДР и вывод "... дней до ДР"

    $birthDate = $_SESSION["birthDate"];    //"2000-08-31"
    $birthDate = substr($birthDate, 5, 9);      //"01-31"
    $currentDate = new DateTime(date("Y-m-d"));    //класс 
    $currentDate = $currentDate->format('m-d');     //"01-01"
?>

<?php if ($birthDate != null && $birthDate == $currentDate): //ДР - сегодня 
    $_SESSION["birthDay"] = 1;     // Запишем про это в $_SESSION
?>
    Поздравляем вас с днем рождения! Для вас подготовлен подарок - дополнительная <b>скидка 5%</b> на все услуги салона
    <br><a href="index.php" style="color:#ffffff">Смотреть услуги и цены</a>

<?php elseif ($birthDate != null): //считаем, сколько дней до ДР
    // для начала приведем обе даты -текущую и ДР к единому году
    $currentDate = new DateTime(date("Y-m-d"));     //"2024-01-01"
    $thisYear = $currentDate->format('Y');     //"2024"

    $nextBirthDate = $thisYear . "-" . $birthDate;     //"2024-08-31"
    $nextBirthDate = new DateTime(date($nextBirthDate));    //класс


    if ($currentDate < $nextBirthDate) { //в этом году ДР еще не было
        $interval = $nextBirthDate->diff($currentDate)->format("%a"); // просто разница
    } else {
        //а тут надо прибавить год, т.к. ДР только в следующем году
        $currentDate = new DateTime(date("Y-m-d"));     //"2024-01-01"
        $nextYear = $currentDate->modify('+1 year')->format('Y');    //"2025"

        $nextBirthDate = $nextYear . "-" . $birthDate;     //"2025-01-31"
        $nextBirthDate = new DateTime(date($nextBirthDate));

        $currentDate = new DateTime(date("Y-m-d"));
        $interval = $nextBirthDate->diff($currentDate)->format("%a");        
    }
?> 

    Дней до вашего дня рождения: <?= $interval ?>.

<?php 
// Дата рождения - не задана. Вызов формы для записи ДР в json
else: ?> 

<div class = "birth_date">
            <h3>Пожалуйста, укажите дату рождения</h3>
            <form action="#" method="get">        
                <input name="birthDate" type="date" placeholder="Дата рождения">
                <input name="submit" type="submit" class="btn btn-primary btn-block btn-large" value="Сохранить">
            </form>  
</div> 
                            

<?php 
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// Проверить, есть ли в url параметр submit
if (str_contains($url, 'submit=')) {

    if ($_GET['birthDate'] != null) {
        $birthDate = $_GET['birthDate']; //Вытаскиваем ДР из формы и записываем в переменную    
    
        $users = getUsersList(); 
        $users[$id]["birthDate"] = $birthDate; //Записываем ДР в массив users в нужное место
    
        $json = json_encode($users, JSON_FORCE_OBJECT); // Запись в файл json
        print_r($json);
        file_put_contents("users.json", $json);    
    
        $_SESSION["birthDate"] = $birthDate; // Новая запись в сессии
        header('Location: '.$_SERVER['REQUEST_URI']); // Обновляем страницу, чтобы исчезла форма с просьбой указать ДР и вывелась инфа про ДР
    
    } else {
        echo ("Ошибка ввода данных");
    }
} 
?>

<?php endif; ?>

         </p>    
      </div>
    </div>   
  <!-- /ДЕНЬ РОЖДЕНИЯ -->   

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