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
            show($query);
            $stmt->execute($params);
            $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
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
        string $className = '',
        array $params = [],
        int $fetchType = \PDO::FETCH_CLASS
    ): mixed {
        try {
            $whereParams = [];
            $data = null;

            foreach ($params as $param => $value) {
                $whereParams[] = "$param = :$param";
            }

            $whereClause = implode(' AND ', $whereParams);
            $query = "SELECT * FROM $this->table WHERE $whereClause";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);

            switch ($fetchType) {
                case \PDO::FETCH_CLASS:
                    $data = $stmt->fetchAll($fetchType, $className);
                    break;
                case \PDO::FETCH_OBJ:
                    $data = $stmt->fetchObject($className);
                    break;
                case \PDO::FETCH_ASSOC:
                    $data = $stmt->fetchAll($fetchType);
                    break;
                default:
            }

            return $data;
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