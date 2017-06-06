<?php

if (!isset($_GET['route']) || empty($_GET['route'])) {

    header('Content-Type: text/html; charset=utf-8');
    include __dir__ . '/view/top-content.html';
    $articles = $MySQL->getArticles('all', null);
    if(!empty($articles)) {
        foreach ($articles as $row) {
            include __dir__ . '/view/articles.html';
        }
    }

} elseif ($_GET['route'] === 'admin_add' && $MySQL->getAdmin($session->getSession('admin_login'))['role'] == 1 ) {

    header('Content-Type: text/html; charset=utf-8');
    include __dir__ . '/view/top-content.html';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && validate_add_admin()) {
        $name = addslashes(trim($_POST['admin_name']));
        $login = addslashes(trim($_POST['admin_login']));
        $password = md5(addslashes(trim($_POST['admin_password'])));
        if ($MySQL->addAdmin($name, $login, $password, 1)) {
            $success = 'Адміністратора додано!!';
        }
    }
    include __dir__ . '/view/admin-add.html';

} elseif ($_GET['route'] === 'add' && $MySQL->getAdmin($session->getSession('admin_login'))['role'] == 1) {

    header('Content-Type: text/html; charset=utf-8');
    include __dir__ . '/view/top-content.html';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && validate_edit_add()) {
        $title = addslashes(trim($_POST['title']));
        $text = addslashes(trim($_POST['text']));
        if ($MySQL->addArticle($title, time(), $text, $_SESSION['id'])) {
            $success = 'Публікацію створено!';
        } else {
            $success = 'Помилка створення публыкації!';
        }
    }
    include __dir__ . '/view/article-add.html';



} elseif ($_GET['route'] === 'edit' && $MySQL->getAdmin($session->getSession('admin_login'))['role'] == 1) {

    header('Content-Type: text/html; charset=utf-8');
    include __dir__ . '/view/top-content.html';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && validate_edit_add()) {
        $title = addslashes(trim($_POST['title']));
        $text = addslashes(trim($_POST['text']));
        if ($MySQL->updArticle($_POST['pub_id'], $title, $text, $_SESSION['id'])) {
            $success = 'Публікацію оновлено!';
        } else {
            $success = 'Помилка оновлення публікації!';
        }
    }
    $articles = $MySQL->getArticles(null, $_GET['id']);
    foreach ($articles as $row) {
        include __dir__ . '/view/article-edit.html';
    }
} elseif ($_GET['route'] === 'del' && $MySQL->getAdmin($session->getSession('admin_login'))['role'] == 1) {

    $MySQL->delArticle($_GET['id']);
    header('Content-Type: text/html; charset=utf-8');
    include __dir__ . '/view/top-content.html';
    $articles = $MySQL->getArticles(null, $_GET['id']);
    foreach ($articles as $row) {
        include __dir__ . '/view/articles.html';
    }
}

else {
    include_once __dir__ . '/404.php';
}
include __dir__ . '/view/bottom-content.html';
include __dir__ . '/view/footer.html';

?>