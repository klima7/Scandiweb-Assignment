<?php

namespace Lib\Data;

use PDO;

class Database
{
    private static ?object $instance = null;

    private object $pdo;
    private object $productRepository;

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

        $this->productRepository = new ProductRepository($this->pdo);
    }

    public static function getInstance(): object
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getProductRepository(): object
    {
        return $this->productRepository;
    }

    public function create()
    {
        $create_query = <<<TEXT
        CREATE TABLE IF NOT EXISTS products(
            id INT AUTO_INCREMENT PRIMARY KEY,
            type ENUM('disk', 'book', 'furniture') NOT NULL,
            sku  VARCHAR(255) UNIQUE NOT NULL CHECK(sku > ''),
            name VARCHAR(255) NOT NULL CHECK(name > ''),
            price DECIMAL(12, 2) NOT NULL check(price > 0),
            size  DOUBLE NULL check(size > 0),
            weight  DOUBLE NULL check(weight > 0),
            height  DOUBLE NULL check(height > 0),
            width  DOUBLE NULL check(width > 0),
            length int NULL check(length > 0),
            CONSTRAINT disk_requirements check (
                    type != 'disk'
                        OR type = 'disk'
                        AND size IS NOT NULL
                        AND weight IS NULL
                        AND height IS NULL
                        AND width IS NULL
                        AND length IS NULL
            ),
            CONSTRAINT book_requirements check (
                    type != 'book'
                        OR type = 'book'
                        AND size IS NULL
                        AND weight IS NOT NULL
                        AND height IS NULL
                        AND width IS NULL
                        AND length IS NULL
        
            ),
            CONSTRAINT furniture_requirements check (
                    type != 'furniture'
                        OR type = 'furniture'
                        AND size IS NULL
                        AND weight IS NULL
                        AND height IS NOT NULL
                        AND width IS NOT NULL
                        AND length IS NOT NULL
            )
        );
        TEXT;

        $this->pdo->exec($create_query);
    }

    public function destroy()
    {
        $destroy_query = "DROP TABLE IF EXISTS products;";
        $this->pdo->exec($destroy_query);
    }
}
