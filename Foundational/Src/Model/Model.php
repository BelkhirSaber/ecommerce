<?php

/**
 * Author: Saber Belkhir
 * Date: 02-03-2024
 */

namespace Foundational\Model;

use Database\DB;
use Database\Query;
use Foundational\Factory\DB\DBConnectionInterface;

class Model extends Query
{
  // protected $db;
  // protected string $table;

  public function __construct()
  {
    parent::__construct();
  }

  public function testing()
  {
    echo "model extends query class";
    print_r($this->db);
  }

  // public function getDB() : DBConnectionInterface
  // {
  //   return $this->db;
  // }
}