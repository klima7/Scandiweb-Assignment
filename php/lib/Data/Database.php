<?php

namespace Lib\Data;

use PDO;

class Database
{
    private static ?object $instance = null;
    private object $pdo;
    private array $cache = [];

    private function __construct()
    {
        global $db_host, $db_name, $db_user, $db_password;

        $dsn = "mysql:host=$db_host;dbname=$db_name;charset=UTF8";

        $this->pdo = new PDO(
            $dsn,
            $db_user,
            $db_password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }

    public static function getInstance(): object
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function execute(string $query, array $params = []): void
    {
        $statement = $this->getPreparedStatement($query);
        $statement->execute($params);
    }

    public function executeAndFetch(string $query, array $params = []): array
    {
        $statement = $this->getPreparedStatement($query);
        $statement->execute($params);
        return $statement->fetchAll();
    }

    public function getLastInsertedId()
    {
        return $this->pdo->lastInsertId();
    }

    private function getPreparedStatement(string $query)
    {
        if (array_key_exists($query, $this->cache)) {
            $statement = $this->cache[$query];
        } else {
            $statement = $this->pdo->prepare($query);
            $this->cache[$query] = $statement;
        }
        return $statement;
    }
}
