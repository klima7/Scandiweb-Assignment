<?php

namespace Lib\Data;

use PDO;

class Database
{
    private static $pdo;

    public static function getPdo(): object
    {
        self::ensureConnected();
        return self::$pdo;
    }

    private static function ensureConnected()
    {
        if (self::$pdo == null) {
            self::connect();
        }
    }

    private static function connect()
    {
        global $db_host, $db_name, $db_user, $db_password;
        $dsn = "mysql:host=$db_host;dbname=$db_name;charset=UTF8";
        self::$pdo = new PDO(
            $dsn,
            $db_user,
            $db_password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
}
