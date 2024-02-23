<?php
    //Возможно, первая функция выполнена не по ТЗ, но я не поняла логики "вернуть массив всех пользователей и хэши их паролей"
    //Сделала, как удобней для решения остальных пунктов ТЗ, то есть прописаны две отдельные функции:

    //функция getUsersList() возвращает массив всех пользователей;
    function getUsersList() {         
        $usersString = file_get_contents("users.json"); // получаем данные из JSON файла        
        $users = json_decode($usersString, true);    // Преобразуем в массив
        return $users; // возвращаем массив со всеми данными
    };

    //возвращает все логины и хэши паролей;
    function getAllLoginPass() {
        $users = getUsersList();
        $loginPassArray = array();
        
        for ($i = 0;$i < count($users);$i++) {
            $key = $users[$i]['login'];
            $value = $users[$i]['password'];
            $loginPassArray[$key] = $value; // запись в массив, вида "[user] => 250cf8b51c773f3f8dc8b4be867a9a02"
        }

        return $loginPassArray;
    };

    //функция existsUser($login) проверяет, существует ли пользователь с указанным логином;
    function existsUser($login) {  
        $loginPassArray = getAllLoginPass();
        foreach ($loginPassArray as $key => $value)  {  
            if ($key == $login) {
                return 1;
            }         
        }
        return 0;
    };

    //функция checkPassword($login, $password) возвращает true, когда существует пользователь с указанным логином 
    //и введенный им пароль прошел проверку, иначе — false;
    function checkPassword($login, $password) {
        $loginPassArray = getAllLoginPass();
        foreach ($loginPassArray as $key => $value)  {
                if ($key == $login && $value == md5($password)) {                
                return 1;
                } 
        }
        return 0;
    };

    //функция getCurrentUser() которая возвращает либо имя вошедшего на сайт пользователя, либо null.
    function getCurrentUser() {   
        return $_SESSION["name"] ?? null;
    }

    //для проверки сессии - имени может не быть в базе, а id будет обязательно
    function getUserId() {   
        return $_SESSION["id"] ?? null;
    }
?>