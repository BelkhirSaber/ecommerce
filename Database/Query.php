<?php

namespace Database;

use PDO;
use PDOException;
use PDOStatement;

abstract class Query
{

  // use \ArrayTrait;

  protected PDO $db;
  protected string $table;

  public function __construct()
  {
    // $dns = "mysql:host=".HOST.";dbname=".DB_NAME;
    $dns = "mysql:host=".$_ENV["DB_HOST"].";dbname=".$_ENV["DB_DATABASE"];
    $connection_result = DB::getInstance()->connection($dns, $_ENV["DB_USERNAME"], $_ENV["DB_PASSWORD"]);
    if($connection_result instanceof PDO)
      $this->db = $connection_result;
    else
      throw new PDOException($connection_result);
  }

  // Insert
  public function insert(){
    // $this->db->prepare("INSERT INTO ". $this->table . "() VALUES()");
  }

  // -- Update
  public function update(array $columns)
    {
      // if(!$this->isAssociativeArray($columns)) return array('result' => 0, 'message' => 'you must pass an associative array in the '.__FUNCTION__.' function');
      // $updatedColumns = "";
      // foreach($columns as $key => $value) 
      //   {
      //     $updatedColumns .= '';
      //   }
      //       $query = 
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

  // -- Function Query
  public function sql_query(string $query, array $params) : PDOStatement|bool
    {
      $statement = $this->db->prepare($query);
      $result = $statement->execute($params);
      if($result) return $statement;
      return false;
    }
}