<?php

namespace Lib\Controller;

use Lib\Controller\Controller;

class ProductsController extends Controller
{
    public function getAction(): void
    {
        $this->sendResponse([1, 2, 3, 4]);
    }

    public function deleteAction(): void
    {
        echo "ProductsController::delete";
    }

    public function postAction(): void
    {
        echo "ProductsController::get";
    }
}
