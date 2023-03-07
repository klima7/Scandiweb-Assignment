<?php

require __DIR__ . '/inc/bootstrap.php';

use Framework\Router;
use App\Controller\ProductController;
use App\Controller\ProductsController;

$router = new Router();
$router->register('api/products', new ProductsController());
$router->register('api/products/(.*)', new ProductController());
$router->handleRequest();

$_SERVER;
print_r($GLOBALS);