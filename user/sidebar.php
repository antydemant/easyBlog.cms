<?php
        //��������� view ���������� ��� ����
        include __DIR__ ."/view/sidebar_about.html";
        //�������� ������ ��� ���������
        $articles = $MySQL->getArticles('all',null);
        if(!empty($articles)) {
            foreach($articles as $row) {
                include __DIR__ . '/view/sidebar.html';
            }
        }

        //�������� ����� ���� ��������
        include __DIR__ ."/view/sidebar_end.html";
?>