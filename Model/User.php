<?php

/**
 * Author: Saber Belkhir
 * Date: 02-03-2024
 */

namespace Model;

use Foundational\Model\Model;

class User extends Model
{
  protected string $table = 't_b3s_user';

  public function __construct()
  {
    parent::__construct();

    // echo "user extends model class";
    // print_r($this->db);
    $statement = $this->db->prepare("SELECT * FROM $this->table");
    $statement->execute() or die($statement->errorInfo());
    while($row = $statement->fetchObject())
    {
      echo "<pre>";
      print_r($row);
      echo "</pre>";
    }
    $statement->closeCursor();
  }
}