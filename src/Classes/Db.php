<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Classes;

use PDO;
use Throwable;

class Db
{
    /**
     * @var PDO
     */
    protected static $pdo;

    /**
     * @return PDO
     * @throws Throwable
     */
    public function __invoke()
    {
        if (static::$pdo instanceof PDO) {
            return static::$pdo;
        }

        try {
            return static::$pdo = $this->initDao();
        } catch (Throwable $e) {
            throw $e;
        }
    }

    /**
     * @return PDO
     */
    protected function initDao(): PDO
    {
        $host     = config('database.connections.mysql.host');
        $port     = config('database.connections.mysql.port', 3306);
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $database = config('database.connections.mysql.database');
        $charset  = config('database.connections.mysql.charset');

        $dsn = "mysql:host={$host};port={$port};dbname={$database};charset={$charset}";

        return new PDO($dsn, $username, $password);
    }
}