<?php

namespace Controller;

use Controller\BaseController;
use Nyholm\Psr7\Factory\Psr17Factory as ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController extends BaseController{

  public function index() {
      $this->view('home', ['pageTitle' => 'Accueil']);
  }

}