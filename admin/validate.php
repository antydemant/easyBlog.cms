<?php
        $admin_login = htmlspecialchars(trim(substr($_POST['admin_login'], 0, 100)));
        $admin_password = md5(htmlspecialchars(trim(substr($_POST['admin_password'], 0, 100))));
        $admin = $MySQL->getAdmin($_POST['admin_login']);
        $admin_sess = $MySQL->getAdmin($session->getSession('admin_login'));
        //var_dump($admin);
        function validate() {
            
            global $errors, $admin_password,$admin_login,$admin;
        
            if (!isset($_POST['admin_login']) || empty($_POST['admin_login'])) {
                
                $errors['admin_login'] = 'Введите логин!';
            }
            elseif( $admin['login'] !== $admin_login) {
                $errors['admin_login'] = 'Нету такого пользователя в базе!';
            }
            if (!isset($_POST['admin_password']) || empty($_POST['admin_password'])) {
                
                $errors['admin_password'] = 'Введите пароль!';
                
            } elseif ($admin['password'] !== $admin_password) {
                
                $errors['admin_password'] = 'Неверный пароль!';
            }
            if ($errors)
                return false;
            else
                return true;
        }
        
        function validate_edit_add() {
            
            global $errors;
            
            if(!isset($_POST['title'])|| empty($_POST['title'])) {
                $errors['title'] = 'Введіть назву публікації!';
            }
            if(!isset($_POST['text'])|| empty($_POST['text'])) {
                $errors['text'] = 'Введіть текст публікації!';
            }
            if ($errors)
                return false;
            else
                return true;
        }
        
        function validate_add_admin() {
                    
            global $errors;
            
            if(!isset($_POST['admin_name']) || empty($_POST['admin_name'])) {
                $errors['admin_name'] = "Введіть Ім'я Адміністратора!";
            }
            
            if(!isset($_POST['admin_login']) || empty($_POST['admin_login'])) {
                $errors['admin_login'] = 'Введіть Логін Адміністратора!';
            }
            if(!isset($_POST['admin_password']) || empty($_POST['admin_password'])) {
                $errors['admin_password'] = 'Введіть пароль!';
            }
            if(!isset($_POST['admin_password_confirm']) || empty($_POST['admin_password_confirm']) || $_POST['admin_password_confirm'] != $_POST['admin_password']) {
                $errors['admin_password_confirm'] = 'Введені паролі не співпадають!';
            }
            if ($errors)
                return false;
            else
                return true;
        }
        
        
?>