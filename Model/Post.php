<?php

declare(strict_types=1);

namespace Test\Check24\Model;

class Post
{
    public const string POST_TABLE_NAME = 'post';

    public int $id;
    public string $autorId;
    public string $title;
    public string $content;
    public string $image;
    public string $createdAt;

}
