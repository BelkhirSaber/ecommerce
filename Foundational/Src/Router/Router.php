<?php
namespace Foundational\Router;

use AltoRouter;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use UnexpectedValueException;
use Throwable;

class Router
{
    private AltoRouter $router;
    private string $prefix = '';
    private static ?self $instance = null;
    private Psr17Factory $psr17Factory;
    private ServerRequestCreator $serverRequestCreator;

    /** @var Route[] Liste des routes */
    private array $routes = [];

    /** @var callable[] Middleware stack */
    private array $middlewares = [];

    private function __construct()
    {
        $this->router = new AltoRouter();
        $this->psr17Factory = new Psr17Factory();
        $this->serverRequestCreator = new ServerRequestCreator(
            $this->psr17Factory,
            $this->psr17Factory,
            $this->psr17Factory,
            $this->psr17Factory
        );
    }

    private static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function addMiddleware(callable $middleware): void
    {
        $instance = self::getInstance();
        $instance->middlewares[] = $middleware;
    }

    public static function addRoute(string $method, string $path, callable|string $handler): Route
    {
        $instance = self::getInstance();

        if (!str_starts_with($path, '/')) {
            throw new UnexpectedValueException("Le chemin doit commencer par '/'");
        }

        $fullPath = $instance->prefix . $path;

        // On enregistre la route dans AltoRouter
        $instance->router->map($method, $fullPath, $handler);

        $route = new Route($method, $fullPath, $handler);
        $instance->routes[] = $route;

        return $route;
    }

    public static function get(string $path, callable|string $handler): Route
    {
        return self::addRoute('GET', $path, $handler);
    }

    public static function post(string $path, callable|string $handler): Route
    {
        return self::addRoute('POST', $path, $handler);
    }

    public static function put(string $path, callable|string $handler): Route
    {
        return self::addRoute('PUT', $path, $handler);
    }

    public static function delete(string $path, callable|string $handler): Route
    {
        return self::addRoute('DELETE', $path, $handler);
    }

    /**
     * Résout la requête, exécute middlewares puis route, puis envoie la réponse
     */
    public static function resolve(): void
    {
        $instance = self::getInstance();

        $request = $instance->serverRequestCreator->fromGlobals();
        $uri = $request->getUri()->getPath();
        $method = $request->getMethod();

        $match = $instance->router->match($uri, $method);

        if ($match) {
            $handler = $match['target'];

            try {
                // Core route handler callable
                $core = function (ServerRequestInterface $req) use ($handler, $match, $instance) {
                    $params = $match['params'] ?? [];

                    if (is_callable($handler)) {
                        return call_user_func_array($handler, array_merge([$req, $instance->psr17Factory], $params));
                    }

                    if (is_string($handler) && str_contains($handler, ':')) {
                        [$controller, $methodName] = explode(':', $handler);
                        if (!class_exists($controller)) {
                            throw new \RuntimeException("Controller $controller not found");
                        }
                        $controllerInstance = new $controller();
                        if (!method_exists($controllerInstance, $methodName)) {
                            throw new \RuntimeException("Method $methodName not found in $controller");
                        }
                        return call_user_func_array([$controllerInstance, $methodName], array_merge([$req, $instance->psr17Factory], $params));
                    }

                    throw new \RuntimeException("Handler must be callable or Controller:method string");
                };

                // Compose middlewares chain
                $middlewareStack = array_reduce(
                    array_reverse($instance->middlewares),
                    fn($next, $middleware) => fn($req) => $middleware($req, $next),
                    $core
                );

                $response = $middlewareStack($request);

                if (!$response instanceof ResponseInterface) {
                    throw new \RuntimeException('Le callback doit retourner un objet ResponseInterface');
                }

                self::sendResponse($response);
            } catch (Throwable $e) {
                self::handleException($e);
            }
        } else {
            self::sendResponse(
                $instance->psr17Factory->createResponse(404)
                    ->withBody($instance->psr17Factory->createStream('404 - Page non trouvée'))
            );
        }
    }

    /**
     * Génère une URL depuis le nom de la route et ses paramètres
     * 
     * @param string $routeName
     * @param array $params
     * @return string URL ou chaîne vide si nom non trouvé
     */
    public static function url(string $routeName, array $params = []): string
    {
        $instance = self::getInstance();

        $route = null;
        foreach ($instance->routes as $r) {
            if ($r->getName() === $routeName) {
                $route = $r;
                break;
            }
        }

        if ($route === null) {
            return '';
        }

        // AltoRouter génère l'URL complète
        return $instance->router->generate($routeName, $params);
    }

    private static function sendResponse(ResponseInterface $response): void
    {
        http_response_code($response->getStatusCode());

        foreach ($response->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                header("$name: $value", false);
            }
        }

        echo $response->getBody();
    }

    private static function handleException(Throwable $e): void
    {
        $instance = self::getInstance();

        $response = $instance->psr17Factory->createResponse(500);
        $stream = $instance->psr17Factory->createStream("Erreur interne du serveur\n" . $e->getMessage());

        $response = $response->withBody($stream);

        self::sendResponse($response);
    }

    public static function prefix(string $prefix): self
    {
        $instance = self::getInstance();

        if (!str_starts_with($prefix, '/')) {
            throw new UnexpectedValueException("Le préfixe doit commencer par '/'");
        }

        $instance->prefix = rtrim($prefix, '/');

        return $instance;
    }

    public static function group(string $prefix, callable $callable): void
    {
        $instance = self::getInstance();
        $oldPrefix = $instance->prefix;

        self::prefix($prefix);
        $callable();
        $instance->prefix = $oldPrefix;
    }
}
