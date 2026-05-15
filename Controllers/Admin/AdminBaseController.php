<?php
namespace Admin;

use Controller\Middleware\AuthMiddleware;

class AdminBaseController extends AuthMiddleware {
    
    public function __construct() {
        // Vérifier l'authentification admin
        // if (!$this->isAuthenticated() || !$this->isAdmin()) {
        //     header('Location: /admin/login');
        //     exit;
        // }
    }
    
    /**
     * Render une vue ADMIN avec le layout AdminLTE
     */
    protected function view(string $path, array $data = []): void {
        ob_start();
        
        // Extraire les données
        extract($data);
        
        // Charger la vue admin
        $viewPath = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . $viewPath . '.php';
        
        $content = ob_get_clean();
        
        // Charger le layout AdminLTE
        require VIEWS . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'layout.php';
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
    
    /**
     * Vérifier si l'utilisateur est admin
     */
    protected function isAdmin(): bool {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }
}