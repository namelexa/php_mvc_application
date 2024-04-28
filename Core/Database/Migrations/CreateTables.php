<?php

declare(strict_types=1);

namespace Test\Check24\Core\Database\Migrations;

use Test\Check24\Core\Database\Connection;

class CreateTables
{
    private const array TABLES_LIST = [
        'user' =>
            'id BIGINT NOT NULL AUTO_INCREMENT,
            email VARCHAR(50) NOT NULL UNIQUE,
            passwordHash VARCHAR(32) NOT NULL,
            createdAt DATETIME CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            UNIQUE INDEX uq_email (email ASC)',
        'posts' =>
            'id BIGINT NOT NULL AUTO_INCREMENT,
            authorId BIGINT NOT NULL,
            title VARCHAR(75) NOT NULL,
            published TINYINT(1) NOT NULL DEFAULT 0,
            createdAt DATETIME NOT NULL,
            updatedAt DATETIME NULL DEFAULT NULL,
            content TEXT NULL DEFAULT NULL,
            PRIMARY KEY (id),
            UNIQUE INDEX uq_slug (title ASC),
            INDEX idx_post_user (authorId ASC),
            CONSTRAINT fk_post_user
              FOREIGN KEY (authorId)
              REFERENCES check24.user (id)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION',
        'comments' =>
            'id BIGINT NOT NULL AUTO_INCREMENT,
            postId BIGINT NOT NULL,
            title VARCHAR(100) NOT NULL,
            published TINYINT(1) NOT NULL DEFAULT 0,
            createdAt DATETIME NOT NULL,
            content TEXT NULL DEFAULT NULL,
            PRIMARY KEY (id),
            INDEX idx_comment_post (postId ASC),
            CONSTRAINT fk_comment_post
              FOREIGN KEY (postId)
              REFERENCES check24.posts (id)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION'
    ];

    public function __construct(
        private readonly Connection $connection
    ) {
    }

    public function createTables(array $tables = []): bool
    {
        $list = $tables ?: self::TABLES_LIST;

        return $this->connection->createTables($list);
    }
}
