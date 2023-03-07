<?php

namespace Framework;

abstract class Controller
{
    public function __invoke(string $method)
    {
        $handlerName = strtolower($method) . 'Action';
        $this->$handlerName();
    }

    protected function getAction()
    {
        $this->sendResponse(null, 404);
    }

    protected function postAction()
    {
        $this->sendResponse(null, 404);
    }

    protected function deleteAction()
    {
        $this->sendResponse(null, 404);
    }

    protected function putAction()
    {
        $this->sendResponse(null, 404);
    }

    protected function patchAction()
    {
        $this->sendResponse(null, 404);
    }

    protected function sendResponse($data, int $status=200)
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
