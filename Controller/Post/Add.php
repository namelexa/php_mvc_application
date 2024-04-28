<?php

declare(strict_types=1);

namespace Test\Check24\Controller\Post;

use Test\Check24\Controller\AbstractController;

class Add extends AbstractController
{
    protected string $title = 'Add post';

    public function execute()
    {
        try {
            if (!$this->checkRequest(self::GET)) {
                throw new \RuntimeException('Request method is wrong');
            }

            $this->renderView($_SERVER['REQUEST_URI']);
        } catch (\RuntimeException $e) {
            throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }
}