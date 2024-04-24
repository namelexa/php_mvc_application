<?php

declare(strict_types=1);

namespace Test\Check24\Repository;

class Post extends Repository
{
    public const string TABLE_NAME = 'posts';

    public function add(): void
    {
        $this->save(self::TABLE_NAME,);
    }
}