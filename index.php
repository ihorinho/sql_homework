<?php

// admin@adminka.com, 'komarik333';
// manager@adminka.com 'qweqwe111';
//echo md5(md5('salt') . 'qweqwe111');

//My settings
// $link = mysqli_connect(
//     "127.0.0.1:3307",
//     "root",
//     "",
//     "mvc_group_609"
// );

$link = mysqli_connect(
    "127.0.0.1",
    "root",
    "",
    "mvc_group_609"
);
session_start();
require 'inc/functions.php';
// $_GET['page']. If not set, then = 'home'
$page = get('page', 'home');
$page .= '.php';
$pages_available = scandir('pages');
array_shift($pages_available);
array_shift($pages_available);
if (!in_array($page, $pages_available)) {
    $page = '404.php';
}
ob_start();
require 'pages/' . $page;
$content = ob_get_clean();
require 'layout.php';