<?php
        //��������� view ���������� ��� ����
        include __DIR__ ."/view/sidebar_about.html";
        //�������� ������ ��� ���������
        $sidebar = getAllPub();
        
        while ($row = mysql_fetch_assoc($sidebar)) { 
                //�������� �� ��������� � �������
                include __DIR__ ."/view/sidebar.html";
        }
        //�������� ����� ���� ��������
        include __DIR__ ."/view/sidebar_end.html";
?>