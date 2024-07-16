<?php

namespace Database;

use PDO;
use PDOException;

abstract class Query
{

  protected PDO $db;
  protected string $table;

  public function __construct()
  {
    // $dns = "mysql:host=".HOST.";dbname=".DB_NAME;
    $connection_result = DB::getInstance()->connection('mysql:host=localhost;dbname=b3s_store', 'root', '');
    if($connection_result instanceof PDO)
      $this->db = $connection_result;
    else
      throw new PDOException($connection_result);
  }

  // Insert
  public function insert(){
    // $this->db->prepare("INSERT INTO ". $this->table . "() VALUES()");
  }

  // Update
  public function update() {

  }

  // Delete
  public function delete(){

  }

  // Find all
  public function findAll() {
    echo "find all query method";
  }

  // Find one
  public function findOne(){

  }

  // Find with filter
  public function find() {

  }
}