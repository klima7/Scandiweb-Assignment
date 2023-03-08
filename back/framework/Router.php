<?php

namespace Framework;

class Router
{
    private array $mappings = [];

    public function register(string $path, object $controller): void
    {
        $path = rtrim($path, '/');
        $pattern = '!^' . $path . '$!i';
        $this->mappings[$pattern] = $controller;
    }

    public function handleRequest(): void
    {
        $matchedMapping = $this->getMatchingMapping();
        $matchedPattern = key($matchedMapping);
        $matchedController = current($matchedMapping);
        $this->extractUrlParams($matchedPattern);
        $matchedController($_SERVER['REQUEST_METHOD']);
    }

    private function getMatchingMapping(): array
    {
        $path = $this->getRequestedPath();

        $matchingControllers = array_filter(
            $this->mappings,
            fn ($pattern) => preg_match($pattern, $path),
            ARRAY_FILTER_USE_KEY
        );

        if (count($matchingControllers) == 0) {
            http_response_code(404);
            die();
        }

        if (count($matchingControllers) > 1) {
            http_response_code(500);
            die();
        }

        return $matchingControllers;
    }

    private function extractUrlParams(string $pattern): void
    {
        $url = $this->getRequestedPath();
        $matches = [];
        preg_match($pattern, $url, $matches);
        array_shift($matches);
        $_SERVER['URL_PARAMS'] = $matches;
    }

    private function getRequestedPath(): string
    {
        $parsed = parse_url($_SERVER['REQUEST_URI']);
        return $parsed["path"];
    }
}
