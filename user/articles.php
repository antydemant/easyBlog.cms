<?php
        header('Content-Type: text/html; charset=utf-8');
        if(isset($_GET['page'])) {
            //виводимо публікації з пагінації
            $content = getLastPub($_GET['page']);
        } else {
            //якщо не вибрана пагінація, починаємо зі свіжіших
            $content = getLastPub($_GET['page'] = 1);
        }
        
        include_once __DIR__ . '/view/top-content.html';
        
        include_once __DIR__ . '/view/pagination.html';

        while ($row = mysql_fetch_assoc($content)) { 
            
                include __DIR__ ."/view/articles.html";
                
        }
        include_once __DIR__ . '/view/bottom-content.html';
    
        include_once __DIR__ . '/sidebar.php';
    
        include_once __DIR__ . '/view/footer.html';
?>