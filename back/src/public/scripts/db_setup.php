<?php

require __DIR__ . '/../../inc/bootstrap.php';

use Lib\Core\Database;

const CREATE_TABLE_QUERY = <<<TEXT
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

$pdo = Database::getPdo();
$pdo->exec(CREATE_TABLE_QUERY);

echo("Database setup done");
