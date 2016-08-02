<?php
    $host = htmlspecialchars(trim(substr($_POST['host'], 0, 100)));
    $user = htmlspecialchars(trim(substr($_POST['user'], 0, 100)));
    $password = htmlspecialchars(trim(substr($_POST['password'], 0, 100)));
    $admin_name = htmlspecialchars(trim(substr($_POST['admin_name'], 0, 100)));
    $admin_login = htmlspecialchars(trim(substr($_POST['admin_login'], 0, 100)));
    $admin_password = md5(htmlspecialchars(trim(substr($_POST['admin_password'], 0, 100))));
function validate()
{
    global $errors;

    if (!isset($_POST['host']) || empty($_POST['host'])) {
        $errors['host'] = 'Write DataBase Host !';
    }
    if (!isset($_POST['user']) || empty($_POST['user'])) {
        $errors['user'] = 'Write DataBase User';
    }
    if (!isset($_POST['admin_name']) || empty($_POST['admin_name'])) {
        $errors['admin_name'] = 'Write Admin Name!';
    }
    if (!isset($_POST['admin_login']) || empty($_POST['admin_login'])) {
        $errors['admin_login'] = 'Write Admin Login!';
    }
    if (!isset($_POST['admin_password']) || empty($_POST['admin_password'])) {
        $errors['admin_password'] = 'Write Admin Password!';
    } elseif (!isset($_POST['admin_password_confirm']) || ($_POST['admin_password']
    !== $_POST['admin_password_confirm']) || empty($_POST['admin_password_confirm'])) {
        $errors['admin_password_confirm'] = '(Password != Confirm Password)';
    }
    if ($errors)
        return false;
    else
        return true;
}
?>