<?php
    header('Content-Type: text/html; charset=utf-8');
    header("HTTP/1.0 404 Not Found");
    header("HTTP/1.1 404 Not Found");
    header("Status: 404 Not Found");

    include_once __DIR__ . '/view/top-content.html';

    include_once __DIR__ . '/view/404.html';

    include_once __DIR__ . '/view/bottom-content.html';

    include_once __DIR__ . '/sidebar.php';

    include_once __DIR__ . '/view/footer.html';
