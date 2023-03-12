<?php

namespace Lib\Controller;

use Lib\Model\Product;
use Lib\Validation\ValidationException;

class ProductsController extends Controller
{
    public function getAction(): void
    {
        $products = Product::getAll();
        $this->sendResponse($products);
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
        $product->save();
        $this->sendResponse($product, 201);
    }

    public function deleteAction(): void
    {
        $body = $this->getRequestBody();
        if (!array_key_exists('ids', $body)) {
            throw new ValidationException("Missing ids property");
        }

        foreach ($body['ids'] as $id) {
            $product = Product::get($id);
            $product->delete();
        }

        $this->sendResponse([], 204);
    }
}
