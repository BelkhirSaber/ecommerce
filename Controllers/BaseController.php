<?php
namespace Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Controller\Middleware\AuthMiddleware;
use Twig\TwigFunction;

require_once __DIR__ . "/../Config/vite-helper.php";

class BaseController extends AuthMiddleware {
    protected Environment $twig;
    
    public function __construct() {
        $loader = new FilesystemLoader(VIEWS);
        $this->twig = new Environment($loader, [
            'cache' => __DIR__ . '/../storage/cache/views',
            'auto_reload' => true,  // false en production
            'debug' => $_ENV['APP_DEBUG'] ?? true
        ]);
        
        // Variables globales disponibles partout
        $this->twig->addGlobal('app_name', $_ENV['APP_NAME']);
        $this->twig->addGlobal('user', $_SESSION['user'] ?? null);
        $this->twig->addGlobal('IMG_URL', IMG_URL);

        // Function
        $this->registerTwigFunctions();

    }
    
    protected function view(string $template, array $data = []): void {
        echo $this->twig->render($template . '.twig', $data);
    }
    
    protected function json(array $data, int $status = 200): void {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    private function registerTwigFunctions() {
        $this->twig->addFunction(new TwigFunction('vite_asset', function ($entry) {
            return vite_asset($entry);
        }));
        
        $this->twig->addFunction(new TwigFunction('vite_client', function () {
            return vite_client();
        }));
        
        $this->twig->addFunction(new TwigFunction('vite_css', function ($entry) {
            return vite_css($entry);
        }));
    }
}