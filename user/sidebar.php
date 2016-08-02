<?php
        //підключаємо view інформацію про блог
        include __DIR__ ."/view/sidebar_about.html";
        //отримуємо ресурс усіх публікацій
        $sidebar = getAllPub();
        
        while ($row = mysql_fetch_assoc($sidebar)) { 
                //виводимо усі публікації в сайдбар
                include __DIR__ ."/view/sidebar.html";
        }
        //виводимо кінець коду сайдбара
        include __DIR__ ."/view/sidebar_end.html";
?>