<?php

declare(strict_types=1);

namespace Test\Check24\Repository\Interface;

interface RepositoryInterface
{
    public function save();

    public function edit();

    public function delete();

    public function get(
        string $table,
        array $params = [],
        int $fetchType = \PDO::FETCH_DEFAULT,
        $fetchArgs = null,
        $limit = null
    );

    public function getList();
}