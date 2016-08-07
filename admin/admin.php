<?php
//підключаємо конфіг файл для конекта з базою
require_once __dir__ . "/../config.inc.php";

function __autoload($name)
{
    require_once __dir__ . "/../system/$name.class.inc.php";
}

$MySQL = new MySQL(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME, '');
$session = new Session();

//підключаємо функції валідації отриманих даних з форм $_POST
require_once __dir__ . "/validate.php";
//інформативне відображення змінних
require_once __dir__ . "/../debug_dump.php";


$errors = array(); // масив помилок

if (!$session->getSession('admin_login') || !$session->getSession('admin_password') ||
    !$session->getSession('id')) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && validate()) {
        $session->setSession('admin_login', $admin_login);
        $session->setSession('admin_password', $admin_password);
        $session->setSession('id', $admin['id']);
        $session->setSession('admin_name', $admin['name']);
        include __dir__ . '/content.php';

    } else {
        header('Content-Type: text/html; charset=utf-8');
        include __dir__ . '/view/login.html';
    }
} elseif ($admin_sess['password'] != $session->getSession('admin_password') || $admin_sess['login'] != $session->getSession('admin_login')) {

    header('Content-Type: text/html; charset=utf-8');
    include __dir__ . '/view/login.html';
} else {
    include __dir__ . '/content.php';
}
?>