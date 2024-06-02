<?php

namespace Controller\User;

class UserController {

  public function __construct(
    private string $first_name,
    private string $last_name,
    private string $email,
    private string $gender,
    private string $phone,
    private string $username,
    private string $password,){
      $this->addUser();
    }


  // Insert user
  private function addUser() {

  }


}