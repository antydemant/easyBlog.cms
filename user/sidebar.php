<?php
        //��������� view ���������� ��� ����
        include __DIR__ ."/view/sidebar_about.html";
        //�������� ������ ��� ���������
        $articles = $MySQL->getArticles('all',null);
        foreach($articles as $row)
        {
            include __DIR__ . '/view/sidebar.html';
        }
        //�������� ����� ���� ��������
        include __DIR__ ."/view/sidebar_end.html";
?>