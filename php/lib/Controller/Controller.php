<?php

namespace Lib\Controller;

abstract class Controller
{
    public function handleRequest(): void
    {
        $handlerName = strtolower($_SERVER['REQUEST_METHOD']) . 'Action';
        $this->$handlerName();
    }

    protected function getAction(): void
    {
        $this->sendResponse(null, 404);
    }

    protected function postAction(): void
    {
        $this->sendResponse(null, 404);
    }

    protected function deleteAction(): void
    {
        $this->sendResponse(null, 404);
    }

    protected function sendResponse($data, int $status=200): void
    {
        http_response_code($status);
        if (is_array($data)) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
        } elseif (is_string($data)) {
            header('Content-Type: text/html; charset=utf-8');
            echo $data;
        } elseif (!is_null($data)) {
            die("Invalid response data");
        }
    }
}
