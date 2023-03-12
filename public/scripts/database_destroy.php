<?php

require __DIR__ . '/../../php/inc/bootstrap.php';

use Lib\Data\Database;

$destroy_query = "DROP TABLE IF EXISTS products;";

Database::getInstance()->execute($destroy_query);
echo("Database destroyed");
