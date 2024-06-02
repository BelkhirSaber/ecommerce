<?php
namespace Controller\Middleware;


class AuthMiddleware {

  public function authenticated() {
    if(!$this->isAuthenticated()) {
      header('Location: /login');
      exit(0);
    }
    return true;
  }

  public function isAuthenticated() : bool {
    return isset($_SESSION['user_id']) ? true : false;
  }
}