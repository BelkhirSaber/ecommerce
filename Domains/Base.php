<?php

namespace Domains;

use Database\DatabaseConnection;

class Base {

    public mixed $pdo;
    public $tablePrefix = $_ENV['DB_TABLE_PREFIX'] ?? '';

    public function __construct() {
        $db = new DatabaseConnection();
        $this->pdo = $db->connect();
    }

    // -- Generic function

}