<?php

$request = $_SERVER['REQUEST_URI'];
switch ($request) {
  case '':
  case '/':
    require __DIR__ . '/views/home.php';
    break;
  case '/login':
    require __DIR__ . '/views/login.php';
    break;
  case '/register':
    require __DIR__ . '/views/register.php';
    break;
  case '/contact-us':
    require __DIR__ . '/views/contact-us.php';
    break;
  case '/blog-detail':
    require __DIR__ . '/views/blog-detail.php';
    break;
  case '/add-blog':
    require __DIR__ . '/views/add-blog.php';
    break;
  case '/upload-img':
    require __DIR__ . '/views/upload-img.php';
    break;
  default:
    http_response_code(404);
    require __DIR__ . '/views/404.php';
    break;
}
