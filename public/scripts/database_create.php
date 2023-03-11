<?php

require __DIR__ . '/../../php/inc/bootstrap.php';

use Lib\Data\Database;

Database::getInstance()->create();
echo("Database created");
