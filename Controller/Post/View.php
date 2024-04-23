<?php

declare(strict_types=1);

namespace Test\Check24\Controller\Post;
use Test\Check24\Controller\AbstractController;

class View extends AbstractController
{
    public function execute(): void
    {
        $this->renderView($_SERVER['REQUEST_URI']);
    }
}
