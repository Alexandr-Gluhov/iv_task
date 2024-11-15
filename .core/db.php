<?php
class Database
{
    private static $instance = null;

    private $connection = null;

    protected function __construct()
    {
        $this->connection = new \PDO(
            "mysql:dbname=clinic;host=localhost",
            'root',
            '',
        );
    }

    public static function getInstance(): Database
    {
        if(null === self::$instance) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public static function connection(): \PDO
    {
        return static::getInstance()->connection;
    }

    public static function prepare($statement): \PDOStatement
    {
        return static::connection()->prepare($statement);
    }

    public static function query($statement): \PDOStatement
    {
        return static::connection()->query($statement);
    }

    protected function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \BadMethodCallException('Unable to deserialize database connection');
    }
}