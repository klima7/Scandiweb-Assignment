<?php

require __DIR__ . '/../../php/inc/bootstrap.php';

use Lib\Data\Database;

Database::getInstance()->destroy();
echo("Database destroyed");




$destroy_query = "DROP TABLE IF EXISTS products;";
$this->pdo->exec($destroy_query);