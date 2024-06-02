<?php

namespace Admin;

use Controller\Controller;
use Model\User;

// use Controller\Middleware\AuthMiddleware;

class AdminController extends Controller{


  public function index() {

    // if ($this->authenticated()) {
      
      $this->view('admin/dashboard');
    // }


  }
  
}