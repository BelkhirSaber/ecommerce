<?php

/**
 * Author: Saber Belkhir
 * Date: 13-07-2024
 */

namespace Model;

use Foundational\Model\Model;

class Product extends Model
{
  protected string $table = 't_b3s_product';

  public function __construct()
  {
    parent::__construct();
  }

  public function all() {

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