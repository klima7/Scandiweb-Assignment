<?php

namespace Api\Controller;

use Framework\Controller;

class ProductsController extends Controller
{
    public function getAction()
    {
        echo "ProductsController::get";
        print_r($_SERVER['URL_PARAMS']);
    }
}
