<?php

require __DIR__ . '/../../inc/bootstrap.php';

use Lib\Controller\ProductsController;

$controller = new ProductsController();
$controller->handleRequest();
