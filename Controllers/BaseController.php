<?php
namespace Controller;

use Controller\Middleware\AuthMiddleware;

class BaseController extends AuthMiddleware {
    
    /**
     * Render une vue FRONT-END avec le layout public
     */
    protected function view(string $path, array $data = []): void {
        ob_start();
        
        // Extraire les données
        extract($data);
        
        // Charger la vue
        $viewPath = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . DIRECTORY_SEPARATOR . $viewPath . '.php';
        
        $content = ob_get_clean();
        
        // Charger le layout front-end
        require VIEWS . DIRECTORY_SEPARATOR . 'layout.php';
    }
    
    /**
     * Retourner du JSON
     */
    protected function json(array $data, int $status = 200): void {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    
    /**
     * Redirection
     */
    protected function redirect(string $url): void {
        header('Location: ' . $url);
        exit;
    }
}