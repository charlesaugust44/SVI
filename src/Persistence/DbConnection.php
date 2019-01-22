<?php

class DbConnection
{
    private static $ini;
    private static $connection;
    private static $dsn;

    static function connect()
    {
        self::$ini = parse_ini_file('database_config.ini');
        self::$dsn = 'mysql:dbname=' . self::$ini['db'] . ';host=' . self::$ini['host'] . ';port=' . self::$ini['port'];

        if (!isset(self::$connection)) {
            try {
                self::$connection = new PDO(self::$dsn, self::$ini['user'], self::$ini['pass']);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            } catch (PDOException $e) {
                echo 'Connection Failure: ' . $e->getMessage();
            }
        }
        return self::$connection;
    }

    static function disconnect()
    {
        self::$connection = null;
    }
}
