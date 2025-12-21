<?php

class Router
{
    private array $routes = [];
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function addRoute(string $method, string $path, array $handler)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler,
        ];
    }

    private function match(string $method, string $uri): ?array
    {
        foreach ($this->routes as $route) {
            $pattern = preg_replace('/\{(\w+)\}/', '(?<$1>[^\/]+)', $route['path']);
            $pattern = '#^' . $pattern . '$#';

            if ($route['method'] === strtoupper($method) &&
                preg_match($pattern, $uri, $matches)) {

                $route['params'] = array_filter(
                    $matches,
                    'is_string',
                    ARRAY_FILTER_USE_KEY
                );
                return $route;
            }
        }
        return null;
    }

    public function handleRequest(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $route = $this->match($method, $uri);

        if (!$route) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }

        [$class, $methodName] = $route['handler'];

        $controller = new $class($this->pdo);
        call_user_func_array(
            [$controller, $methodName],
            $route['params'] ?? []
        );
    }
}
