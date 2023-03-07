<?php

namespace App\Controller;

use Framework\Controller;

class ProductController extends Controller
{
    public function getAction()
    {
        echo "ProductController::get";
        print_r($_SERVER['URL_PARAMS']);
    }
}
