<?php



include_once __DIR__ . '/view/top-content.html';

$comments = $MySQL->getComments($_GET['id']);
if(!empty($comments)) {
    foreach($comments as $comment) {
        include __DIR__ . '/view/comment.html';
    }
} else {
    $comments_empty = 'Коментарі відсутні';
}
include_once __DIR__ . '/view/add-comment.html';

include_once __DIR__ . '/view/bottom-content.html';

include_once __DIR__ . '/sidebar.php';

include_once __DIR__ . '/view/footer.html';
?>
