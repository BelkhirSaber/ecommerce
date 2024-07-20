<?php

/**
 * Author: Saber BELKHIR
 * Date: 02-03-2024
 */


namespace Database;

use Foundational\Factory\DB\DBConnectionInterface;
use Foundational\Factory\DB\DBFactory;

class DB
{

  private static DBConnectionInterface $db_instance;

  public static function getInstance(string $driver = '') : DBConnectionInterface
  {
    if(empty(static::$db_instance)) {
      static::$db_instance = $driver != '' ? DBFactory::createConnection($driver) : DBFactory::createConnection();
    }

    return static::$db_instance;
  }
  
}