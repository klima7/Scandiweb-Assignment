<?php

namespace Lib\Controller;

use Lib\Data\Database;

class ProductsController extends Controller
{
    private object $productRepository;

    public function __construct()
    {
        $this->productRepository = Database::getInstance()->getProductRepository();
    }

    public function getAction(): void
    {
        $products = $this->productRepository->getAll();
        $this->sendResponse($products);
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
