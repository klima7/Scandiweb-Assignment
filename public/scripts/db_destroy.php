<?php

require __DIR__ . '/../../php/inc/bootstrap.php';

use Lib\Data\Database;

const DESTROY_QUERY = <<<TEXT
    DROP TABLE IF EXISTS products;
TEXT;

$pdo = Database::getPdo();
$pdo->exec(DESTROY_QUERY);

echo("Database destroy done");
