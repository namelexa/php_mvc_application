<?php

declare(strict_types=1);

namespace Test\Check24\Controller;

use Test\Check24\Model\Post;
use Test\Check24\Repository\Post as RepositoryPost;
use Test\Check24\Repository\Repository;

class HomePage extends AbstractController
{
    protected string $title = 'Home Page';

    public function __construct(
        private readonly Post $post,
        private Repository $repository,
        private RepositoryPost $postRepository
    ) {
    }

    public function execute(): void
    {
        try {
            if (!$this->checkRequest(self::GET)) {
                throw new \RuntimeException('Request method is wrong');
            }

            $this->renderView('/home_page');
        } catch (\RuntimeException $e) {
            throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function getPosts()
    {
    }
}
