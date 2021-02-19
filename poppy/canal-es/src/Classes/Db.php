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
     * @var array $configs
     */
    private $configs;

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
        $this->loadConfig();

        $host     = data_get($this->configs, 'host');
        $port     = data_get($this->configs, 'port');
        $username = data_get($this->configs, 'username');
        $password = data_get($this->configs, 'password');
        $database = data_get($this->configs, 'database');
        $charset  = data_get($this->configs, 'charset');

        $dsn = "mysql:host={$host};port={$port};dbname={$database};charset={$charset}";

        return new PDO($dsn, $username, $password);
    }

    protected function loadConfig(): void
    {
        $this->configs = config('database');
    }
}