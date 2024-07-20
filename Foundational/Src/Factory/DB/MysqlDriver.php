<?php

namespace Foundational\Factory\DB;

/**
 * Author: Saber Belkhir
 * Date: 02-03-2024
 */

use PDO;
use PDOException;

class MysqlDriver implements DBConnectionInterface
{

  
  public function connection(string $dns, string $username, string $password, ?array $option = null): PDO|PDOException
  {

    // if(is_null($option)){

    //   $option = [
    //     PDO::ATTR_PERSISTENT => true,
    //     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

    // } else {
    //   if(!array_key_exists(PDO::ATTR_PERSISTENT, $option)) $option[PDO::ATTR_PERSISTENT] = true;
    //   if(!array_key_exists(PDO::ATTR_ERRMODE, $option)) $option[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    // }

    try{
      
      return (new PDO($dns, $username, $password, $option));

    } catch(PDOException $e) {

      echo "<pre>";
      print_r($e);
      echo "</pre>";

      return $e;
    }
  }
}