<?php
header('Content-Type: text/html; charset=utf-8');
header("HTTP/1.0 404 Not Found");
header("HTTP/1.1 404 Not Found");
header("Status: 404 Not Found");

include_once __dir__ . '/view/top-content.html';

include_once __dir__ . '/view/404.html';

include_once __dir__ . '/view/bottom-content.html';

include_once __dir__ . '/view/footer.html';
?>