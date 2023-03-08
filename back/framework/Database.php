<?php

namespace Framework;

use PDO;

class Database
{
    private $pdo;

    public function __construct()
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
}
