<?php
    //підключаємо конфіг файл для конекта з базою
    require_once __DIR__ ."/../config.inc.php";
    require_once __DIR__ ."/../system/db.inc.php";
    require_once __DIR__ ."/../system/db_lib.inc.php";
    //запуск сесії
    require_once __DIR__ ."/../system/session_lib.inc.php";
    //підключаємо функції валідації отриманих даних з форм $_POST
    require_once __DIR__ ."/validate.php";
    //інформативне відображення змінних 
    require_once __DIR__ ."/../debug_dump.php";
    
    $errors = array();           // масив помилок 1
    //$admin = getAdmin($_POST['admin_login']); // отримуємо асоціативний масив логіну і пароля адміна
    $content = getAllPub(); // отримуємо ресурс з усіх публікацій
    $is_article = getOnePub($_GET['id']); //отримуємо ресурс публікації
    
    $index = mysql_fetch_assoc($is_article); //отримуємо з ресурсу масив публікації
    
    if(!isset($_SESSION['admin_login']) || !isset($_SESSION['admin_password']) || !isset($_SESSION['id'])) {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && validate()) {
            $_SESSION['admin_login'] = $admin_login_sess;
            $_SESSION['admin_password'] = $admin_password;
            $_SESSION['id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            include __DIR__.'/content.php';
            
        } else {
            header('Content-Type: text/html; charset=utf-8');
            include __DIR__.'/view/login.html';
        }
    } elseif($admin_sess['password'] != $_SESSION['admin_password'] || $admin_sess['login'] != $_SESSION['admin_login']) {
        
            header('Content-Type: text/html; charset=utf-8');
            include __DIR__.'/view/login.html';
    }
    else {
            include __DIR__.'/content.php';
    }
?>