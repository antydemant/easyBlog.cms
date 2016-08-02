<?php
    header('Content-Type: text/html; charset=utf-8');
    
    include_once __DIR__ . '/view/top-content.html';
    
    $article = getOnePub($_GET['id']);
    
        while ($row = mysql_fetch_assoc($article)) { 
            
                include __DIR__ ."/view/article.html";
                
        }

    include_once __DIR__ . '/view/bottom-content.html';
    
    include_once __DIR__ . '/sidebar.php';
    
    include_once __DIR__ . '/view/footer.html';
?>
