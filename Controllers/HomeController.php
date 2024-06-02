<?php

namespace Controller;

use Controller\Controller;

class HomeController extends Controller{
  
  public function index(){
    
    $this->view('home');
  }

}