<?php

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

$dispatcher = simpleDispatcher(function(RouteCollector $r) {
    
    // ========================================
    // ROUTES FRONT-END (Site Web Public)
    // ========================================
    
    // Page d'accueil
    $r->addRoute('GET', '/', 'Controller\HomeController@index');
    
    // Catalogue & Produits
    $r->addRoute('GET', '/shop', 'Controller\ShopController@index');
    $r->addRoute('GET', '/shop/category/{slug}', 'Controller\ShopController@category');
    $r->addRoute('GET', '/product/{id:\d+}/{slug}', 'Controller\ProductController@show');
    
    // Panier
    $r->addRoute('GET', '/cart', 'Controller\CartController@index');
    $r->addRoute('POST', '/cart/add', 'Controller\CartController@add');
    
    // Authentification
    $r->addRoute('GET', '/login', 'Controller\Auth\LoginController@showLoginForm');
    $r->addRoute('POST', '/login', 'Controller\Auth\LoginController@login');
    $r->addRoute('GET', '/logout', 'Controller\Auth\LoginController@logout');
    
    // ========================================
    // ROUTES ADMIN (Dashboard Back-Office)
    // ========================================
    
    $r->addGroup('/admin', function (RouteCollector $r) {
        
        // Dashboard
        $r->addRoute('GET', '', 'Admin\DashboardController@index');
        $r->addRoute('GET', '/dashboard', 'Admin\DashboardController@index');
        
        // Produits
        $r->addRoute('GET', '/products', 'Admin\ProductController@index');
        $r->addRoute('GET', '/products/create', 'Admin\ProductController@create');
        $r->addRoute('POST', '/products', 'Admin\ProductController@store');
        $r->addRoute('GET', '/products/{id:\d+}/edit', 'Admin\ProductController@edit');
        $r->addRoute('POST', '/products/{id:\d+}/update', 'Admin\ProductController@update');
        $r->addRoute('POST', '/products/{id:\d+}/delete', 'Admin\ProductController@destroy');
        
        // Catégories
        $r->addRoute('GET', '/categories', 'Admin\CategoryController@index');
        $r->addRoute('GET', '/categories/create', 'Admin\CategoryController@create');
        $r->addRoute('POST', '/categories', 'Admin\CategoryController@store');
        
        // Commandes
        $r->addRoute('GET', '/orders', 'Admin\OrderController@index');
        $r->addRoute('GET', '/orders/{id:\d+}', 'Admin\OrderController@show');
        
        // Clients
        $r->addRoute('GET', '/customers', 'Admin\CustomerController@index');
        
        // Paramètres
        $r->addRoute('GET', '/settings', 'Admin\SettingsController@index');
        $r->addRoute('POST', '/settings', 'Admin\SettingsController@update');
    });
});

// ========================================
// DISPATCH
// ========================================

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Retirer query strings
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

// Retirer le préfixe du projet (ex: /ecommerce sur XAMPP). Vide si docroot = Public/
$basePath = RACINE === '' ? '' : '/' . RACINE;
if ($basePath !== '' && strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}
if (empty($uri)) {
    $uri = '/';
}

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::FOUND:
        [$controller, $method] = explode('@', $routeInfo[1]);
        $params = $routeInfo[2];
        
        // Détecter si route admin
        define('IS_ADMIN_ROUTE', strpos($uri, '/admin') === 0);
        
        // Instancier controller
        if (class_exists($controller)) {
            $controllerInstance = new $controller();
            if (method_exists($controllerInstance, $method)) {
                call_user_func_array([$controllerInstance, $method], $params);
            } else {
                http_response_code(500);
                die("Method {$method} not found");
            }
        } else {
            http_response_code(500);
            die("Controller {$controller} not found");
        }
        break;
        
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        echo '404 - Page Not Found';
        break;
        
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        echo '405 - Method Not Allowed';
        break;
}