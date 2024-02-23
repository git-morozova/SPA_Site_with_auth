Надо ли делать редиректы с технических страниц php? К примеру, functions.php, auth.php?


Пароли для входа в ЛК

$users = array(
    '0' => [
        'login' => 'admin', 
        'password' => '202cb962ac59075b964b07152d234b70' // pass - 123
    ], 
    '1' => [ 
        'login' => 'user', 
        'password' => '250cf8b51c773f3f8dc8b4be867a9a02' // pass - 456
    ], 
    '2' => [
        'login' => 'irishka111', 
        'password' => '68053af2923e00204c3ca7c6a3150cf7' // pass - 789
    ], 
);

Уместны ли такие функции? Есть другие инструменты, которые просто проверяют, существует ли параметр/переменная

    function getUserId() {   
        return $_SESSION["id"] ?? null;
    }