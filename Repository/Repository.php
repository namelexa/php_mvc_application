<?php

declare(strict_types=1);

namespace Test\Check24\Repository;

use Test\Check24\Core\Database\Connection;
use Test\Check24\Repository\Interface\RepositoryInterface;

class Repository implements RepositoryInterface
{
    protected string $table = '';
    private \PDO $pdo;

    public function __construct(
        private readonly Connection $connection
    ) {
        $this->pdo = $this->connection->pdoConnection();
    }

    public function save(string $query, array $params)
    {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException('Error while saving data from database', (int)$e->getCode());
        }
    }

    public function update()
    {
        // TODO: Implement edit() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function get(
        array $params = [],
        int $fetchType = \PDO::FETCH_DEFAULT
    ) {
        try {
            $whereParams = '';

            foreach ($params as $param => $value) {
                $whereParams .= $param . '=:' . $param;
            }

            $query = "SELECT * FROM $this->table WHERE $whereParams";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException('Error while getting data from database', (int)$e->getCode());
        }

        return $user;
    }

    public function getList(
        string $table,
        array $params = [],
        int $fetchType = \PDO::FETCH_DEFAULT,
        $fetchArgs = null,
        $limit = null
    ) {
        // TODO: Implement getList() method.
    }
}