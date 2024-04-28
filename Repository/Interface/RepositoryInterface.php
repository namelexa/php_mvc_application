<?php

declare(strict_types=1);

namespace Test\Check24\Repository\Interface;

interface RepositoryInterface
{
    public function save(string $className, string $query, array $params): int;

    public function update();

    public function delete();

    public function get(
        string $className = '',
        array $params = [],
        int $fetchType = \PDO::FETCH_DEFAULT,
    ): mixed;

    public function getList(
        string $className,
        int $limit = 0
    ): array;
}