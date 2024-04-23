<?php

declare(strict_types=1);

namespace Test\Check24\Controller;

use Test\Check24\Model\Post;

class HomePage extends AbstractController
{
    private const string TITLE = 'Home Page';
    public function __construct(
        private readonly Post $post,
        private \Test\Check24\Core\Database\Migrations\CreateTables $createTables
    ) {
    }

    public function execute(): void
    {
        $this->setTitle(self::TITLE);

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
        $this->createTables->createTables();
        return $this->post->getAllPosts();
    }
}
