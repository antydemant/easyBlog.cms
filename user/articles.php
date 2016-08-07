<?php
header('Content-Type: text/html; charset=utf-8');


include_once __dir__ . '/view/top-content.html';

include_once __dir__ . '/view/pagination.html';

if (isset($_GET['page'])) {
    //виводимо публікації з пагінації
    $articles = $MySQL->getArticles($_GET['page']);
} else {
    //якщо не вибрана пагінація, починаємо зі свіжіших
    $articles = $MySQL->getArticles($_GET['page'] = 1);
}
    foreach($articles as $row) {
        include __DIR__ . '/view/articles.html';
    }

include_once __dir__ . '/view/bottom-content.html';

include_once __dir__ . '/sidebar.php';

include_once __dir__ . '/view/footer.html';
?>