<?php

namespace Lib\Controller;

use Lib\Model\Product;
use Lib\Validation\ValidationException;

class ProductsController extends Controller
{
    const ERROR_SKU_NOT_UNIQUE = 1;

    public function getAction(): void
    {
        $products = Product::getAll();
        $this->sendResponse($products);
    }

    public function postAction(): void
    {
        $body =$this->sanitizeArrayValues($this->getJsonBody());

        if (!array_key_exists('type', $body)) {
            throw new ValidationException('type', 'property missing');
        }

        $type = $body['type'];

        if (!in_array($type, Product::TYPES)) {
            throw new ValidationException('type', 'invalid value');
        }

        $className = "Lib\\Model\\$type";
        $product = new $className($body);

        try {
            $product->save();
        } catch(\PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                throw new ValidationException('sku', 'not unique value', self::ERROR_SKU_NOT_UNIQUE);
            }
        }

        $this->sendResponse($product, 201);
    }

    public function deleteAction(): void
    {
        $body = $this->getJsonBody();
        if (!array_key_exists('ids', $body)) {
            throw new ValidationException('ids', 'property missing');
        }

        $products = [];
        foreach ($body['ids'] as $id) {
            if (!is_int($id)) {
                throw new ValidationException('ids', 'not number supplied');
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
