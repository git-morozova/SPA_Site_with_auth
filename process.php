<?php
    require __DIR__ . '/functions.php';

    $login = $_POST['login'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $birthDate = $_POST['birthDate']; 

    // Проверка на ошибки ввода данных в поля формы регистрации 
    if (!$login || !$password || !$name) {    
        header("Location: reg.php?error=1");
    } else if (existsUser($login) == 1) {
        header("Location: reg.php?error=2");
    } else {

        // Успех - начало сессии 
        session_start(); 

        // Добавляем нового юзера в файл json
        $users = getUsersList(); 
        
        $newUser = array(
        'name' => $name,
        'login' => $login,
        'password' => md5($password),
        'birthDate' => "$birthDate", //вида "2000-01-31"
        );

        $users[] = $newUser;
        $json = json_encode($users, JSON_FORCE_OBJECT); 
        file_put_contents("users.json", $json);

        //после записи нового объекта в json определяем id нового юзера. На всякий случай определяем его по логину  
        foreach ($users as $key => $obj)  {  
            foreach ($obj as $param => $value)  {  
                if ($value == $login) {
                    $id = $key;
                }         
            }        
        }   
        
        // Записываем в суперглобальную переменную $_SESSION параметры нового пользователя    
        $_SESSION["id"] = $id;
        $_SESSION["name"] = $name;
        $_SESSION["birthDate"] = $birthDate;        
        
        // Записываем время регистрации юзера
        $entryTime = new DateTime(date("Ymd H:i:s"));
        $_SESSION["entryTime"] = $entryTime;

        //Для времени окончания акции создаем отдельную переменную, т.к. иначе класс DateTime перезаписывается
        $expireTime = new DateTime(date("Ymd H:i:s"));
        date_modify($expireTime, "+1 day");
        $_SESSION["expireTime"] = $expireTime;

        // Перенаправление в личный кабинет 
        header("Location: lk.php");
    }
?>