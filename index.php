<?php
// connecting config file
require_once ("config.inc.php");

// checking installation
if (!defined('DB_INSTALL')) {

    // redirect to installation
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/install/install.php");
    exit();

} else {

    function __autoload($name)
    {
        require_once __dir__ . "/system/$name.class.inc.php";
    }

    $session = new Session();

    $MySQL = new MySQL(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME, '');


    if(isset($_POST['comment_submit']) && isset($_POST['comment_text']) && !empty($_POST['comment_text']))
    {
        $success = null;
        $comment = htmlspecialchars(trim(substr($_POST['comment_text'], 0, 100)));
        if ($MySQL->addComment($comment, $session->getSession('id'), time(), (int) $_GET['id'])) {
            $success = 'Коментар додано!';
        } else {
            $success = 'Помилка додання коментаря!';

        }

        include __dir__ . '/user/article.php';

    } elseif (!isset($_GET['route']) || empty($_GET['route'])) {

        if (!isset($_GET['id']) || empty($_GET['id'])) {

            include __dir__ . '/user/articles.php';

        } elseif (!$MySQL->getArticles(null, $_GET['id'])) {

            include __dir__ . '/user/404.php';

        } else {

            include __dir__ . '/user/article.php';

        }
    } elseif ($_GET['route'] === 'admin') {

        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/admin/admin.php"); exit();

    } elseif ($_GET['route'] === 'logout') {

        $session->unsetSession('admin_login');
        $session->unsetSession('admin_password');
        $session->unsetSession('id');
        $session->unsetSession('admin_name');
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/index.php");

    }
}
?>