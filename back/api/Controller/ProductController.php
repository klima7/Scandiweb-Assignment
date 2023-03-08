<?php

namespace Api\Controller;

use Framework\Controller;

class ProductController extends Controller
{
    public function getAction()
    {
        $data = [
          'ala' => 'kot',
          'ma' => [1, 2, 3, 4],
        ];
        $this->sendResponse($data, 201);
    }
}
