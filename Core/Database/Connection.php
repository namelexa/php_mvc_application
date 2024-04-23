<?php

declare(strict_types=1);

namespace Test\Check24\Core\Database;

use PDO;
use Test\Check24\Core\Config;

class Connection
{
    public function pdoConnection(): PDO
    {
        try {
            $dsn = "mysql:host=".Config::DB_HOST.";dbname=".Config::DB_NAME.";charset=".Config::DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $pdo = new PDO($dsn, Config::DB_USER, Config::DB_PASS, $options);
        } catch (\PDOException $e) {
            die($e);
        }

        return $pdo;
    }

    public function createTables(array $tables): bool
    {
        $pdo = $this->pdoConnection();

        try {
            return array_walk($tables, static function ($columns, $tableName) use ($pdo): void {
                $query = "CREATE TABLE IF NOT EXISTS $tableName ($columns)";
                $pdo->prepare($query)->execute();
            });
        } catch (\PDOException $e) {
            die($e);
        }
    }

    public function query(string $tableName, string $query, string $queryType, string $where = '')
    {
    }
}
