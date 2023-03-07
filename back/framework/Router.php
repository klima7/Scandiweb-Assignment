<?php

namespace Framework;

class Router
{
    private array $mappings;
    private bool $ignoreEndSlash;
    private bool $ignoreCase;


    public function __construct($ignoreEndSlash=true, $ignoreCase=true)
    {
        $this->mappings = [];
        $this->ignoreEndSlash = $ignoreEndSlash;
        $this->ignoreCase = $ignoreCase;
    }

    public function register($url, $controller)
    {
        $pattern = '!^' . $url . '$!';
        if ($this->ignoreCase) {
            $pattern .= 'i';
        }
        $this->mappings[$pattern] = $controller;
    }

    public function handleRequest()
    {
        $url = $_SERVER['PATH_INFO'];
        if ($this->ignoreEndSlash) {
            $url = rtrim($url, '/');
        }

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

        $pattern = key($matching_controllers);
        $controller = current($matching_controllers);
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $handlerName = $method . 'Action';

        if (!method_exists($controller, $handlerName)) {
            http_response_code(404);
            die();
        }

        $matches = [];
        preg_match($pattern, $url, $matches);
        array_shift($matches);
        $_SERVER['URL_PARAMS'] = $matches;

        $controller->$handlerName();
    }
}
