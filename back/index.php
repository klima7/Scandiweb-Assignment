<?php

require __DIR__ . '/inc/bootstrap.php';

use Framework\Router;
use App\Controller\ProductController;
use App\Controller\ProductsController;

header('Content-Type: application/json; charset=utf-8');

$router = new Router();
$router->register('/api/products', new ProductsController());
$router->register('/api/products/(\d+)', new ProductController());
$router->handleRequest();
