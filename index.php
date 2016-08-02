<?php
        //підключаємо конфіг файл
        require_once("config.inc.php");
        //перевірка на встановлення блогу
        if(!defined('DB_INSTALL')) {
            //редирект на інсталл
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/install/install.php"); exit();
        } else { 
        //підключаємося до бази
        require_once __DIR__ ."/system/db.inc.php";
        //підключаємо потрібні функції для роботи з базою
        require_once __DIR__ ."/system/db_lib.inc.php";
        //підключаємо сесію
        require_once __DIR__ ."/system/session_lib.inc.php";
        
        if(!isset($_GET['route']) || empty($_GET['route'])) {
            //отримуємо ресурс публікації 
            $is_article = getOnePub($_GET['id']);
            //отримуємо кількість публікацій для пагінації
            $pagination = mysql_num_rows(getAllPub());
            //вираховуємо сторінок пагінації, округлюємо до більшого
            $pagination_pages = ceil($pagination / 5);
            //отримуємо масив публікації
            $index = mysql_fetch_assoc($is_article);
            
                if(!isset($_GET['id']) || empty($_GET['id'])) {
                    //виводимо публікації
                    include __DIR__ . '/user/articles.php'; 
                }
                elseif( (int) $_GET['id'] <= 0 || !$index) {
                    //виводимо помилку, якщо ID публікації не відповідає умові
                    include __DIR__ . '/user/404.php'; 
                }
                else {
                    //виводимо публікацію
                    include __DIR__ . '/user/article.php';
                    
                }
        } elseif($_GET['route'] === 'admin') {
                //направляємо на адмінку
                header("Location: http://" . $_SERVER['HTTP_HOST'] . "/admin/admin.php"); exit();
            }
            elseif($_GET['route'] === 'logout') {
               unset($_SESSION['admin_login']);
               unset($_SESSION['admin_password']);
               unset($_SESSION['id']);
               unset($_SESSION['admin_name']);
               // session_destroy();
                header("Location: http://" . $_SERVER['HTTP_HOST'] . "/index.php");
            }
        }
?>
		
	

