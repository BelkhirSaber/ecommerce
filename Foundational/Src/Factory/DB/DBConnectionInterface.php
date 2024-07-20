<?php 

/**
 * Author: Saber Belkhir
 * Date: 02-03-2024
 */

namespace Foundational\Factory\DB;

use PDO;
use PDOException;

interface DBConnectionInterface {

  public function connection(string $dns, string $username, string $password, ?array $option = null) : PDO|PDOException;

}
