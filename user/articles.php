<?php
header('Content-Type: text/html; charset=utf-8');


include_once __dir__ . '/view/top-content.html';

include_once __dir__ . '/view/pagination.html';

if (isset($_GET['page'])) {

    $articles = $MySQL->getArticles($_GET['page']);
} else {

    $articles = $MySQL->getArticles($_GET['page'] = 1);
}
    if(!empty($articles)) {
        foreach($articles as $row) {
            include __DIR__ . '/view/articles.html';
        }
    }

include_once __dir__ . '/view/bottom-content.html';

include_once __dir__ . '/sidebar.php';

include_once __dir__ . '/view/footer.html';
?>