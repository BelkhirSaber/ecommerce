<?php

namespace Admin;

use Controller\BaseController;
use Model\User;

// use Controller\Middleware\AuthMiddleware;

class AdminController extends BaseController{

  public function index() {
    $this->view('dashboard', ['pageTitle' => 'Dashboard']);
  }
  
}