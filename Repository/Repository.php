<?php

declare(strict_types=1);

namespace Test\Check24\Repository;

use PDO;
use Test\Check24\Core\Database\Connection;
use Test\Check24\Repository\Interface\RepositoryInterface;

class Repository implements RepositoryInterface
{
    public function __construct(
        private readonly Connection $connection = new Connection()
    ) {
    }

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function edit()
    {
        // TODO: Implement edit() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function get(
        string $table,
        array $params = [],
        int $fetchType = PDO::FETCH_DEFAULT,
        $fetchArgs = null,
        $limit = null
    ) {
        $connection = $this->connection->pdoConnection();
        $stmt = $connection->prepare("SELECT * FROM $table LIMIT ?");

        if ($params !== []) {
            $stmt->execute($params);
        }

        return $stmt->fetchAll($fetchType, $fetchArgs);
    }

    public function getList()
    {
        // TODO: Implement getList() method.
    }
}