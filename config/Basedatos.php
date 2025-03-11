<?php


class Basedatos {
    private static $pdo;

    public static function getConexion() {
        if (self::$pdo == null) {
            $dsn = "mysql:host=localhost;dbname=gestor";
            $username = "root";
            $pass = "abc123.";
            self::$pdo = new PDO($dsn, $username, $pass);
        }
        return self::$pdo;
    }
}

