<?php

declare(strict_types=1);

namespace Test\Check24\Repository\Interface;

interface RepositoryInterface
{
    public function save(string $query, array $params);

    public function update();

    public function delete();

    public function get(
        string $className = '',
        array $params = [],
        int $fetchType = \PDO::FETCH_DEFAULT,
    ): mixed;

    public function getList(
        string $table,
        array $params = [],
        int $fetchType = \PDO::FETCH_DEFAULT,
        $fetchArgs = null,
        $limit = null
    );
}