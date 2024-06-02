<?php

use Admin\AdminController;
use Controller\Auth\AuthController;
use Controller\HomeController;
use Foundational\Router\Router;

Router::route('GET', '/test',  function() {
  echo "test ok";
});


Router::route('GET', '/', function(){(new HomeController())->index(); });
Router::route('GET', '/login', function(){ (new AuthController) ->login(); });

// Admin dash route
Router::route('GET', '/dashboard', function() { (new AdminController)->index(); });

// Router::prefix('/testeur')->group(function(){
//   Router::route('GET', '/one', function() {echo "one test"; });
//   Router::route('GET', '/two', function() {echo "tow test"; });
// });

// Router::route('POST', '/hello', function() { echo "hello"; });

// Router::prefix('/other')->group(function(){
//   Router::route('GET', '/one', function() {echo "one other"; });
//   Router::route('GET', '/two', function() {echo "tow other"; });
// });

// Resolve routes
Router::resolve();



// $router = new AltoRouter();
// // $router->setBasePath("/ecommerce");

// // Front route
// $router->map('GET', '/', function(){(new HomeController())->index(); });

// // Auth route
// $router->map('GET', '/login', function(){ (new AuthController) ->login(); });


// // Admin dash route
// $router->map('GET', '/dash', function() { (new AdminController)->index(); });


// // return the current url match
// $match = $router->match();

// // call closure or throw 404 status
// if( is_array($match) && is_callable( $match['target'] ) ) {
// 	call_user_func_array($match['target'], $match['params']);
// } else {
// 	// no route was matched
// 	header("HTTP/1.1 404 Not Found");
// }