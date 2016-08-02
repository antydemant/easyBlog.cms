<?php
        // Создание структуры и конфига Базы Данных блога
        header('Content-Type: text/html; charset=utf-8');
        require_once("validate.php");
        $errors = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && validate()) {
            include_once ("install.inc.php");//конектимося, створюємо базу,конфіг
        }
        //написати збереження невірних данних якщо ошибки виведуться!!!! МАСТ ХЕВ!!!і
        include_once __DIR__ . '/view/content.html';
        
?>
