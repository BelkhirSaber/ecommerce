<?php
namespace Controller;

use Controller\Middleware\AuthMiddleware;
use Lang\Lang;
use Utilities\Utilities;


class Controller extends AuthMiddleware{

  public function view(string $path, ?array $params = null){
    ob_start();
    // Define all variable in this section
    $lang = Lang::getInstance();
    $utility = new Utilities();
    // Require page content
    $params ? extract($params) : '';
    $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
    require VIEWS . DIRECTORY_SEPARATOR . $path . '.php';
    // Get all buffering content and clean the buffer
    $content = ob_get_clean();
    // require the layout with content
    require VIEWS . DIRECTORY_SEPARATOR . (str_contains($_SERVER['REQUEST_URI'], 'dash') ? 'admin/layout.php' : 'layout.php');
  }

}