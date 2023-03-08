<?php

require __DIR__ . '/../../inc/bootstrap.php';

use Lib\Core\Database;

const DESTROY_QUERY = <<<TEXT
    DROP TABLE IF EXISTS products;
TEXT;

$pdo = Database::getPdo();
$pdo->exec(DESTROY_QUERY);

echo("Database destroy done");
