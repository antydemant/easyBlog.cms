<?php
        
        if (!isset($_GET['route']) || empty($_GET['route'])) {
        
            header('Content-Type: text/html; charset=utf-8');
            include __dir__ . '/view/top-content.html';
            while ($row = mysql_fetch_assoc($content)) {
                include __dir__ . '/view/articles.html';
            }
        } elseif($_GET['route'] === 'admin_add') {
        
            header('Content-Type: text/html; charset=utf-8');
            include __dir__ . '/view/top-content.html';

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && validate_add_admin()) {
                $name = addslashes(trim($_POST['admin_name']));
                $login = addslashes(trim($_POST['admin_login']));
                $password = md5(addslashes(trim($_POST['admin_password'])));
                if(addAdmin($name,$login,$password)) {
                    $success = 'Публікацію створено!';
                }
            }
            include __dir__ . '/view/admin-add.html';
            
        } elseif ($_GET['route'] === 'add') {
        
            header('Content-Type: text/html; charset=utf-8');
            include __dir__ . '/view/top-content.html';

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && validate_edit_add()) {
                $title = addslashes(trim($_POST['title']));
                $text = addslashes(trim($_POST['text']));
                addPub($title, time(), $text, $_SESSION['id']);
                $success = 'Публікацію створено!';
            }
            include __dir__ . '/view/article-add.html';
            
        
        } elseif ((int)$_GET['id'] <= 0 || !$index) {
        
            include_once __dir__ . '/404.php';
        
        } elseif ($_GET['route'] === 'edit') {
        
            header('Content-Type: text/html; charset=utf-8');
            include __dir__ . '/view/top-content.html';
        
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && validate_edit_add()) {
                $title = addslashes(trim($_POST['title']));
                $text = addslashes(trim($_POST['text']));
                editPub($_POST['pub_id'], $title, $text, $_SESSION['id']);
                $success = 'Публікацію оновлено!';
            }
            $one_article = getOnePub($_GET['id']);
            while ($row = mysql_fetch_assoc($one_article)) {
                include __dir__ . '/view/article-edit.html';
            }
        } elseif ($_GET['route'] === 'del') {
        
            delPub($_GET['id']);
            header('Content-Type: text/html; charset=utf-8');
            include __dir__ . '/view/top-content.html';
            $content = getAllPub();
            while ($row = mysql_fetch_assoc($content)) {
                include __dir__ . '/view/articles.html';
            }
        }
        include __dir__ . '/view/bottom-content.html';
        include __dir__ . '/view/footer.html';

?>