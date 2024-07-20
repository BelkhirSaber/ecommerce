<?php
namespace Controller;

use Controller\Middleware\AuthMiddleware;
use Lang\Lang;
use Utilities\Utilities;


class Controller extends AuthMiddleware{

  public function view(string $path, ?array $params = null, ?string $layout = null){
    ob_start();
    // -- Define all variable in this section

    $lang = Lang::getInstance();
    $utility = new Utilities();

    // -- Require page content

    $params ? extract($params) : '';
    $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
    require VIEWS . DIRECTORY_SEPARATOR . $path . '.php';

    // -- Get all buffering content and clean the buffer

    $content = ob_get_clean();

    // -- require the layout with content

    // require VIEWS . DIRECTORY_SEPARATOR . (str_contains($_SERVER['REQUEST_URI'], 'dash') ? 'admin/layout.php' : 'layout.php');

    // -- Check if is a ajax request 

    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
      echo $content;
      exit;
    }
    require VIEWS . DIRECTORY_SEPARATOR . (!is_null($layout) ? 'admin/layout.php' : 'layout.php');
  }

}