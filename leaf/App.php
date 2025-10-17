<?php

declare(strict_types=1);

namespace Leaf;

use Closure;
use RuntimeException;

class App
{
    /**
     * @var array<string, array<int, array<string, mixed>>>
     */
    protected array $routes = [];

    public function get(string $path, $handler): void
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, $handler): void
    {
        $this->addRoute('POST', $path, $handler);
    }

    public function put(string $path, $handler): void
    {
        $this->addRoute('PUT', $path, $handler);
    }

    public function delete(string $path, $handler): void
    {
        $this->addRoute('DELETE', $path, $handler);
    }

    public function patch(string $path, $handler): void
    {
        $this->addRoute('PATCH', $path, $handler);
    }

    protected function addRoute(string $method, string $path, $handler): void
    {
        $pattern = $this->compileUri($path);
        $this->routes[$method][] = [
            'path' => $path,
            'pattern' => $pattern,
            'handler' => $handler,
        ];
    }

    public function run(): void
    {
        $method = $this->resolveMethod();
        $uri = $this->resolveUri();

        if (!isset($this->routes[$method])) {
            $this->abort(404, 'Route not defined.');
            return;
        }

        foreach ($this->routes[$method] as $route) {
            if (preg_match($route['pattern'], $uri, $matches)) {
                $params = $this->extractParams($matches);
                $this->dispatch($route['handler'], $params);
                return;
            }
        }

        $this->abort(404, 'Page not found.');
    }

    protected function dispatch($handler, array $params = []): void
    {
        $params = array_map(static function ($value) {
            if (is_string($value) && ctype_digit($value)) {
                return (int) $value;
            }

            return $value;
        }, $params);

        if ($handler instanceof Closure || is_callable($handler)) {
            $handler(...array_values($params));
            return;
        }

        if (is_string($handler) && strpos($handler, '@') !== false) {
            [$class, $method] = explode('@', $handler);
            if (!class_exists($class)) {
                throw new RuntimeException("Controller {$class} tidak ditemukan");
            }
            $instance = new $class();
            if (!method_exists($instance, $method)) {
                throw new RuntimeException("Metode {$method} tidak ditemukan pada controller {$class}");
            }
            $instance->{$method}(...array_values($params));
            return;
        }

        if (is_array($handler) && isset($handler[0], $handler[1])) {
            [$class, $method] = $handler;
            if (is_string($class) && class_exists($class)) {
                $class = new $class();
            }
            if (!is_callable([$class, $method])) {
                throw new RuntimeException('Handler tidak dapat dipanggil.');
            }
            $class->{$method}(...array_values($params));
            return;
        }

        throw new RuntimeException('Handler route tidak valid.');
    }

    protected function resolveMethod(): string
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper((string) $_POST['_method']);
        }

        return $method;
    }

    protected function resolveUri(): string
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $uri = strtok($uri, '?') ?: '/';

        return rtrim($uri, '/') ?: '/';
    }

    protected function extractParams(array $matches): array
    {
        $params = [];
        foreach ($matches as $key => $value) {
            if (is_string($key)) {
                $params[$key] = $value;
            }
        }

        return $params;
    }

    protected function compileUri(string $path): string
    {
        $pattern = preg_replace('#\{([^/]+)\}#', '(?P<$1>[^/]+)', $path);
        $pattern = rtrim($pattern, '/');
        if ($pattern === '') {
            $pattern = '/';
        }

        return '#^' . $pattern . '$#';
    }

    protected function abort(int $status, string $message): void
    {
        http_response_code($status);
        echo $message;
    }
}
