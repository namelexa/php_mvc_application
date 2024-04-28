<?php

declare(strict_types=1);

namespace Test\Check24\Repository;

class Post extends Repository
{
    protected string $table = 'posts';

    public function add(int $authorId, string $title, string $content): int
    {
        $query = "INSERT INTO $this->table (authorId, title, content) VALUES (:authorId, :title, :content)";
        $params = ['authorId' => $authorId, 'title' => $title, 'content' => $content];

        try {
            return $this->save(\Test\Check24\Model\Post::class, $query, $params);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }
    }

    public function getAll(): array
    {
        return $this->getList(\Test\Check24\Model\Post::class, 2);
    }
}