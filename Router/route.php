<?php

use Foundational\Router\Router;

Router::addMiddleware(function($request, $next) {
    error_log("Requête : " . $request->getMethod() . " " . $request->getUri()->getPath());
    return $next($request);
});

Router::get('/', 'HomeController:index')->setName('home.index');
Router::get('/dashboard', '\Admin\AdminController:index')->setName('admin.index');

// Router::get('/test/convertczk', 'ControllerOrder:GetPriceAndConvertToCzk')
//     ->setName('GetPriceAndConvertToCzk');

// Router::get('/', function($request, $responseFactory) {
//     $response = $responseFactory->createResponse(200);
//     $response->getBody()->write('Bienvenue à la page d\'accueil');
//     return $response;
// })->setName('home');

// Router::group('/admin', function() {
//     Router::get('/dashboard', function($request, $responseFactory) {
//         $response = $responseFactory->createResponse(200);
//         $response->getBody()->write('Admin Dashboard');
//         return $response;
//     })->setName('admin.dashboard');
// });

Router::resolve();

// // Générer URL dans le code :
// $url = Router::url('GetPriceAndConvertToCzk', ['id' => 123]);
// echo "URL générée pour route : $url";
