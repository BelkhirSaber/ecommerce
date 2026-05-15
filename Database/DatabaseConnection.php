<?php

namespace Database;

class DatabaseConnection {

    private string | null $dsn;

    public function __construct(string | null $dsn = null) {
        $this->dsn = $dsn ?? "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset=utf8mb4";
    }

    // -- Connect to the database

    public function connect() {
        try {
            $pdo = new \PDO($this->dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (\PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // -- create generic query method



}