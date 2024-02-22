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

    Это личный кабинет<br>
    Здравствуйте, <?= $name ?><br>

    <!-- //разбираемся с датой рождения -->
<?php   
    $birthDate = $_SESSION["birthDate"];    //"2000-08-31"
    $birthDate = substr($birthDate, 5, 9);      //"01-31"
    $currentDate = new DateTime(date("Y-m-d"));    //класс 
    $currentDate = $currentDate->format('m-d');     //"01-01"
?>

<?php if ($birthDate != null && $birthDate == $currentDate): //ДР - сегодня 
    $_SESSION["birthDay"] = 1;     // Запишем эту информацию в $_SESSION
?>
    Поздравляем вас с днем рождения! Для вас подготовлен подарок - скидка 5% на все услуги салона. <br>
    <a href="index.php">Получить скидку</a><br>

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

<?php else: ?> 

    Пожалуйста, укажите дату рождения<br>
    <form action="#" method="get">        
        <input name="birthDate" type="date" placeholder="Дата рождения">
        <input name="submit" type="submit" value="Сохранить">
    </form>

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
        header('Location: '.$_SERVER['REQUEST_URI']); // Обновляем страницу, чтобы исчезла форма с просьбой указать ДР
    
    } else {
        echo ("Ошибка ввода данных");
    }
} 
?>

<?php endif; ?>

<br>
<br>
<a href="index.php">главная</a><br>
<a href="logout.php">разлогиниться</a><br>
