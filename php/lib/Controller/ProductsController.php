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
        $body =$this->sanitizeArrayValues($this->getJsonBody());

        if (!array_key_exists('type', $body)) {
            throw new ValidationException("missing type property");
        }

        $type = $body['type'];

        if (!in_array($type, Product::TYPES)) {
            throw new ValidationException("invalid type value");
        }

        $className = "Lib\\Model\\$type";
        $product = new $className($body);
        $product->save();
        $this->sendResponse($product, 201);
    }

    public function deleteAction(): void
    {
        $body = $this->getJsonBody();
        if (!array_key_exists('ids', $body)) {
            throw new ValidationException("missing ids property");
        }

        $products = [];
        foreach ($body['ids'] as $id) {
            if (!is_int($id)) {
                throw new ValidationException("ids must be integers");
            }
            $product = Product::get($id);
            if ($product != null) {
                $products[] = $product;
            }
        }

        array_map(fn ($product) => $product->delete(), $products);

        $this->sendResponse([], 204);
    }

    private function sanitizeArrayValues($array): array
    {
        return array_map(function ($var) {
            if (is_string($var)) {
                return filter_var($var, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            return $var;
        }, $array);
    }
}
