<?php
        //��������� ������ ����
        require_once("config.inc.php");
        //�������� �� ������������ �����
        if(!defined('DB_INSTALL')) {
            //�������� �� �������
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/install/install.php"); exit();
        } else { 
        //����������� �� ����
        require_once __DIR__ ."/system/db.inc.php";
        //��������� ������ ������� ��� ������ � �����
        require_once __DIR__ ."/system/db_lib.inc.php";
        //��������� ����
        require_once __DIR__ ."/system/session_lib.inc.php";
        
        if(!isset($_GET['route']) || empty($_GET['route'])) {
            //�������� ������ ��������� 
            $is_article = getOnePub($_GET['id']);
            //�������� ������� ��������� ��� ��������
            $pagination = mysql_num_rows(getAllPub());
            //���������� ������� ��������, ���������� �� �������
            $pagination_pages = ceil($pagination / 5);
            //�������� ����� ���������
            $index = mysql_fetch_assoc($is_article);
            
                if(!isset($_GET['id']) || empty($_GET['id'])) {
                    //�������� ���������
                    include __DIR__ . '/user/articles.php'; 
                }
                elseif( (int) $_GET['id'] <= 0 || !$index) {
                    //�������� �������, ���� ID ��������� �� ������� ����
                    include __DIR__ . '/user/404.php'; 
                }
                else {
                    //�������� ���������
                    include __DIR__ . '/user/article.php';
                    
                }
        } elseif($_GET['route'] === 'admin') {
                //����������� �� ������
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
		
	

