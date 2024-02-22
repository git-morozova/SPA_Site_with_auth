<pre>
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

    // Добавляем нового юзера в файл json
    $users = getUsersList(); 
    
    $newUser = array(
    'name' => $name,
    'login' => $login,
    'password' => md5($password)
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

    // Перенаправление в личный кабинет 
    header("Location: lk.php");
}
?>
</pre>