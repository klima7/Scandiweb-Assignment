<?php

namespace Framework;

class Router
{
    private array $mappings = [];

    public function register(string $url, object $controller): void
    {
        $url = rtrim($url, '/');
        $pattern = '!^' . $url . '$!i';
        $this->mappings[$pattern] = $controller;
    }

    public function handleRequest(): void
    {
        $matchingMapping = $this->getMatchingMapping();
        $matchedPattern = key($matchingMapping);
        $matchedController = current($matchingMapping);
        $this->extractUrlParams($matchedPattern);
        $this->callControllerAction($matchedController);
    }

    private function getMatchingMapping(): array
    {
        $url = rtrim($_SERVER['PATH_INFO'], '/');

        $matching_controllers = array_filter(
            $this->mappings,
            fn ($pattern) => preg_match($pattern, $url),
            ARRAY_FILTER_USE_KEY
        );

        if (count($matching_controllers) == 0) {
            http_response_code(404);
            die();
        }

        if (count($matching_controllers) > 1) {
            http_response_code(500);
            die();
        }

        return $matching_controllers;
    }

    private function extractUrlParams(string $pattern): void
    {
        $url = rtrim($_SERVER['PATH_INFO']);
        $matches = [];
        preg_match($pattern, $url, $matches);
        array_shift($matches);
        $_SERVER['URL_PARAMS'] = $matches;
    }

    private function callControllerAction(object $controller): void
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $handlerName = $method . 'Action';

        if (!method_exists($controller, $handlerName)) {
            http_response_code(404);
            die();
        }

        $controller->$handlerName();
    }
}
