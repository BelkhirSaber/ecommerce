<?php

namespace Database;

use PDO;
use PDOException;
use PDOStatement;

abstract class Query
{
  protected PDO $db;
  protected string $table;

  public function __construct()
  {
    $dsn = "mysql:host={$_ENV["DB_HOST"]};dbname={$_ENV["DB_DATABASE"]};charset=utf8mb4";
    $connection_result = DB::getInstance()->connection($dsn, $_ENV["DB_USERNAME"], $_ENV["DB_PASSWORD"]);

    if ($connection_result instanceof PDO) {
      $this->db = $connection_result;
    } else {
      throw new PDOException($connection_result);
    }
  }

  /**
   * Insère une ligne dans la table.
   */
  public function insert(array $data): bool
  {
    $columns = implode(', ', array_keys($data));
    $placeholders = ':' . implode(', :', array_keys($data));

    $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute($data);
  }

  /**
   * Met à jour une ou plusieurs colonnes par ID.
   */
  public function update(int $id, array $data): bool
  {
    $sets = [];
    foreach ($data as $key => $value) {
      $sets[] = "$key = :$key";
    }

    $setClause = implode(', ', $sets);
    $sql = "UPDATE {$this->table} SET $setClause WHERE id = :id";
    $data['id'] = $id;

    $stmt = $this->db->prepare($sql);
    return $stmt->execute($data);
  }

  /**
   * Supprime une ligne par ID.
   */
  public function delete(int $id): bool
  {
    $sql = "DELETE FROM {$this->table} WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute(['id' => $id]);
  }

  /**
   * Récupère toutes les lignes de la table.
   */
  public function findAll(): array
  {
    $sql = "SELECT * FROM {$this->table}";
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Récupère une ligne par ID.
   */
  public function findOne(int $id): ?array
  {
    $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ?: null;
  }

  /**
   * Recherche avec filtre dynamique.
   */
  public function find(array $filters): array
  {
    $conditions = [];
    foreach ($filters as $key => $value) {
      $conditions[] = "$key = :$key";
    }

    $whereClause = implode(' AND ', $conditions);
    $sql = "SELECT * FROM {$this->table} WHERE $whereClause";
    $stmt = $this->db->prepare($sql);
    $stmt->execute($filters);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Exécute une requête SQL personnalisée avec paramètres.
   */
  public function sql_query(string $query, array $params = []): PDOStatement|bool
  {
    $stmt = $this->db->prepare($query);
    $result = $stmt->execute($params);
    return $result ? $stmt : false;
  }
}
