<?php
    header('Content-Type: text/html; charset=utf-8');
    
    include_once __DIR__ . '/view/top-content.html';
    
    $articles = $MySQL->getArticles(null,$_GET['id']);
    
    foreach($articles as $row) {
        include __DIR__ . '/view/article.html';
    }

    include_once __DIR__ . '/view/bottom-content.html';
    
    include_once __DIR__ . '/sidebar.php';
    
    include_once __DIR__ . '/view/footer.html';
?>
