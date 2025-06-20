<?php

/**
 * Author: Saber Belkhir,
 * Date: 24-02-2024
 */

namespace Foundational\Router;

use AltoRouter;
use UnexpectedValueException;

class Router {

  private $router;
  private $prefix;
  private static $instance;

  private function __construct()
  {
    $this->router =  new AltoRouter();
    $this->prefix = "";
  }

  /**
   * Create Instance
   * @return static
   */
  private static function createInstance() : static
  {
    if(empty(static::$instance))
    {
      static::$instance = new static();
    }

    return static::$instance;
  }

  /**
   * Get the value of prefix
   */ 
  public function getPrefix()
  {
    return $this->prefix;
  }

  /**
   * Set the value of prefix
   *
   * @return  self
   */ 
  public function setPrefix($prefix)
  {
    $this->prefix = $prefix;

    return $this;
  }

  /**
   * Create Routes
   * 
   * @param string $http_method
   * @param string $path
   * @param callable $callable
   */
  public static function route(string $http_method, string $path, callable $callable, ?string $route_name = null)
  {
    static::createInstance();
    if(!str_contains($path, '/')) 
      return throw  new UnexpectedValueException("Route Path Not Contains '/'");
    if($path[0] != '/') 
      return throw  new UnexpectedValueException("Route Path Not Contains '/' At First Character");
    $path = !empty(static::$instance->prefix) ? static::$instance->prefix . $path : $path;
    static::$instance->router->map($http_method, $path, $callable, $route_name);
  }

  /**
   * Resolve Routes
   */
  public static function resolve()
  {
    $match = static::$instance->router->match();
    // -- call closure or throw 404 status
    if( is_array($match) && is_callable( $match['target'] ) )
    {
      call_user_func_array($match['target'], $match['params']);
    }
    else
    {
    	// -- no route was matched
      header("HTTP/1.1 404 Not Found");
    }
  }

  /**
   * Set Route Prefix
   * @param string $prefix
   * 
   * @return static
   */
  public static function prefix(string $prefix) : static
  {
    static::createInstance();
    // -- 
    if(!str_contains($prefix, '/')) 
      return throw  new UnexpectedValueException("Route Path Not Contains '/'");
    // -- 
    if($prefix[0] != '/') 
      return throw  new UnexpectedValueException("Route Path Not Contains '/' At First Character");

    $prefix = str_replace(' ', '-', $prefix);
    static::$instance->setPrefix($prefix);
    return static::$instance;
  }

  /**
   * Create Group Route With Prefix
   * @param callable $callable
   */
  public static function group(string $prefix, callable $callable)
  {
    call_user_func($callable);
    static::$instance->setPrefix($prefix);
  }

}