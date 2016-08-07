<?php
        //підключаємо view інформацію про блог
        include __DIR__ ."/view/sidebar_about.html";
        //отримуємо ресурс усіх публікацій
        $articles = $MySQL->getArticles('all',null);
        foreach($articles as $row)
        {
            include __DIR__ . '/view/sidebar.html';
        }
        //виводимо кінець коду сайдбара
        include __DIR__ ."/view/sidebar_end.html";
?>