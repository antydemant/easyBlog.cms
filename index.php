<?php
//��������� ������ ����
require_once ("config.inc.php");
//�������� �� ������������ �����
if (!defined('DB_INSTALL')) {
    //�������� �� �������
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/install/install.php");
    exit();
} else {

    function __autoload($name)
    {
        require_once __dir__ . "/system/$name.class.inc.php";
    }

    $session = new Session();

    $MySQL = new MySQL(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME, '');

    if (!isset($_GET['route']) || empty($_GET['route'])) {

        if (!isset($_GET['id']) || empty($_GET['id'])) {
            //�������� ���������
            include __dir__ . '/user/articles.php';
        } elseif (!$MySQL->getArticles(null, $_GET['id'])) {
            //�������� �������, ���� ID ��������� �� ������� ����
            include __dir__ . '/user/404.php';
        } else {
            //�������� ���������
            include __dir__ . '/user/article.php';

        }
    } elseif ($_GET['route'] === 'admin') {
        //����������� �� ������
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/admin/admin.php");
        exit();
    } elseif ($_GET['route'] === 'logout') {
        $session->unsetSession('admin_login');
        $session->unsetSession('admin_password');
        $session->unsetSession('id');
        $session->unsetSession('admin_name');
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/index.php");
    }
}
?>