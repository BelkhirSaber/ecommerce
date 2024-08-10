<?php

namespace Admin;

use Controller\Controller;
use Model\User;

// use Controller\Middleware\AuthMiddleware;

class AdminController extends Controller{


  public function index() {

    $user = new User();

    // if ($this->authenticated()) {
      
      $this->view('admin.dashboard', [], 'admin');
    // }


  }

  public function test(string $status) {
    echo $status;
  }
  
}