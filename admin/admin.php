<?php

//підключаємо конфіг файл для конекта з базою
require_once __dir__ . "/../config.inc.php";

// checking instalation
if (!defined('DB_INSTALL')) {

    // redirect to installation
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/install/install.php");
    exit();

} else {

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

    if ($_GET['route'] == 'register') {

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && validate_add_admin()) {
            $success = '';
            $name = addslashes(trim($_POST['admin_name']));
            $login = addslashes(trim($_POST['admin_login']));
            $password = md5(addslashes(trim($_POST['admin_password'])));
            if ($MySQL->addAdmin($name, $login, $password,0)) {
                $success = 'Користувача зарестровано';
            }
            header('Content-Type: text/html; charset=utf-8');
            include __dir__ . '/view/login.html';

        } else {
            header('Content-Type: text/html; charset=utf-8');
            include __dir__ . '/view/register.html';
        }

    } elseif (!$session->getSession('admin_login') || !$session->getSession('admin_password') ||
        !$session->getSession('id')) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && validate()) {
            $session->setSession('admin_login', $admin_login);
            $session->setSession('admin_password', $admin_password);
            $session->setSession('id', $admin['id']);
            $session->setSession('admin_name', $admin['name']);
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/admin/admin.php"); exit();

        } else {
            header('Content-Type: text/html; charset=utf-8');
            include __dir__ . '/view/login.html';
        }
    }

    elseif ($admin_sess['password'] != $session->getSession('admin_password') || $admin_sess['login'] != $session->getSession('admin_login')) {

        header('Content-Type: text/html; charset=utf-8');
        include __dir__ . '/view/login.html';
    } else {
        include __dir__ . '/content.php';
    }
}
?>