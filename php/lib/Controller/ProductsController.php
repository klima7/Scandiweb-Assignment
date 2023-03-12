<?php

namespace Lib\Controller;

use Lib\Data\Database;
use Lib\Validation\ValidationException;

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
        $body = $this->getRequestBody();
        if (!array_key_exists('ids', $body)) {
            throw new ValidationException("Missing ids property");
        }

        foreach ($body['ids'] as $id) {
            $product = $this->productRepository->get($id);
            $this->productRepository->delete($product);
        }

        $this->sendResponse([], 204);
    }

    public function postAction(): void
    {
        $body = $this->getRequestBody();

        if (!array_key_exists('type', $body)) {
            throw new ValidationException("Missing type property");
        }

        $type = $body['type'];

        if (!in_array($type, ['book', 'disc', 'furniture'])) {
            throw new ValidationException("Invalid type value");
        }

        $className = "Lib\\Model\\$type";
        $product = new $className($body, true);
        $this->productRepository->save($product);
        $this->sendResponse($product, 201);
    }
}
