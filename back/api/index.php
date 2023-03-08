<?php

require __DIR__ . '/../inc/bootstrap.php';

use Api\Controller\ProductController;
use Api\Controller\ProductsController;
use Framework\Router;

$router = new Router();
$router->register('/api/products', new ProductsController());
$router->register('/api/products/(\d+)', new ProductController());
$router->handleRequest();
