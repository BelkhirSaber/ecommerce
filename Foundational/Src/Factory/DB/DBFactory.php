<?php

/**
 * Author: Saber Belkhir
 * Date: 02-03-2024
 */

namespace Foundational\Factory\DB;

class DBFactory 
{
  public static function createConnection(string $driver = 'mysql') : DBConnectionInterface
  {
    return match($driver)
    {
      'mysql' => new MysqlDriver()
    };
  }
}