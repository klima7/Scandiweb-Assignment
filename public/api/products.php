<?php

require __DIR__ . '/../../php/inc/bootstrap.php';

use Lib\Controller\ProductsController;

$controller = new ProductsController();
$controller->handleRequest();
