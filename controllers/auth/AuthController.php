<?php

namespace Controller\Auth;


class AuthController {
  // public function index() {
  //   require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'views/auth/login.php';
  // }


  // Login user and start session
  public function login(){
    echo dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'views/auth/login.php';
    require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'views/auth/login.php';
  }

  // Register new user
  public function register(){
    require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'views/auth/register.php';
  }

  // Logout user
  public function logout(){

  }

  // Register the log
  private function log(){

  }

  public function authenticate(string $username, string $password) {

  }

  


}