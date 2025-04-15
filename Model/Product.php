<?php

/**
 * Author: Saber Belkhir
 * Date: 13-07-2024
 */

namespace Model;

use PDO;
use PDOException;
use Foundational\Model\Model;

class Product extends Model
{
  protected string $table = 't_b3s_product';

  public function __construct()
  {
    parent::__construct();
  }

  // -- Get all product

  public function all() {
    return $this->findAll();
  }

}
